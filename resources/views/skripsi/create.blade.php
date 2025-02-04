@extends('layouts.app')

@section('title', 'Ajukan Skripsi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Ajukan Skripsi</h3>
                <a href="{{ route('skripsi.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('skripsi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <p class="form-control-static">{{ auth()->user()->mahasiswa->nim }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Mahasiswa</label>
                            <p class="form-control-static">{{ auth()->user()->mahasiswa->nama_mahasiswa }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <p class="form-control-static">{{ auth()->user()->mahasiswa->prodi->nama_prodi }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="judul_skripsi" class="form-label">Judul Skripsi</label>
                            <input type="text" class="form-control @error('judul_skripsi') is-invalid @enderror"
                                id="judul_skripsi" name="judul_skripsi" value="{{ old('judul_skripsi') }}" required>
                            @error('judul_skripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bidang_skripsi" class="form-label">Bidang/Topik Skripsi</label>
                            <select class="form-select @error('bidang_skripsi') is-invalid @enderror"
                                id="bidang_skripsi" name="bidang_skripsi" required>
                                <option value="">Pilih Bidang</option>
                                <option value="Artificial Intelligence" {{ old('bidang_skripsi') == 'Artificial Intelligence' ? 'selected' : '' }}>
                                    Artificial Intelligence
                                </option>
                                <option value="Data Science" {{ old('bidang_skripsi') == 'Data Science' ? 'selected' : '' }}>
                                    Data Science
                                </option>
                                <option value="Software Engineering" {{ old('bidang_skripsi') == 'Software Engineering' ? 'selected' : '' }}>
                                    Software Engineering
                                </option>
                                <option value="Network Security" {{ old('bidang_skripsi') == 'Network Security' ? 'selected' : '' }}>
                                    Network Security
                                </option>
                                <option value="Mobile Computing" {{ old('bidang_skripsi') == 'Mobile Computing' ? 'selected' : '' }}>
                                    Mobile Computing
                                </option>
                            </select>
                            @error('bidang_skripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi Penelitian</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pembimbing1_id" class="form-label">Pembimbing 1</label>
                            <select class="form-select @error('pembimbing1_id') is-invalid @enderror"
                                id="pembimbing1_id" name="pembimbing1_id" required>
                                <option value="">Pilih Pembimbing 1</option>
                                @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}"
                                    {{ old('pembimbing1_id') == $dosen->id ? 'selected' : '' }}>
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
                                    {{ old('pembimbing2_id') == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->nama_dosen }} - {{ $dosen->bidang_keahlian }}
                                </option>
                                @endforeach
                            </select>
                            @error('pembimbing2_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="proposal_skripsi" class="form-label">Proposal Skripsi (PDF)</label>
                            <input type="file" class="form-control @error('proposal_skripsi') is-invalid @enderror"
                                id="proposal_skripsi" name="proposal_skripsi" accept=".pdf" required>
                            <small class="text-muted">Maksimal 5MB</small>
                            @error('proposal_skripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="krs" class="form-label">KRS Semester Berjalan (PDF)</label>
                            <input type="file" class="form-control @error('krs') is-invalid @enderror"
                                id="krs" name="krs" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('krs')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="transkrip" class="form-label">Transkrip Nilai (PDF)</label>
                            <input type="file" class="form-control @error('transkrip') is-invalid @enderror"
                                id="transkrip" name="transkrip" accept=".pdf" required>
                            <small class="text-muted">Maksimal 2MB</small>
                            @error('transkrip')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Persyaratan Pengajuan Skripsi:
                            <ul class="mb-0">
                                <li>Telah menyelesaikan minimal 120 SKS</li>
                                <li>IPK minimal 2.50</li>
                                <li>Telah lulus mata kuliah Metodologi Penelitian</li>
                                <li>Melampirkan proposal penelitian</li>
                                <li>Melampirkan KRS semester berjalan</li>
                                <li>Melampirkan transkrip nilai</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Ajukan Skripsi
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
            const maxSize = $(this).attr('id') === 'proposal_skripsi' ? 5 : 2;
            if (this.files[0].size > maxSize * 1024 * 1024) {
                alert(`Ukuran file melebihi ${maxSize}MB`);
                $(this).val('');
            }
        });

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