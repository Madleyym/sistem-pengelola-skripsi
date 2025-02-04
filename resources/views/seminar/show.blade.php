@extends('layouts.app')

@section('title', 'Detail Seminar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Seminar</h3>
                <div>
                    <a href="{{ route('seminar.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->user()->role == 'admin' && $seminar->status == 'diajukan')
                    <a href="{{ route('seminar.edit', $seminar) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Jadwalkan
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
                            <td>{{ $seminar->skripsi->mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $seminar->skripsi->mahasiswa->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $seminar->skripsi->mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>{{ $seminar->skripsi->mahasiswa->prodi->nama_prodi }}</td>
                        </tr>
                    </table>

                    <h4 class="mt-4">Dokumen Persyaratan</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Draft Skripsi</th>
                            <td>
                                <a href="{{ asset('storage/' . $seminar->draft_seminar) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Draft
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Lembar Persetujuan</th>
                            <td>
                                <a href="{{ asset('storage/' . $seminar->lembar_persetujuan) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Kartu Bimbingan</th>
                            <td>
                                <a href="{{ asset('storage/' . $seminar->kartu_bimbingan) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Bukti Artikel</th>
                            <td>
                                <a href="{{ asset('storage/' . $seminar->bukti_artikel) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Informasi Seminar</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Status</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $seminar->status === 'diajukan' ? 'warning' :
                                    ($seminar->status === 'dijadwalkan' ? 'info' :
                                    ($seminar->status === 'selesai' ? 'success' :
                                    ($seminar->status === 'ditolak' ? 'danger' : 'secondary')))
                                }}">
                                    {{ ucfirst($seminar->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ $seminar->created_at->format('d F Y') }}</td>
                        </tr>
                        @if($seminar->tanggal_seminar)
                        <tr>
                            <th>Jadwal Seminar</th>
                            <td>{{ $seminar->tanggal_seminar->format('d F Y H:i') }}</td>
                        </tr>
                        @endif
                        @if($seminar->ruang_seminar)
                        <tr>
                            <th>Ruangan</th>
                            <td>{{ $seminar->ruang_seminar }}</td>
                        </tr>
                        @endif
                    </table>

                    <h4 class="mt-4">Tim Penguji</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Pembimbing 1</th>
                            <td>{{ $seminar->skripsi->pembimbing1->nama_dosen }}</td>
                        </tr>
                        <tr>
                            <th>Pembimbing 2</th>
                            <td>{{ $seminar->skripsi->pembimbing2->nama_dosen }}</td>
                        </tr>
                        @if($seminar->penguji1_id)
                        <tr>
                            <th>Penguji 1</th>
                            <td>{{ $seminar->penguji1->nama_dosen }}</td>
                        </tr>
                        @endif
                        @if($seminar->penguji2_id)
                        <tr>
                            <th>Penguji 2</th>
                            <td>{{ $seminar->penguji2->nama_dosen }}</td>
                        </tr>
                        @endif
                    </table>

                    @if($seminar->keterangan)
                    <div class="mt-4">
                        <h4>Keterangan</h4>
                        <div class="card">
                            <div class="card-body">
                                {{ $seminar->keterangan }}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($seminar->status === 'dijadwalkan')
                    <div class="mt-4">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle"></i> Informasi Penting</h5>
                            <ul class="mb-0">
                                <li>Harap hadir 30 menit sebelum jadwal seminar</li>
                                <li>Memakai pakaian formal (kemeja putih dan celana/rok hitam)</li>
                                <li>Membawa presentasi dan berkas yang diperlukan</li>
                                <li>Seminar akan dibatalkan jika terlambat lebih dari 15 menit</li>
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