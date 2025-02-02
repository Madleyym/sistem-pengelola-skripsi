@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Dosen</h3>
                <a href="{{ route('dosen.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Dosen
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Dosen</th>
                            <th>Email</th>
                            <th>Jurusan</th>
                            <th>Bidang Keahlian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dosens as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->nip }}</td>
                            <td>{{ $dosen->nama_dosen }}</td>
                            <td>{{ $dosen->email }}</td>
                            <td>{{ $dosen->jurusan->nama_jurusan }}</td>
                            <td>{{ $dosen->bidang_keahlian }}</td>
                            <td>
                                <span class="badge bg-{{ $dosen->status === 'aktif' ? 'success' : 'danger' }}">
                                    {{ ucfirst($dosen->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dosen.edit', $dosen) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('dosen.destroy', $dosen) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data dosen.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection