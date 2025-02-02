<?php

namespace App\Http\Controllers;

use App\Models\Skripsi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkripsiController extends Controller
{
    public function index()
    {
        $skripsis = Skripsi::with(['mahasiswa', 'pembimbing1', 'pembimbing2'])->get();
        return view('skripsi.index', compact('skripsis'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::where('status', 'aktif')->get();
        $dosens = Dosen::where('status', 'aktif')->get();
        return view('skripsi.create', compact('mahasiswas', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id|unique:skripsi',
            'judul_skripsi' => 'required',
            'abstrak' => 'required',
            'kata_kunci' => 'required',
            'pembimbing1_id' => 'required|exists:dosen,id',
            'pembimbing2_id' => 'required|exists:dosen,id|different:pembimbing1_id',
            'file_proposal' => 'required|mimes:pdf|max:2048'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file_proposal')) {
            $file = $request->file('file_proposal');
            $path = $file->store('proposals', 'public');
            $data['file_proposal'] = $path;
        }

        $data['status'] = 'pengajuan';
        $data['tanggal_pengajuan'] = now();

        Skripsi::create($data);

        return redirect()->route('skripsi.index')
            ->with('success', 'Data skripsi berhasil ditambahkan.');
    }

    public function show(Skripsi $skripsi)
    {
        $skripsi->load(['mahasiswa', 'pembimbing1', 'pembimbing2', 'bimbingan', 'seminar', 'sidang']);
        return view('skripsi.show', compact('skripsi'));
    }

    public function edit(Skripsi $skripsi)
    {
        $dosens = Dosen::where('status', 'aktif')->get();
        return view('skripsi.edit', compact('skripsi', 'dosens'));
    }

    public function update(Request $request, Skripsi $skripsi)
    {
        $request->validate([
            'judul_skripsi' => 'required',
            'abstrak' => 'required',
            'kata_kunci' => 'required',
            'pembimbing1_id' => 'required|exists:dosen,id',
            'pembimbing2_id' => 'required|exists:dosen,id|different:pembimbing1_id',
            'status' => 'required|in:pengajuan,diterima,ditolak,bimbingan,seminar,sidang,selesai',
            'file_skripsi' => 'nullable|mimes:pdf|max:2048'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file_skripsi')) {
            // Delete old file if exists
            if ($skripsi->file_skripsi) {
                Storage::disk('public')->delete($skripsi->file_skripsi);
            }

            $file = $request->file('file_skripsi');
            $path = $file->store('skripsi', 'public');
            $data['file_skripsi'] = $path;
        }

        // Set tanggal selesai jika status berubah menjadi selesai
        if ($request->status === 'selesai' && $skripsi->status !== 'selesai') {
            $data['tanggal_selesai'] = now();
        }

        $skripsi->update($data);

        return redirect()->route('skripsi.index')
            ->with('success', 'Data skripsi berhasil diperbarui.');
    }

    public function destroy(Skripsi $skripsi)
    {
        // Delete associated files
        if ($skripsi->file_proposal) {
            Storage::disk('public')->delete($skripsi->file_proposal);
        }
        if ($skripsi->file_skripsi) {
            Storage::disk('public')->delete($skripsi->file_skripsi);
        }

        $skripsi->delete();
        return redirect()->route('skripsi.index')
            ->with('success', 'Data skripsi berhasil dihapus.');
    }
}
