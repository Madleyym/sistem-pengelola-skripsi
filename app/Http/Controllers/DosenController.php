<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with(['user', 'jurusan'])->get();
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('dosen.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:dosen',
            'nama_dosen' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jurusan_id' => 'required|exists:jurusan,id',
            'bidang_keahlian' => 'required'
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->nama_dosen,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen'
        ]);

        // Create dosen profile
        Dosen::create([
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'user_id' => $user->id,
            'jurusan_id' => $request->jurusan_id,
            'status' => 'aktif',
            'bidang_keahlian' => $request->bidang_keahlian
        ]);

        return redirect()->route('dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        $jurusans = Jurusan::all();
        return view('dosen.edit', compact('dosen', 'jurusans'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip,' . $dosen->id,
            'nama_dosen' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jurusan_id' => 'required|exists:jurusan,id',
            'bidang_keahlian' => 'required',
            'status' => 'required|in:aktif,tidak_aktif'
        ]);

        $dosen->update($request->all());

        // Update user name if changed
        if ($dosen->user) {
            $dosen->user->update(['name' => $request->nama_dosen]);
        }

        return redirect()->route('dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        // Delete associated user account
        if ($dosen->user) {
            $dosen->user->delete();
        }

        $dosen->delete();
        return redirect()->route('dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
}
