@extends('layouts.app')

@section('title', 'Detail Bimbingan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Bimbingan</h3>
                <div>
                    <a href="{{ route('bimbingan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->user()->role == 'dosen' && $bimbingan->status == 'menunggu')
                    <a href="{{ route('bimbingan.edit', $bimbingan) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Review
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
                            <td>{{ $bimbingan->skripsi->mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $bimbingan->skripsi->mahasiswa->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $bimbingan->skripsi->mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                    </table>

                    <h4 class="mt-4">Informasi Skripsi</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Judul</th>
                            <td>{{ $bimbingan->skripsi->judul_skripsi }}</td>
                        </tr>
                        <tr>
                            <th>Pembimbing</th>
                            <td>{{ $bimbingan->dosen->nama_dosen }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Detail Bimbingan</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Tanggal</th>
                            <td>{{ $bimbingan->tanggal_bimbingan->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $bimbingan->status === 'menunggu' ? 'warning' :
                                    ($bimbingan->status === 'disetujui' ? 'success' :
                                    ($bimbingan->status === 'ditolak' ? 'danger' : 'info'))
                                }}">
                                    {{ ucfirst($bimbingan->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Metode</th>
                            <td>{{ $bimbingan->metode_bimbingan == 'online' ? 'Online Meeting' : 'Tatap Muka (Offline)' }}</td>
                        </tr>
                        @if($bimbingan->metode_bimbingan == 'online' && $bimbingan->link_meeting)
                        <tr>
                            <th>Link Meeting</th>
                            <td>
                                <a href="{{ $bimbingan->link_meeting }}" target="_blank">
                                    {{ $bimbingan->link_meeting }}
                                </a>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <th>Topik</th>
                            <td>{{ $bimbingan->topik_bimbingan }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h4>Keterangan Mahasiswa</h4>
                        <p>{{ $bimbingan->keterangan }}</p>
                    </div>

                    @if($bimbingan->file_bimbingan)
                    <div class="mt-4">
                        <h4>File Bimbingan</h4>
                        <a href="{{ asset('storage/' . $bimbingan->file_bimbingan) }}"
                            target="_blank" class="btn btn-info">
                            <i class="fas fa-file"></i> Lihat File Bimbingan
                        </a>
                    </div>
                    @endif

                    @if($bimbingan->status != 'menunggu')
                    <div class="mt-4">
                        <h4>Catatan Dosen</h4>
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-0">{{ $bimbingan->catatan_dosen }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            @if($bimbingan->status == 'disetujui')
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        Bimbingan ini telah disetujui oleh dosen pembimbing pada
                        {{ $bimbingan->updated_at->format('d F Y H:i') }}
                    </div>
                </div>
            </div>
            @elseif($bimbingan->status == 'ditolak')
            <div class="row mt-4">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle"></i>
                        Bimbingan ini ditolak oleh dosen pembimbing.
                        Silakan perhatikan catatan dosen dan ajukan bimbingan baru.
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection