@extends('layouts.app')

@section('title', 'Ajukan Sidang')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Ajukan Sidang</h3>
                <a href="{{ route('sidang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sidang.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="draft_skripsi" class="form-label">Draft Final Skripsi (PDF)</label>
                            <input type="file" class="form-control @error('draft_skripsi') is-invalid @enderror"
                                id="draft_skripsi" name="draft_skripsi" accept=".pdf" required>
                            <small class="text-muted">Maksimal 10MB</small>
                            @error('draft_skripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lembar_pengesahan" class="form-label">Lembar Pengesahan (PDF)</label>
                            <input type="file" class="form-control @error('lembar_pengesahan') is-invalid @enderror"
                                id="lembar_pengesahan" name="lembar_pengesahan" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('lembar_pengesahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
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
                            <label for="bukti_publikasi" class="form-label">Bukti Publikasi Artikel (PDF)</label>
                            <input type="file" class="form-control @error('bukti_publikasi') is-invalid @enderror"
                                id="bukti_publikasi" name="bukti_publikasi" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('bukti_publikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bebas_plagiasi" class="form-label">Surat Bebas Plagiasi (PDF)</label>
                            <input type="file" class="form-control @error('bebas_plagiasi') is-invalid @enderror"
                                id="bebas_plagiasi" name="bebas_plagiasi" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('bebas_plagiasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bukti_spp" class="form-label">Bukti Pembayaran SPP (PDF)</label>
                            <input type="file" class="form-control @error('bukti_spp') is-invalid @enderror"
                                id="bukti_spp" name="bukti_spp" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('bukti_spp')
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
                            <i class="fas fa-info-circle"></i> Persyaratan Sidang:
                            <ul class="mb-0">
                                <li>Telah menyelesaikan seminar proposal dan revisi</li>
                                <li>Telah menyelesaikan penulisan skripsi</li>
                                <li>Telah melakukan bimbingan minimal 12 kali</li>
                                <li>Telah mendapatkan persetujuan pembimbing</li>
                                <li>Memiliki bukti publikasi artikel ilmiah</li>
                                <li>Bebas plagiasi (maksimal 25%)</li>
                                <li>Tidak memiliki tunggakan SPP</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Ajukan Sidang
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
            const maxSize = $(this).attr('id') === 'draft_skripsi' ? 10 : 2;
            if (this.files[0].size > maxSize * 1024 * 1024) {
                alert(`Ukuran file melebihi ${maxSize}MB`);
                $(this).val('');
            }
        });
    });
</script>
@endpush