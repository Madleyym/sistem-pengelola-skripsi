@extends('layouts.app')

@section('title', 'Data Skripsi')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Skripsi</h3>
                @if(auth()->user()->role == 'mahasiswa' && !auth()->user()->mahasiswa->skripsi)
                <a href="{{ route('skripsi.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajukan Skripsi
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Judul Skripsi</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skripsis as $skripsi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $skripsi->mahasiswa->nim }}</td>
                            <td>{{ $skripsi->mahasiswa->nama_mahasiswa }}</td>
                            <td>{{ $skripsi->judul_skripsi }}</td>
                            <td>{{ $skripsi->pembimbing1->nama_dosen }}</td>
                            <td>{{ $skripsi->pembimbing2->nama_dosen }}</td>
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
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('skripsi.show', $skripsi) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'admin' ||
                                    (auth()->user()->role == 'mahasiswa' &&
                                    auth()->user()->mahasiswa->id == $skripsi->mahasiswa_id &&
                                    $skripsi->status == 'diajukan'))
                                    <a href="{{ route('skripsi.edit', $skripsi) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(auth()->user()->role == 'admin')
                                    <form action="{{ route('skripsi.destroy', $skripsi) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data skripsi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            responsive: true,
            order: [
                [0, 'asc']
            ]
        });
    });
</script>
@endpush