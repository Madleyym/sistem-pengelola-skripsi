@extends('layouts.app')

@section('title', 'Review Bimbingan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Review Bimbingan</h3>
                <a href="{{ route('bimbingan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('bimbingan.update', $bimbingan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Mahasiswa</label>
                            <p class="form-control-static">
                                {{ $bimbingan->skripsi->mahasiswa->nama_mahasiswa }}
                                ({{ $bimbingan->skripsi->mahasiswa->nim }})
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Skripsi</label>
                            <p class="form-control-static">{{ $bimbingan->skripsi->judul_skripsi }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Bimbingan</label>
                            <p class="form-control-static">
                                {{ $bimbingan->tanggal_bimbingan->format('d F Y H:i') }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Metode Bimbingan</label>
                            <p class="form-control-static">
                                {{ $bimbingan->metode_bimbingan == 'online' ? 'Online Meeting' : 'Tatap Muka (Offline)' }}
                            </p>
                        </div>

                        @if($bimbingan->metode_bimbingan == 'online' && $bimbingan->link_meeting)
                        <div class="mb-3">
                            <label class="form-label">Link Meeting</label>
                            <p class="form-control-static">
                                <a href="{{ $bimbingan->link_meeting }}" target="_blank">
                                    {{ $bimbingan->link_meeting }}
                                </a>
                            </p>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Topik Bimbingan</label>
                            <p class="form-control-static">{{ $bimbingan->topik_bimbingan }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <p class="form-control-static">{{ $bimbingan->keterangan }}</p>
                        </div>

                        @if($bimbingan->file_bimbingan)
                        <div class="mb-3">
                            <label class="form-label">File Bimbingan</label>
                            <p class="form-control-static">
                                <a href="{{ asset('storage/' . $bimbingan->file_bimbingan) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file"></i> Lihat File
                                </a>
                            </p>
                        </div>
                        @endif

                        <div class="mb-3">
                            <label for="status" class="form-label">Status Bimbingan</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                                <option value="disetujui" {{ old('status', $bimbingan->status) == 'disetujui' ? 'selected' : '' }}>
                                    Disetujui
                                </option>
                                <option value="ditolak" {{ old('status', $bimbingan->status) == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="catatan_dosen" class="form-label">Catatan/Feedback</label>
                            <textarea class="form-control @error('catatan_dosen') is-invalid @enderror"
                                id="catatan_dosen" name="catatan_dosen" rows="4" required>{{ old('catatan_dosen', $bimbingan->catatan_dosen) }}</textarea>
                            @error('catatan_dosen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection