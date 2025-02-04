@extends('layouts.app')

@section('title', 'Penjadwalan Sidang')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Penjadwalan Sidang</h3>
                <a href="{{ route('sidang.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('sidang.update', $sidang) }}" method="POST">
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
                            <label class="form-label">Pembimbing 1</label>
                            <p class="form-control-static">{{ $sidang->skripsi->pembimbing1->nama_dosen }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pembimbing 2</label>
                            <p class="form-control-static">{{ $sidang->skripsi->pembimbing2->nama_dosen }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <p class="form-control-static">{{ $sidang->created_at->format('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                id="status" name="status" required>
                                <option value="diajukan" {{ old('status', $sidang->status) == 'diajukan' ? 'selected' : '' }}>
                                    Diajukan
                                </option>
                                <option value="dijadwalkan" {{ old('status', $sidang->status) == 'dijadwalkan' ? 'selected' : '' }}>
                                    Dijadwalkan
                                </option>
                                <option value="ditolak" {{ old('status', $sidang->status) == 'ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="jadwalSection" style="{{ old('status', $sidang->status) != 'dijadwalkan' ? 'display: none;' : '' }}">
                            <div class="mb-3">
                                <label for="tanggal_sidang" class="form-label">Tanggal dan Waktu Sidang</label>
                                <input type="datetime-local" class="form-control @error('tanggal_sidang') is-invalid @enderror"
                                    id="tanggal_sidang" name="tanggal_sidang"
                                    value="{{ old('tanggal_sidang', $sidang->tanggal_sidang ? $sidang->tanggal_sidang->format('Y-m-d\TH:i') : '') }}">
                                @error('tanggal_sidang')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ruang_sidang" class="form-label">Ruang Sidang</label>
                                <select class="form-select @error('ruang_sidang') is-invalid @enderror"
                                    id="ruang_sidang" name="ruang_sidang">
                                    <option value="">Pilih Ruangan</option>
                                    <option value="Ruang Sidang 1" {{ old('ruang_sidang', $sidang->ruang_sidang) == 'Ruang Sidang 1' ? 'selected' : '' }}>
                                        Ruang Sidang 1
                                    </option>
                                    <option value="Ruang Sidang 2" {{ old('ruang_sidang', $sidang->ruang_sidang) == 'Ruang Sidang 2' ? 'selected' : '' }}>
                                        Ruang Sidang 2
                                    </option>
                                    <option value="Ruang Sidang 3" {{ old('ruang_sidang', $sidang->ruang_sidang) == 'Ruang Sidang 3' ? 'selected' : '' }}>
                                        Ruang Sidang 3
                                    </option>
                                </select>
                                @error('ruang_sidang')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ketua_penguji_id" class="form-label">Ketua Penguji</label>
                                <select class="form-select @error('ketua_penguji_id') is-invalid @enderror"
                                    id="ketua_penguji_id" name="ketua_penguji_id">
                                    <option value="">Pilih Ketua Penguji</option>
                                    @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}"
                                        {{ old('ketua_penguji_id', $sidang->ketua_penguji_id) == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('ketua_penguji_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="penguji_id" class="form-label">Penguji</label>
                                <select class="form-select @error('penguji_id') is-invalid @enderror"
                                    id="penguji_id" name="penguji_id">
                                    <option value="">Pilih Penguji</option>
                                    @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}"
                                        {{ old('penguji_id', $sidang->penguji_id) == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('penguji_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keterangan') is-invalid @enderror"
                                id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $sidang->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
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
        // Show/hide jadwal section based on status
        $('#status').change(function() {
            if ($(this).val() === 'dijadwalkan') {
                $('#jadwalSection').show();
                $('#tanggal_sidang, #ruang_sidang, #ketua_penguji_id, #penguji_id').prop('required', true);
            } else {
                $('#jadwalSection').hide();
                $('#tanggal_sidang, #ruang_sidang, #ketua_penguji_id, #penguji_id').prop('required', false);
            }
        });

        // Prevent selecting same dosen for different roles
        $('#ketua_penguji_id, #penguji_id').change(function() {
            let ketua = $('#ketua_penguji_id').val();
            let penguji = $('#penguji_id').val();

            if (ketua && penguji && ketua === penguji) {
                alert('Ketua Penguji dan Penguji tidak boleh sama!');
                $(this).val('');
            }
        });

        // Set minimum date for sidang to tomorrow
        let tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        let dd = String(tomorrow.getDate()).padStart(2, '0');
        let mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
        let yyyy = tomorrow.getFullYear();
        tomorrow = yyyy + '-' + mm + '-' + dd + 'T00:00';
        $('#tanggal_sidang').attr('min', tomorrow);
    });
</script>
@endpush