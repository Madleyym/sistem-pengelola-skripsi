<?php

namespace App\Http\Controllers;

use App\Models\Sidang;
use App\Models\Skripsi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SidangController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'dosen') {
            $sidangs = Sidang::where(function ($query) use ($user) {
                $query->where('penguji1_id', $user->dosen->id)
                    ->orWhere('penguji2_id', $user->dosen->id)
                    ->orWhere('penguji3_id', $user->dosen->id);
            })->with(['skripsi.mahasiswa', 'penguji1', 'penguji2', 'penguji3'])->get();
        } elseif ($user->role === 'mahasiswa') {
            $sidangs = Sidang::whereHas('skripsi', function ($query) use ($user) {
                $query->where('mahasiswa_id', $user->mahasiswa->id);
            })->with(['penguji1', 'penguji2', 'penguji3'])->get();
        } else {
            $sidangs = Sidang::with(['skripsi.mahasiswa', 'penguji1', 'penguji2', 'penguji3'])->get();
        }

        return view('sidang.index', compact('sidangs'));
    }

    public function create()
    {
        $skripsis = Skripsi::where('status', 'sidang')->with('mahasiswa')->get();
        $dosens = Dosen::where('status', 'aktif')->get();

        return view('sidang.create', compact('skripsis', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'skripsi_id' => 'required|exists:skripsi,id',
            'tanggal_sidang' => 'required|date|after:today',
            'waktu_sidang' => 'required',
            'ruangan' => 'required',
            'penguji1_id' => 'required|exists:dosen,id',
            'penguji2_id' => 'required|exists:dosen,id|different:penguji1_id',
            'penguji3_id' => 'required|exists:dosen,id|different:penguji1_id|different:penguji2_id'
        ]);

        $data = $request->all();
        $data['waktu_sidang'] = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->tanggal_sidang . ' ' . $request->waktu_sidang
        );
        $data['status'] = 'terjadwal';

        Sidang::create($data);

        return redirect()->route('sidang.index')
            ->with('success', 'Jadwal sidang berhasil ditambahkan.');
    }

    public function show(Sidang $sidang)
    {
        return view('sidang.show', compact('sidang'));
    }

    public function edit(Sidang $sidang)
    {
        $skripsis = Skripsi::where('status', 'sidang')->with('mahasiswa')->get();
        $dosens = Dosen::where('status', 'aktif')->get();

        return view('sidang.edit', compact('sidang', 'skripsis', 'dosens'));
    }

    public function update(Request $request, Sidang $sidang)
    {
        $request->validate([
            'tanggal_sidang' => 'required|date',
            'waktu_sidang' => 'required',
            'ruangan' => 'required',
            'status' => 'required|in:terjadwal,berlangsung,selesai,ditunda',
            'nilai_penguji1' => 'nullable|numeric|min:0|max:100',
            'nilai_penguji2' => 'nullable|numeric|min:0|max:100',
            'nilai_penguji3' => 'nullable|numeric|min:0|max:100',
            'catatan' => 'nullable',
            'file_revisi_final' => 'nullable|mimes:pdf|max:5120'
        ]);

        $data = $request->all();
        $data['waktu_sidang'] = Carbon::createFromFormat(
            'Y-m-d H:i',
            $request->tanggal_sidang . ' ' . $request->waktu_sidang
        );

        // Calculate final grade if all grades are present
        if ($request->nilai_penguji1 && $request->nilai_penguji2 && $request->nilai_penguji3) {
            $data['nilai_akhir'] = ($request->nilai_penguji1 + $request->nilai_penguji2 + $request->nilai_penguji3) / 3;
        }

        // Handle file upload
        if ($request->hasFile('file_revisi_final')) {
            if ($sidang->file_revisi_final) {
                Storage::disk('public')->delete($sidang->file_revisi_final);
            }
            $file = $request->file('file_revisi_final');
            $path = $file->store('sidang/revisi', 'public');
            $data['file_revisi_final'] = $path;
        }

        $sidang->update($data);

        // Update skripsi status if sidang is completed
        if ($request->status === 'selesai') {
            $sidang->skripsi->update(['status' => 'selesai']);
        }

        return redirect()->route('sidang.index')
            ->with('success', 'Data sidang berhasil diperbarui.');
    }

    public function destroy(Sidang $sidang)
    {
        // Delete associated file
        if ($sidang->file_revisi_final) {
            Storage::disk('public')->delete($sidang->file_revisi_final);
        }

        $sidang->delete();
        return redirect()->route('sidang.index')
            ->with('success', 'Data sidang berhasil dihapus.');
    }
}
