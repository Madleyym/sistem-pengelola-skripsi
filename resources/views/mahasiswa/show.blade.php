@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Detail Mahasiswa</h3>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="30%">NIM</th>
                            <td>{{ $mahasiswa->nim }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $mahasiswa->nama_mahasiswa }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $mahasiswa->email }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>{{ $mahasiswa->no_telp }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="30%">Jurusan</th>
                            <td>{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Angkatan</th>
                            <td>{{ $mahasiswa->angkatan }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{
                                    $mahasiswa->status === 'aktif' ? 'success' :
                                    ($mahasiswa->status === 'cuti' ? 'warning' :
                                    ($mahasiswa->status === 'lulus' ? 'info' : 'danger'))
                                }}">
                                    {{ ucfirst($mahasiswa->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $mahasiswa->alamat }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($mahasiswa->skripsi)
            <div class="mt-4">
                <h4>Data Skripsi</h4>
                <table class="table">
                    <tr>
                        <th width="20%">Judul Skripsi</th>
                        <td>{{ $mahasiswa->skripsi->judul_skripsi }}</td>
                    </tr>
                    <tr>
                        <th>Pembimbing 1</th>
                        <td>{{ $mahasiswa->skripsi->pembimbing1->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <th>Pembimbing 2</th>
                        <td>{{ $mahasiswa->skripsi->pembimbing2->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <th>Status Skripsi</th>
                        <td>
                            <span class="badge bg-{{
                                $mahasiswa->skripsi->status === 'selesai' ? 'success' :
                                ($mahasiswa->skripsi->status === 'bimbingan' ? 'primary' :
                                ($mahasiswa->skripsi->status === 'seminar' ? 'info' :
                                ($mahasiswa->skripsi->status === 'sidang' ? 'warning' : 'secondary')))
                            }}">
                                {{ ucfirst($mahasiswa->skripsi->status) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
