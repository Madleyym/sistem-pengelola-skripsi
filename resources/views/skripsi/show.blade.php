@extends('layouts.app')

@section('title', 'Detail Skripsi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Skripsi</h3>
                <div>
                    <a href="{{ route('skripsi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    @if(auth()->user()->role == 'admin' ||
                    (auth()->user()->role == 'mahasiswa' &&
                    auth()->user()->mahasiswa->id == $skripsi->mahasiswa_id &&
                    $skripsi->status == 'diajukan'))
                    <a href="{{ route('skripsi.edit', $skripsi) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
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
                            <td>{{ $skripsi->mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $skripsi->mahasiswa->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $skripsi->mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Angkatan</th>
                            <td>{{ $skripsi->mahasiswa->angkatan }}</td>
                        </tr>
                    </table>

                    <h4 class="mt-4">Pembimbing</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Pembimbing 1</th>
                            <td>
                                {{ $skripsi->pembimbing1->nama_dosen }}<br>
                                <small class="text-muted">{{ $skripsi->pembimbing1->bidang_keahlian }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Pembimbing 2</th>
                            <td>
                                {{ $skripsi->pembimbing2->nama_dosen }}<br>
                                <small class="text-muted">{{ $skripsi->pembimbing2->bidang_keahlian }}</small>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <h4>Informasi Skripsi</h4>
                    <table class="table">
                        <tr>
                            <th width="30%">Judul Skripsi</th>
                            <td>{{ $skripsi->judul_skripsi }}</td>
                        </tr>
                        <tr>
                            <th>Bidang</th>
                            <td>{{ $skripsi->bidang_skripsi }}</td>
                        </tr>
                        <tr>
                            <th>Metode Penelitian</th>
                            <td>{{ $skripsi->metode_penelitian }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $skripsi->status === 'diajukan' ? 'warning' :
                                    ($skripsi->status === 'diterima' ? 'success' :
                                    ($skripsi->status === 'ditolak' ? 'danger' :
                                    ($skripsi->status === 'selesai' ? 'info' : 'secondary')))
                                }}">
                                    {{ ucfirst($skripsi->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <td>{{ $skripsi->created_at->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>File Proposal</th>
                            <td>
                                @if($skripsi->proposal)
                                <a href="{{ asset('storage/' . $skripsi->proposal) }}"
                                    target="_blank" class="btn btn-sm btn-info">
                                    <i class="fas fa-file-pdf"></i> Lihat Proposal
                                </a>
                                @else
                                <span class="text-muted">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h4>Deskripsi</h4>
                        <p>{{ $skripsi->deskripsi }}</p>
                    </div>

                    @if($skripsi->keterangan)
                    <div class="mt-4">
                        <h4>Keterangan/Catatan</h4>
                        <p>{{ $skripsi->keterangan }}</p>
                    </div>
                    @endif
                </div>
            </div>

            @if($skripsi->bimbingans->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <h4>Riwayat Bimbingan</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Pembimbing</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($skripsi->bimbingans as $bimbingan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bimbingan->tanggal_bimbingan->format('d F Y') }}</td>
                                    <td>{{ $bimbingan->dosen->nama_dosen }}</td>
                                    <td>{{ $bimbingan->catatan }}</td>
                                    <td>
                                        <span class="badge bg-{{ $bimbingan->status == 'disetujui' ? 'success' : 'warning' }}">
                                            {{ ucfirst($bimbingan->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection