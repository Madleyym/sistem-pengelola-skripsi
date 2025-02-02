@extends('layouts.app')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Tambah Jurusan</h3>
                <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('jurusan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                    <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror"
                        id="kode_jurusan" name="kode_jurusan" value="{{ old('kode_jurusan') }}" required>
                    @error('kode_jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                    <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror"
                        id="nama_jurusan" name="nama_jurusan" value="{{ old('nama_jurusan') }}" required>
                    @error('nama_jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kepala_jurusan" class="form-label">Kepala Jurusan</label>
                    <input type="text" class="form-control @error('kepala_jurusan') is-invalid @enderror"
                        id="kepala_jurusan" name="kepala_jurusan" value="{{ old('kepala_jurusan') }}" required>
                    @error('kepala_jurusan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="akreditasi" class="form-label">Akreditasi</label>
                    <select class="form-select @error('akreditasi') is-invalid @enderror"
                        id="akreditasi" name="akreditasi" required>
                        <option value="">Pilih Akreditasi</option>
                        <option value="A" {{ old('akreditasi') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('akreditasi') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('akreditasi') == 'C' ? 'selected' : '' }}>C</option>
                    </select>
                    @error('akreditasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                        id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="status_aktif"
                            name="status_aktif" value="1" {{ old('status_aktif') ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_aktif">
                            Status Aktif
                        </label>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection