@extends('layouts.app')

@section('title', 'Data Sidang')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Sidang</h3>
                @if(auth()->user()->role == 'mahasiswa' &&
                auth()->user()->mahasiswa->seminar &&
                auth()->user()->mahasiswa->seminar->status == 'selesai' &&
                !auth()->user()->mahasiswa->sidang)
                <a href="{{ route('sidang.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajukan Sidang
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="sidangTable">
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
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sidangs as $sidang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if(auth()->user()->role != 'mahasiswa')
                            <td>
                                {{ $sidang->skripsi->mahasiswa->nama_mahasiswa }}<br>
                                <small class="text-muted">{{ $sidang->skripsi->mahasiswa->nim }}</small>
                            </td>
                            @endif
                            <td>{{ $sidang->skripsi->judul_skripsi }}</td>
                            <td>
                                @if($sidang->tanggal_sidang)
                                {{ $sidang->tanggal_sidang->format('d/m/Y H:i') }}
                                @else
                                <span class="text-muted">Belum ditentukan</span>
                                @endif
                            </td>
                            <td>{{ $sidang->ruang_sidang ?? 'Belum ditentukan' }}</td>
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
                            <td>
                                @if($sidang->nilai)
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
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('sidang.show', $sidang) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'admin' && $sidang->status == 'diajukan')
                                    <a href="{{ route('sidang.edit', $sidang) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(auth()->user()->role == 'mahasiswa' &&
                                    $sidang->status == 'diajukan' &&
                                    $sidang->skripsi->mahasiswa_id == auth()->user()->mahasiswa->id)
                                    <form action="{{ route('sidang.destroy', $sidang) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan pengajuan sidang ini?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data sidang.</td>
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
        $('#sidangTable').DataTable({
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