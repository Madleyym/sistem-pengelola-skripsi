@extends('layouts.app')

@section('title', 'Ajukan Bimbingan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Ajukan Bimbingan</h3>
                <a href="{{ route('bimbingan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('bimbingan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="dosen_id" class="form-label">Pilih Pembimbing</label>
                            <select class="form-select @error('dosen_id') is-invalid @enderror"
                                id="dosen_id" name="dosen_id" required>
                                <option value="">Pilih Pembimbing</option>
                                <option value="{{ auth()->user()->mahasiswa->skripsi->pembimbing1_id }}"
                                    {{ old('dosen_id') == auth()->user()->mahasiswa->skripsi->pembimbing1_id ? 'selected' : '' }}>
                                    {{ auth()->user()->mahasiswa->skripsi->pembimbing1->nama_dosen }} (Pembimbing 1)
                                </option>
                                <option value="{{ auth()->user()->mahasiswa->skripsi->pembimbing2_id }}"
                                    {{ old('dosen_id') == auth()->user()->mahasiswa->skripsi->pembimbing2_id ? 'selected' : '' }}>
                                    {{ auth()->user()->mahasiswa->skripsi->pembimbing2->nama_dosen }} (Pembimbing 2)
                                </option>
                            </select>
                            @error('dosen_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_bimbingan" class="form-label">Tanggal dan Waktu Bimbingan</label>
                            <input type="datetime-local" class="form-control @error('tanggal_bimbingan') is-invalid @enderror"
                                id="tanggal_bimbingan" name="tanggal_bimbingan"
                                value="{{ old('tanggal_bimbingan') }}" required>
                            @error('tanggal_bimbingan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metode_bimbingan" class="form-label">Metode Bimbingan</label>
                            <select class="form-select @error('metode_bimbingan') is-invalid @enderror"
                                id="metode_bimbingan" name="metode_bimbingan" required>
                                <option value="">Pilih Metode Bimbingan</option>
                                <option value="offline" {{ old('metode_bimbingan') == 'offline' ? 'selected' : '' }}>
                                    Tatap Muka (Offline)
                                </option>
                                <option value="online" {{ old('metode_bimbingan') == 'online' ? 'selected' : '' }}>
                                    Online Meeting
                                </option>
                            </select>
                            @error('metode_bimbingan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="linkMeetingField" class="mb-3" style="display: none;">
                            <label for="link_meeting" class="form-label">Link Meeting</label>
                            <input type="url" class="form-control @error('link_meeting') is-invalid @enderror"
                                id="link_meeting" name="link_meeting" value="{{ old('link_meeting') }}"
                                placeholder="https://meet.google.com/...">
                            @error('link_meeting')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="topik_bimbingan" class="form-label">Topik Bimbingan</label>
                            <input type="text" class="form-control @error('topik_bimbingan') is-invalid @enderror"
                                id="topik_bimbingan" name="topik_bimbingan"
                                value="{{ old('topik_bimbingan') }}" required>
                            @error('topik_bimbingan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan/Deskripsi</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" name="keterangan" rows="4" required>{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file_bimbingan" class="form-label">File Bimbingan</label>
                            <input type="file" class="form-control @error('file_bimbingan') is-invalid @enderror"
                                id="file_bimbingan" name="file_bimbingan" accept=".pdf,.doc,.docx">
                            <small class="text-muted">Format: PDF, DOC, DOCX. Maksimal 5MB</small>
                            @error('file_bimbingan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Ajukan Bimbingan
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
        // Show/hide link meeting field based on metode_bimbingan
        $('#metode_bimbingan').change(function() {
            if ($(this).val() === 'online') {
                $('#linkMeetingField').show();
                $('#link_meeting').prop('required', true);
            } else {
                $('#linkMeetingField').hide();
                $('#link_meeting').prop('required', false);
            }
        });

        // Set minimum date for tanggal_bimbingan to today
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd + 'T00:00';
        $('#tanggal_bimbingan').attr('min', today);
    });
</script>
@endpush