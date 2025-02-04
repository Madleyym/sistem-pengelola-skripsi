@extends('layouts.app')

@section('title', 'Detail Sidang')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Sidang</h3>
                <div>
                    <a href="{{ route('sidang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->user()->role == 'admin' && $sidang->status == 'diajukan')
                    <a href="{{ route('sidang.edit', $sidang) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Jadwalkan
                    </a>
                    @endif
                    @if(auth()->user()->role == 'dosen' &&
                    in_array(auth()->user()->dosen->id, [
                    $sidang->ketua_penguji_id,
                    $sidang->penguji_id,
                    $sidang->skripsi->pembimbing1_id,
                    $sidang->skripsi->pembimbing2_id
                    ]) &&
                    $sidang->status == 'dijadwalkan')
                    <a href="{{ route('sidang.nilai', $sidang) }}" class="btn btn-primary">
                        <i class="fas fa-star"></i> Input Nilai
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Informasi Mahasiswa</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">NIM</th>
                            <td>{{ $sidang->skripsi->mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $sidang->skripsi->mahasiswa->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $sidang->skripsi->mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>{{ $sidang->skripsi->mahasiswa->prodi->nama_prodi }}</td>
                        </tr>
                    </table>

                    <h4 class="mt-4">Dokumen Persyaratan</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Draft Skripsi</th>
                            <td>
                                <a href="{{ asset('storage/' . $sidang->draft_skripsi) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Draft
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Lembar Pengesahan</th>
                            <td>
                                <a href="{{ asset('storage/' . $sidang->lembar_pengesahan) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Kartu Bimbingan</th>
                            <td>
                                <a href="{{ asset('storage/' . $sidang->kartu_bimbingan) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Bukti Publikasi</th>
                            <td>
                                <a href="{{ asset('storage/' . $sidang->bukti_publikasi) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Bebas Plagiasi</th>
                            <td>
                                <a href="{{ asset('storage/' . $sidang->bebas_plagiasi) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Bukti SPP</th>
                            <td>
                                <a href="{{ asset('storage/' . $sidang->bukti_spp) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Informasi Sidang</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Status</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $sidang->status === 'diajukan' ? 'warning' :
                                    ($sidang->status === 'dijadwalkan' ? 'info' :
                                    ($sidang->status === 'lulus' ? 'success' :
                                    ($sidang->status === 'tidak_lulus' ? 'danger' :
                                    ($sidang->status === 'ditolak' ? 'danger' : 'secondary'))))
                                }}">
                                    {{ ucfirst(str_replace('_', ' ', $sidang->status)) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ $sidang->created_at->format('d F Y') }}</td>
                        </tr>
                        @if($sidang->tanggal_sidang)
                        <tr>
                            <th>Jadwal Sidang</th>
                            <td>{{ $sidang->tanggal_sidang->format('d F Y H:i') }}</td>
                        </tr>
                        @endif
                        @if($sidang->ruang_sidang)
                        <tr>
                            <th>Ruangan</th>
                            <td>{{ $sidang->ruang_sidang }}</td>
                        </tr>
                        @endif
                    </table>

                    <h4 class="mt-4">Tim Penguji</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Pembimbing 1</th>
                            <td>{{ $sidang->skripsi->pembimbing1->nama_dosen }}</td>
                        </tr>
                        <tr>
                            <th>Pembimbing 2</th>
                            <td>{{ $sidang->skripsi->pembimbing2->nama_dosen }}</td>
                        </tr>
                        @if($sidang->ketua_penguji_id)
                        <tr>
                            <th>Ketua Penguji</th>
                            <td>{{ $sidang->ketua_penguji->nama_dosen }}</td>
                        </tr>
                        @endif
                        @if($sidang->penguji_id)
                        <tr>
                            <th>Penguji</th>
                            <td>{{ $sidang->penguji->nama_dosen }}</td>
                        </tr>
                        @endif
                    </table>

                    @if($sidang->nilai)
                    <h4 class="mt-4">Nilai Sidang</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Nilai Akhir</th>
                            <td>
                                {{ $sidang->nilai }}
                                @if($sidang->nilai >= 85)
                                (A)
                                @elseif($sidang->nilai >= 80)
                                (A-)
                                @elseif($sidang->nilai >= 75)
                                (B+)
                                @elseif($sidang->nilai >= 70)
                                (B)
                                @elseif($sidang->nilai >= 65)
                                (B-)
                                @elseif($sidang->nilai >= 60)
                                (C)
                                @else
                                (D)
                                @endif
                            </td>
                        </tr>
                    </table>
                    @endif

                    @if($sidang->keterangan)
                    <div class="mt-4">
                        <h4>Keterangan</h4>
                        <div class="card">
                            <div class="card-body">
                                {{ $sidang->keterangan }}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($sidang->status === 'dijadwalkan')
                    <div class="mt-4">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle"></i> Informasi Penting</h5>
                            <ul class="mb-0">
                                <li>Hadir 30 menit sebelum jadwal sidang</li>
                                <li>Berpakaian formal (kemeja putih, celana/rok hitam, dasi hitam)</li>
                                <li>Membawa presentasi dan berkas yang diperlukan</li>
                                <li>Membawa buku skripsi yang sudah dijilid</li>
                                <li>Sidang akan dibatalkan jika terlambat lebih dari 15 menit</li>
                            </ul>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection