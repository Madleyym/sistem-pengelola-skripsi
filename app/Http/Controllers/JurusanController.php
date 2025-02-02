<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_jurusan' => 'required|unique:jurusan',
            'nama_jurusan' => 'required',
            'kepala_jurusan' => 'required',
            'akreditasi' => 'required'
        ]);

        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kode_jurusan' => 'required|unique:jurusan,kode_jurusan,' . $jurusan->id,
            'nama_jurusan' => 'required',
            'kepala_jurusan' => 'required',
            'akreditasi' => 'required'
        ]);

        $jurusan->update($request->all());
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('jurusan.index')
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}
