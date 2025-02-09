@extends('layouts.app')

@section('title', 'Data Seminar')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Seminar</h3>
                @if(auth()->user()->role == 'mahasiswa' &&
                auth()->user()->mahasiswa->skripsi &&
                auth()->user()->mahasiswa->skripsi->status == 'diterima' &&
                !auth()->user()->mahasiswa->seminar)
                <a href="{{ route('seminar.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajukan Seminar
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="seminarTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            @if(auth()->user()->role != 'mahasiswa')
                            <th>Mahasiswa</th>
                            @endif
                            <th>Judul Skripsi</th>
                            <th>Tanggal</th>
                            <th>Ruangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($seminars as $seminar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if(auth()->user()->role != 'mahasiswa')
                            <td>
                                {{ $seminar->skripsi->mahasiswa->nama_mahasiswa }}<br>
                                <small class="text-muted">{{ $seminar->skripsi->mahasiswa->nim }}</small>
                            </td>
                            @endif
                            <td>{{ $seminar->skripsi->judul_skripsi }}</td>
                            <td>
                                @if($seminar->tanggal_seminar)
                                {{ $seminar->tanggal_seminar->format('d/m/Y H:i') }}
                                @else
                                <span class="text-muted">Belum ditentukan</span>
                                @endif
                            </td>
                            <td>{{ $seminar->ruang_seminar ?? 'Belum ditentukan' }}</td>
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
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('seminar.show', $seminar) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'admin' && $seminar->status == 'diajukan')
                                    <a href="{{ route('seminar.edit', $seminar) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(auth()->user()->role == 'mahasiswa' &&
                                    $seminar->status == 'diajukan' &&
                                    $seminar->skripsi->mahasiswa_id == auth()->user()->mahasiswa->id)
                                    <form action="{{ route('seminar.destroy', $seminar) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan pengajuan seminar ini?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data seminar.</td>
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
        $('#seminarTable').DataTable({
            responsive: true,
            order: [
                [0, 'desc']
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush