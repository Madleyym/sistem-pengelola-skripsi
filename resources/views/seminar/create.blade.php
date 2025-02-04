@extends('layouts.app')

@section('title', 'Ajukan Seminar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Ajukan Seminar</h3>
                <a href="{{ route('seminar.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('seminar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Judul Skripsi</label>
                            <p class="form-control-static">{{ auth()->user()->mahasiswa->skripsi->judul_skripsi }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pembimbing 1</label>
                            <p class="form-control-static">{{ auth()->user()->mahasiswa->skripsi->pembimbing1->nama_dosen }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pembimbing 2</label>
                            <p class="form-control-static">{{ auth()->user()->mahasiswa->skripsi->pembimbing2->nama_dosen }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                            <input type="text" class="form-control" id="tanggal_pengajuan"
                                value="{{ now()->format('d F Y') }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="draft_seminar" class="form-label">Draft Skripsi (PDF)</label>
                            <input type="file" class="form-control @error('draft_seminar') is-invalid @enderror"
                                id="draft_seminar" name="draft_seminar" accept=".pdf" required>
                            <small class="text-muted">Maksimal 10MB</small>
                            @error('draft_seminar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lembar_persetujuan" class="form-label">Lembar Persetujuan Seminar (PDF)</label>
                            <input type="file" class="form-control @error('lembar_persetujuan') is-invalid @enderror"
                                id="lembar_persetujuan" name="lembar_persetujuan" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('lembar_persetujuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kartu_bimbingan" class="form-label">Kartu Bimbingan (PDF)</label>
                            <input type="file" class="form-control @error('kartu_bimbingan') is-invalid @enderror"
                                id="kartu_bimbingan" name="kartu_bimbingan" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('kartu_bimbingan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bukti_artikel" class="form-label">Bukti Submit Artikel (PDF)</label>
                            <input type="file" class="form-control @error('bukti_artikel') is-invalid @enderror"
                                id="bukti_artikel" name="bukti_artikel" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('bukti_artikel')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Persyaratan Seminar:
                            <ul class="mb-0">
                                <li>Telah menyelesaikan minimal 80% dari penulisan skripsi</li>
                                <li>Telah melakukan bimbingan minimal 8 kali dengan dosen pembimbing</li>
                                <li>Telah menyerahkan draft skripsi yang telah disetujui pembimbing</li>
                                <li>Melampirkan lembar persetujuan seminar yang ditandatangani pembimbing</li>
                                <li>Melampirkan kartu bimbingan yang telah ditandatangani pembimbing</li>
                                <li>Melampirkan bukti submit artikel pada jurnal</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Ajukan Seminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Validate file size before upload
        $('input[type="file"]').change(function() {
            const maxSize = $(this).attr('id') === 'draft_seminar' ? 10 : 2;
            if (this.files[0].size > maxSize * 1024 * 1024) {
                alert(`Ukuran file melebihi ${maxSize}MB`);
                $(this).val('');
            }
        });
    });
</script>
@endpush