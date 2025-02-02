<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SeminarController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'dosen') {
            $seminars = Seminar::whereHas('skripsi', function ($query) use ($user) {
                $query->where('pembimbing1_id', $user->dosen->id)
                    ->orWhere('pembimbing2_id', $user->dosen->id);
            })->with(['skripsi.mahasiswa'])->get();
        } elseif ($user->role === 'mahasiswa') {
            $seminars = Seminar::whereHas('skripsi', function ($query) use ($user) {
                $query->where('mahasiswa_id', $user->mahasiswa->id);
            })->get();
        } else {
            $seminars = Seminar::with(['skripsi.mahasiswa'])->get();
        }

        return view('seminar.index', compact('seminars'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {
            $skripsi = Skripsi::where('mahasiswa_id', $user->mahasiswa->id)
                ->where('status', 'bimbingan')
                ->first();
        } else {
            $skripsis = Skripsi::where('status', 'bimbingan')->with('mahasiswa')->get();
        }

        return view('seminar.create', compact('skripsis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skripsi_id' => 'required|exists:skripsi,id',
            'tanggal_seminar' => 'required|date|after:today',
            'waktu_seminar' => 'required',
            'ruangan' => 'required',
            'jenis_seminar' => 'required|in:proposal,hasil',
            'file_presentasi' => 'required|mimes:pdf,ppt,pptx|max:5120'
        ]);

        $data = $request->all();
        $data['waktu_seminar'] = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->tanggal_seminar . ' ' . $request->waktu_seminar
        );
        $data['status'] = 'terjadwal';

        // Handle file upload
        if ($request->hasFile('file_presentasi')) {
            $file = $request->file('file_presentasi');
            $path = $file->store('seminar/presentasi', 'public');
            $data['file_presentasi'] = $path;
        }

        Seminar::create($data);

        return redirect()->route('seminar.index')
            ->with('success', 'Jadwal seminar berhasil ditambahkan.');
    }

    public function show(Seminar $seminar)
    {
        return view('seminar.show', compact('seminar'));
    }

    public function edit(Seminar $seminar)
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {
            $skripsi = Skripsi::where('mahasiswa_id', $user->mahasiswa->id)->first();
        } else {
            $skripsis = Skripsi::where('status', 'bimbingan')->with('mahasiswa')->get();
        }

        return view('seminar.edit', compact('seminar', 'skripsis'));
    }

    public function update(Request $request, Seminar $seminar)
    {
        $request->validate([
            'tanggal_seminar' => 'required|date',
            'waktu_seminar' => 'required',
            'ruangan' => 'required',
            'status' => 'required|in:terjadwal,selesai,ditunda',
            'catatan' => 'nullable',
            'nilai' => 'nullable|numeric|min:0|max:100',
            'file_presentasi' => 'nullable|mimes:pdf,ppt,pptx|max:5120',
            'file_revisi' => 'nullable|mimes:pdf,doc,docx|max:5120'
        ]);

        $data = $request->all();
        $data['waktu_seminar'] = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->tanggal_seminar . ' ' . $request->waktu_seminar
        );

        // Handle file presentasi
        if ($request->hasFile('file_presentasi')) {
            if ($seminar->file_presentasi) {
                Storage::disk('public')->delete($seminar->file_presentasi);
            }
            $file = $request->file('file_presentasi');
            $path = $file->store('seminar/presentasi', 'public');
            $data['file_presentasi'] = $path;
        }

        // Handle file revisi
        if ($request->hasFile('file_revisi')) {
            if ($seminar->file_revisi) {
                Storage::disk('public')->delete($seminar->file_revisi);
            }
            $file = $request->file('file_revisi');
            $path = $file->store('seminar/revisi', 'public');
            $data['file_revisi'] = $path;
        }

        $seminar->update($data);

        // Update skripsi status if seminar is completed
        if ($request->status === 'selesai') {
            $seminar->skripsi->update(['status' => 'sidang']);
        }

        return redirect()->route('seminar.index')
            ->with('success', 'Data seminar berhasil diperbarui.');
    }

    public function destroy(Seminar $seminar)
    {
        // Delete associated files
        if ($seminar->file_presentasi) {
            Storage::disk('public')->delete($seminar->file_presentasi);
        }
        if ($seminar->file_revisi) {
            Storage::disk('public')->delete($seminar->file_revisi);
        }

        $seminar->delete();
        return redirect()->route('seminar.index')
            ->with('success', 'Data seminar berhasil dihapus.');
    }
}
