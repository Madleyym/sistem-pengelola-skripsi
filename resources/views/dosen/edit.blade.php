@extends('layouts.app')

@section('title', 'Edit Dosen')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Edit Dosen</h3>
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('dosen.update', $dosen) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                id="nip" name="nip" value="{{ old('nip', $dosen->nip) }}" required>
                            @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_dosen" class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control @error('nama_dosen') is-invalid @enderror"
                                id="nama_dosen" name="nama_dosen" value="{{ old('nama_dosen', $dosen->nama_dosen) }}" required>
                            @error('nama_dosen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                                id="no_telp" name="no_telp" value="{{ old('no_telp', $dosen->no_telp) }}" required>
                            @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label">Jurusan</label>
                            <select class="form-select @error('jurusan_id') is-invalid @enderror"
                                id="jurusan_id" name="jurusan_id" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    {{ old('jurusan_id', $dosen->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
                            <input type="text" class="form-control @error('bidang_keahlian') is-invalid @enderror"
                                id="bidang_keahlian" name="bidang_keahlian"
                                value="{{ old('bidang_keahlian', $dosen->bidang_keahlian) }}" required>
                            @error('bidang_keahlian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" rows="3">{{ old('alamat', $dosen->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                                <option value="aktif" {{ old('status', $dosen->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ old('status', $dosen->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection