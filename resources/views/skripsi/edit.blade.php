@extends('layouts.app')

@section('title', 'Edit Skripsi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Edit Skripsi</h3>
                <a href="{{ route('skripsi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('skripsi.update', $skripsi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="judul_skripsi" class="form-label">Judul Skripsi</label>
                            <input type="text" class="form-control @error('judul_skripsi') is-invalid @enderror"
                                id="judul_skripsi" name="judul_skripsi"
                                value="{{ old('judul_skripsi', $skripsi->judul_skripsi) }}" required>
                            @error('judul_skripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi/Latar Belakang</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $skripsi->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pembimbing1_id" class="form-label">Pembimbing 1</label>
                            <select class="form-select @error('pembimbing1_id') is-invalid @enderror"
                                id="pembimbing1_id" name="pembimbing1_id" required>
                                <option value="">Pilih Pembimbing 1</option>
                                @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}"
                                    {{ old('pembimbing1_id', $skripsi->pembimbing1_id) == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama_dosen }} - {{ $dosen->bidang_keahlian }}
                                </option>
                                @endforeach
                            </select>
                            @error('pembimbing1_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pembimbing2_id" class="form-label">Pembimbing 2</label>
                            <select class="form-select @error('pembimbing2_id') is-invalid @enderror"
                                id="pembimbing2_id" name="pembimbing2_id" required>
                                <option value="">Pilih Pembimbing 2</option>
                                @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}"
                                    {{ old('pembimbing2_id', $skripsi->pembimbing2_id) == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama_dosen }} - {{ $dosen->bidang_keahlian }}
                                </option>
                                @endforeach
                            </select>
                            @error('pembimbing2_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="proposal" class="form-label">File Proposal (PDF)</label>
                            @if($skripsi->proposal)
                            <div class="mb-2">
                                <a href="{{ asset('storage/' . $skripsi->proposal) }}" target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Proposal Saat Ini
                                </a>
                            </div>
                            @endif
                            <input type="file" class="form-control @error('proposal') is-invalid @enderror"
                                id="proposal" name="proposal" accept=".pdf">
                            <small class="text-muted">Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah file.</small>
                            @error('proposal')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bidang_skripsi" class="form-label">Bidang Skripsi</label>
                            <select class="form-select @error('bidang_skripsi') is-invalid @enderror"
                                id="bidang_skripsi" name="bidang_skripsi" required>
                                <option value="">Pilih Bidang</option>
                                <option value="Artificial Intelligence"
                                    {{ old('bidang_skripsi', $skripsi->bidang_skripsi) == 'Artificial Intelligence' ? 'selected' : '' }}>
                                    Artificial Intelligence
                                </option>
                                <option value="Web Development"
                                    {{ old('bidang_skripsi', $skripsi->bidang_skripsi) == 'Web Development' ? 'selected' : '' }}>
                                    Web Development
                                </option>
                                <option value="Mobile Development"
                                    {{ old('bidang_skripsi', $skripsi->bidang_skripsi) == 'Mobile Development' ? 'selected' : '' }}>
                                    Mobile Development
                                </option>
                                <option value="Data Science"
                                    {{ old('bidang_skripsi', $skripsi->bidang_skripsi) == 'Data Science' ? 'selected' : '' }}>
                                    Data Science
                                </option>
                                <option value="Network Security"
                                    {{ old('bidang_skripsi', $skripsi->bidang_skripsi) == 'Network Security' ? 'selected' : '' }}>
                                    Network Security
                                </option>
                            </select>
                            @error('bidang_skripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="metode_penelitian" class="form-label">Metode Penelitian</label>
                            <input type="text" class="form-control @error('metode_penelitian') is-invalid @enderror"
                                id="metode_penelitian" name="metode_penelitian"
                                value="{{ old('metode_penelitian', $skripsi->metode_penelitian) }}" required>
                            @error('metode_penelitian')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'dosen')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Skripsi</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                                <option value="diajukan" {{ old('status', $skripsi->status) == 'diajukan' ? 'selected' : '' }}>
                                    Diajukan
                                </option>
                                <option value="diterima" {{ old('status', $skripsi->status) == 'diterima' ? 'selected' : '' }}>
                                    Diterima
                                </option>
                                <option value="ditolak" {{ old('status', $skripsi->status) == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                                <option value="selesai" {{ old('status', $skripsi->status) == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan/Catatan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $skripsi->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Prevent selecting same dosen for both pembimbing
        $('#pembimbing1_id, #pembimbing2_id').change(function() {
            let pembimbing1 = $('#pembimbing1_id').val();
            let pembimbing2 = $('#pembimbing2_id').val();

            if (pembimbing1 && pembimbing2 && pembimbing1 === pembimbing2) {
                alert('Pembimbing 1 dan Pembimbing 2 tidak boleh sama!');
                $(this).val('');
            }
        });
    });
</script>
@endpush