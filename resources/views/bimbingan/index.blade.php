@extends('layouts.app')

@section('title', 'Data Bimbingan')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Data Bimbingan</h3>
                @if(auth()->user()->role == 'mahasiswa' && auth()->user()->mahasiswa->skripsi)
                <a href="{{ route('bimbingan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajukan Bimbingan
                </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @if(auth()->user()->role == 'dosen')
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link {{ request('status') != 'selesai' ? 'active' : '' }}"
                        href="{{ route('bimbingan.index') }}">
                        Bimbingan Aktif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request('status') == 'selesai' ? 'active' : '' }}"
                        href="{{ route('bimbingan.index', ['status' => 'selesai']) }}">
                        Riwayat Bimbingan
                    </a>
                </li>
            </ul>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="bimbinganTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            @if(auth()->user()->role != 'mahasiswa')
                            <th>Mahasiswa</th>
                            @endif
                            <th>Judul Skripsi</th>
                            @if(auth()->user()->role != 'dosen')
                            <th>Pembimbing</th>
                            @endif
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bimbingans as $bimbingan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if(auth()->user()->role != 'mahasiswa')
                            <td>
                                {{ $bimbingan->skripsi->mahasiswa->nama_mahasiswa }}<br>
                                <small class="text-muted">{{ $bimbingan->skripsi->mahasiswa->nim }}</small>
                            </td>
                            @endif
                            <td>{{ $bimbingan->skripsi->judul_skripsi }}</td>
                            @if(auth()->user()->role != 'dosen')
                            <td>{{ $bimbingan->dosen->nama_dosen }}</td>
                            @endif
                            <td>{{ $bimbingan->tanggal_bimbingan->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $bimbingan->status === 'menunggu' ? 'warning' :
                                    ($bimbingan->status === 'disetujui' ? 'success' :
                                    ($bimbingan->status === 'ditolak' ? 'danger' : 'info'))
                                }}">
                                    {{ ucfirst($bimbingan->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('bimbingan.show', $bimbingan) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->role == 'dosen' && $bimbingan->status == 'menunggu')
                                    <a href="{{ route('bimbingan.edit', $bimbingan) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                    @if(auth()->user()->role == 'mahasiswa' &&
                                    $bimbingan->status == 'menunggu' &&
                                    $bimbingan->skripsi->mahasiswa_id == auth()->user()->mahasiswa->id)
                                    <form action="{{ route('bimbingan.destroy', $bimbingan) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin membatalkan bimbingan ini?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data bimbingan.</td>
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
        $('#bimbinganTable').DataTable({
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