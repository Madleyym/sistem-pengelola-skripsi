@extends('layouts.app')

@section('title', 'Input Nilai Sidang')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Input Nilai Sidang</h3>
                <a href="{{ route('sidang.show', $sidang) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sidang.update_nilai', $sidang) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Mahasiswa</label>
                            <p class="form-control-static">
                                {{ $sidang->skripsi->mahasiswa->nama_mahasiswa }}
                                ({{ $sidang->skripsi->mahasiswa->nim }})
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Skripsi</label>
                            <p class="form-control-static">{{ $sidang->skripsi->judul_skripsi }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Sidang</label>
                            <p class="form-control-static">{{ $sidang->tanggal_sidang->format('d F Y H:i') }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Penguji</label>
                            <p class="form-control-static">
                                Ketua Penguji: {{ $sidang->ketua_penguji->nama_dosen }}<br>
                                Penguji: {{ $sidang->penguji->nama_dosen }}<br>
                                Pembimbing 1: {{ $sidang->skripsi->pembimbing1->nama_dosen }}<br>
                                Pembimbing 2: {{ $sidang->skripsi->pembimbing2->nama_dosen }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Komponen Penilaian</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="nilai_penulisan" class="form-label">Penulisan Skripsi (30%)</label>
                                    <input type="number" class="form-control nilai @error('nilai_penulisan') is-invalid @enderror"
                                        id="nilai_penulisan" name="nilai_penulisan" min="0" max="100" step="1"
                                        value="{{ old('nilai_penulisan', $nilai->nilai_penulisan ?? '') }}" required>
                                    <small class="text-muted">Sistematika penulisan, tata bahasa, dan format penulisan</small>
                                    @error('nilai_penulisan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nilai_substansi" class="form-label">Substansi (40%)</label>
                                    <input type="number" class="form-control nilai @error('nilai_substansi') is-invalid @enderror"
                                        id="nilai_substansi" name="nilai_substansi" min="0" max="100" step="1"
                                        value="{{ old('nilai_substansi', $nilai->nilai_substansi ?? '') }}" required>
                                    <small class="text-muted">Penguasaan materi, metodologi, dan analisis</small>
                                    @error('nilai_substansi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nilai_presentasi" class="form-label">Presentasi dan Tanya Jawab (30%)</label>
                                    <input type="number" class="form-control nilai @error('nilai_presentasi') is-invalid @enderror"
                                        id="nilai_presentasi" name="nilai_presentasi" min="0" max="100" step="1"
                                        value="{{ old('nilai_presentasi', $nilai->nilai_presentasi ?? '') }}" required>
                                    <small class="text-muted">Kemampuan presentasi dan menjawab pertanyaan</small>
                                    @error('nilai_presentasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nilai Akhir</label>
                                    <input type="text" class="form-control" id="nilai_akhir" readonly>
                                    <small class="text-muted">
                                        A (85-100), A- (80-84), B+ (75-79), B (70-74), B- (65-69), C (60-64), D (<60)
                                            </small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan dan Revisi</label>
                            <textarea class="form-control @error('catatan') is-invalid @enderror"
                                id="catatan" name="catatan" rows="4">{{ old('catatan', $nilai->catatan ?? '') }}</textarea>
                            @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
                            <select class="form-select @error('status_kelulusan') is-invalid @enderror"
                                id="status_kelulusan" name="status_kelulusan" required>
                                <option value="">Pilih Status</option>
                                <option value="lulus" {{ old('status_kelulusan', $sidang->status) == 'lulus' ? 'selected' : '' }}>
                                    Lulus
                                </option>
                                <option value="lulus_revisi" {{ old('status_kelulusan', $sidang->status) == 'lulus_revisi' ? 'selected' : '' }}>
                                    Lulus dengan Revisi
                                </option>
                                <option value="tidak_lulus" {{ old('status_kelulusan', $sidang->status) == 'tidak_lulus' ? 'selected' : '' }}>
                                    Tidak Lulus
                                </option>
                            </select>
                            @error('status_kelulusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Nilai
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
        // Calculate final score
        function calculateFinalScore() {
            let penulisan = parseFloat($('#nilai_penulisan').val()) || 0;
            let substansi = parseFloat($('#nilai_substansi').val()) || 0;
            let presentasi = parseFloat($('#nilai_presentasi').val()) || 0;

            let finalScore = (penulisan * 0.3) + (substansi * 0.4) + (presentasi * 0.3);
            $('#nilai_akhir').val(finalScore.toFixed(2));

            // Auto select status based on score
            if (finalScore >= 60) {
                if ($('#status_kelulusan').val() === 'tidak_lulus') {
                    $('#status_kelulusan').val('lulus_revisi');
                }
            } else {
                $('#status_kelulusan').val('tidak_lulus');
            }
        }

        // Recalculate on any input change
        $('.nilai').on('input', calculateFinalScore);

        // Initial calculation
        calculateFinalScore();

        // Validate input range
        $('.nilai').on('change', function() {
            let value = parseFloat($(this).val());
            if (value < 0) $(this).val(0);
            if (value > 100) $(this).val(100);
        });
    });
</script>
@endpush