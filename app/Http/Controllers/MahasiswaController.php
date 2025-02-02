<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with(['user', 'jurusan'])->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama_mahasiswa' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jurusan_id' => 'required|exists:jurusan,id',
            'angkatan' => 'required|numeric'
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->nama_mahasiswa,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa'
        ]);

        // Create mahasiswa profile
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'user_id' => $user->id,
            'jurusan_id' => $request->jurusan_id,
            'angkatan' => $request->angkatan,
            'status' => 'aktif'
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $jurusans = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusans'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama_mahasiswa' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jurusan_id' => 'required|exists:jurusan,id',
            'angkatan' => 'required|numeric',
            'status' => 'required|in:aktif,tidak_aktif,lulus,cuti'
        ]);

        $mahasiswa->update($request->all());

        // Update user name if changed
        if ($mahasiswa->user) {
            $mahasiswa->user->update(['name' => $request->nama_mahasiswa]);
        }

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        // Delete associated user account
        if ($mahasiswa->user) {
            $mahasiswa->user->delete();
        }

        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    // Method tambahan untuk dashboard mahasiswa
    public function dashboard()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $skripsi = $mahasiswa->skripsi;

        return view('mahasiswa.dashboard', compact('mahasiswa', 'skripsi'));
    }
}
