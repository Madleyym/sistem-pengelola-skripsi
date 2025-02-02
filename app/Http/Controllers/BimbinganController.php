<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Skripsi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BimbinganController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'dosen') {
            $bimbingans = Bimbingan::whereHas('skripsi', function ($query) use ($user) {
                $query->where('pembimbing1_id', $user->dosen->id)
                    ->orWhere('pembimbing2_id', $user->dosen->id);
            })->with(['skripsi.mahasiswa', 'dosen'])->get();
        } elseif ($user->role === 'mahasiswa') {
            $bimbingans = Bimbingan::whereHas('skripsi', function ($query) use ($user) {
                $query->where('mahasiswa_id', $user->mahasiswa->id);
            })->with(['skripsi', 'dosen'])->get();
        } else {
            $bimbingans = Bimbingan::with(['skripsi.mahasiswa', 'dosen'])->get();
        }

        return view('bimbingan.index', compact('bimbingans'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {
            $skripsi = Skripsi::where('mahasiswa_id', $user->mahasiswa->id)->first();
            $dosens = Dosen::whereIn('id', [$skripsi->pembimbing1_id, $skripsi->pembimbing2_id])->get();
        } else {
            $skripsis = Skripsi::with('mahasiswa')->get();
            $dosens = Dosen::where('status', 'aktif')->get();
        }

        return view('bimbingan.create', compact('skripsis', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skripsi_id' => 'required|exists:skripsi,id',
            'dosen_id' => 'required|exists:dosen,id',
            'tanggal_bimbingan' => 'required|date',
            'waktu_bimbingan' => 'required',
            'catatan_bimbingan' => 'required',
            'file_bimbingan' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);

        $data = $request->all();
        $data['waktu_bimbingan'] = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->tanggal_bimbingan . ' ' . $request->waktu_bimbingan
        );

        // Handle file upload
        if ($request->hasFile('file_bimbingan')) {
            $file = $request->file('file_bimbingan');
            $path = $file->store('bimbingan', 'public');
            $data['file_bimbingan'] = $path;
        }

        $data['status'] = 'menunggu';

        Bimbingan::create($data);

        return redirect()->route('bimbingan.index')
            ->with('success', 'Data bimbingan berhasil ditambahkan.');
    }

    public function edit(Bimbingan $bimbingan)
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {
            $skripsi = Skripsi::where('mahasiswa_id', $user->mahasiswa->id)->first();
            $dosens = Dosen::whereIn('id', [$skripsi->pembimbing1_id, $skripsi->pembimbing2_id])->get();
        } else {
            $skripsis = Skripsi::with('mahasiswa')->get();
            $dosens = Dosen::where('status', 'aktif')->get();
        }

        return view('bimbingan.edit', compact('bimbingan', 'skripsis', 'dosens'));
    }

    public function update(Request $request, Bimbingan $bimbingan)
    {
        $request->validate([
            'tanggal_bimbingan' => 'required|date',
            'waktu_bimbingan' => 'required',
            'catatan_bimbingan' => 'required',
            'status' => 'required|in:menunggu,disetujui,ditolak',
            'file_bimbingan' => 'nullable|mimes:pdf,doc,docx|max:2048'
        ]);

        $data = $request->all();
        $data['waktu_bimbingan'] = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->tanggal_bimbingan . ' ' . $request->waktu_bimbingan
        );

        // Handle file upload
        if ($request->hasFile('file_bimbingan')) {
            // Delete old file if exists
            if ($bimbingan->file_bimbingan) {
                Storage::disk('public')->delete($bimbingan->file_bimbingan);
            }

            $file = $request->file('file_bimbingan');
            $path = $file->store('bimbingan', 'public');
            $data['file_bimbingan'] = $path;
        }

        $bimbingan->update($data);

        return redirect()->route('bimbingan.index')
            ->with('success', 'Data bimbingan berhasil diperbarui.');
    }

    public function destroy(Bimbingan $bimbingan)
    {
        // Delete associated file
        if ($bimbingan->file_bimbingan) {
            Storage::disk('public')->delete($bimbingan->file_bimbingan);
        }

        $bimbingan->delete();
        return redirect()->route('bimbingan.index')
            ->with('success', 'Data bimbingan berhasil dihapus.');
    }
}
