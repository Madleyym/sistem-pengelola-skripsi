@extends('layouts.app')

@section('title', 'Data Jurusan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Jurusan</h3>
                <a href="{{ route('jurusan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Jurusan
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Jurusan</th>
                            <th>Nama Jurusan</th>
                            <th>Kepala Jurusan</th>
                            <th>Akreditasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jurusans as $jurusan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jurusan->kode_jurusan }}</td>
                            <td>{{ $jurusan->nama_jurusan }}</td>
                            <td>{{ $jurusan->kepala_jurusan }}</td>
                            <td>{{ $jurusan->akreditasi }}</td>
                            <td>
                                <span class="badge bg-{{ $jurusan->status_aktif ? 'success' : 'danger' }}">
                                    {{ $jurusan->status_aktif ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('jurusan.edit', $jurusan) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('jurusan.destroy', $jurusan) }}" method="POST" class="d-inline">
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
                            <td colspan="7" class="text-center">Tidak ada data jurusan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Confirm delete
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush