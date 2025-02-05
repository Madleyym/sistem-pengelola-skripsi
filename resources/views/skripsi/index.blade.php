@extends('layouts.app')
@vite(['resources/css/skripsi.css'])
@section('title', 'Data Skripsi')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section with Enhanced Design -->
        <div class="mb-8">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Data Skripsi</h1>
                    <p class="mt-2 text-lg text-gray-600">Kelola dan pantau progress skripsi mahasiswa</p>
                </div>
                <div class="flex items-center space-x-4">
                    @if(auth()->user()->role == 'mahasiswa' && !auth()->user()->mahasiswa->skripsi)
                    <a href="{{ route('skripsi.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-500 border border-transparent rounded-xl text-base font-medium text-white hover:from-indigo-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <svg class="mr-2 -ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajukan Skripsi
                    </a>
                    @endif
                    <!-- Stats Cards -->
                    <div class="flex space-x-4">
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <p class="text-sm text-gray-600">Total Skripsi</p>
                            <p class="text-2xl font-bold text-indigo-600">{{ $skripsis->count() }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm">
                            <p class="text-sm text-gray-600">Skripsi Aktif</p>
                            <p class="text-2xl font-bold text-green-600">{{ $skripsis->where('status', 'diterima')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card with Enhanced Design -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
            <div class="p-8">
                <!-- Search and Filter Section -->
                <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                    <div class="flex-1 min-w-[300px]">
                        <div class="relative">
                            <input type="text" id="tableSearch" 
                                   class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                                   placeholder="Cari berdasarkan nama atau NIM...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <select id="statusFilter" class="border border-gray-200 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="diajukan">Diajukan</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>

                <!-- Enhanced Table Section -->
                <div class="overflow-x-auto">
                    <table id="skripsiTable" class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-lg">No</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Skripsi</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembimbing 1</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembimbing 2</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($skripsis as $skripsi)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                        {{ $skripsi->mahasiswa->nim }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <span class="text-sm font-medium text-indigo-700">
                                                {{ substr($skripsi->mahasiswa->nama_mahasiswa, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $skripsi->mahasiswa->nama_mahasiswa }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-900 line-clamp-2">{{ $skripsi->judul_skripsi }}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $skripsi->pembimbing1->nama_dosen }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $skripsi->pembimbing2->nama_dosen }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ 
                                        $skripsi->status === 'diajukan' ? 'bg-yellow-100 text-yellow-800' :
                                        ($skripsi->status === 'diterima' ? 'bg-green-100 text-green-800' :
                                        ($skripsi->status === 'ditolak' ? 'bg-red-100 text-red-800' :
                                        ($skripsi->status === 'selesai' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800')))
                                    }}">
                                        {{ ucfirst($skripsi->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('skripsi.show', $skripsi) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200 group"
                                           title="Lihat Detail">
                                            <span class="absolute invisible group-hover:visible bg-gray-900 text-white text-xs rounded px-2 py-1 -mt-8">
                                                Lihat Detail
                                            </span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        @if(auth()->user()->role == 'admin' ||
                                            (auth()->user()->role == 'mahasiswa' &&
                                            auth()->user()->mahasiswa->id == $skripsi->mahasiswa_id &&
                                            $skripsi->status == 'diajukan'))
                                        <a href="{{ route('skripsi.edit', $skripsi) }}" 
                                           class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200 group"
                                           title="Edit">
                                            <span class="absolute invisible group-hover:visible bg-gray-900 text-white text-xs rounded px-2 py-1 -mt-8">
                                                Edit
                                            </span>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        @endif

                                        @if(auth()->user()->role == 'admin')
                                        <form action="{{ route('skripsi.destroy', $skripsi) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 transition-colors duration-200 group"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                    title="Hapus">
                                                <span class="absolute invisible group-hover:visible bg-gray-900 text-white text-xs rounded px-2 py-1 -mt-8">
                                                    Hapus
                                                </span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center bg-gray-50">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="h-12 w-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.4145.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-gray-600">Tidak ada data skripsi yang tersedia.</p>
                                        @if(auth()->user()->role == 'mahasiswa' && !auth()->user()->mahasiswa->skripsi)
                                        <a href="{{ route('skripsi.create') }}" class="mt-4 text-indigo-600 hover:text-indigo-500">
                                            Ajukan skripsi sekarang
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                <div class="mt-6">
                    {{ $skripsis->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Quick View -->
<div id="quickViewModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-xl bg-white">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900">Detail Skripsi</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeQuickView()">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="quickViewContent"></div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.tailwindcss.min.css">
<style>
    .dataTables_wrapper .dataTables_length select {
        background-image: none;
        padding-right: 2rem;
    }
    .dataTables_wrapper .dataTables_filter input {
        background-image: none;
        padding-left: 2rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #4F46E5 !important;
        color: white !important;
        border: none;
        border-radius: 0.5rem;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #4338CA !important;
        color: white !important;
        border: none;
        border-radius: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.tailwindcss.min.js"></script>
<script>
    // Initialize DataTable with enhanced features
    $(document).ready(function() {
        const table = $('#skripsiTable').DataTable({
            responsive: true,
            order: [[0, 'asc']],
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data yang ditemukan",
                info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data yang tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            },
            dom: '<"flex flex-col md:flex-row items-center justify-between mb-4"lf>rtip',
            initComplete: function() {
                // Enhanced search functionality
                $('#tableSearch').on('keyup', function() {
                    table.search(this.value).draw();
                });

                // Status filter functionality
                $('#statusFilter').on('change', function() {
                    table.column(6).search(this.value).draw();
                });
            }
        });

        // Add loading animation
        $(document).on({
            ajaxStart: function() {
                $('body').addClass('cursor-wait');
            },
            ajaxStop: function() {
                $('body').removeClass('cursor-wait');
            }
        });

        // Tooltip initialization
        $('[title]').tooltip();
    });

    // Quick View functionality
    function showQuickView(id) {
        $('#quickViewModal').removeClass('hidden');
        $.get(`/skripsi/${id}/quick-view`, function(data) {
            $('#quickViewContent').html(data);
        });
    }

    function closeQuickView() {
        $('#quickViewModal').addClass('hidden');
    }

    // Close modal on escape key
    $(document).keydown(function(e) {
        if (e.keyCode == 27) {
            closeQuickView();
        }
    });

    // Close modal on outside click
    $(document).mouseup(function(e) {
        const container = $("#quickViewModal .relative");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            closeQuickView();
        }
    });

    // Add smooth fade animations for table rows
    document.querySelectorAll('#skripsiTable tbody tr').forEach(row => {
        row.style.transition = 'all 0.3s ease-in-out';
    });
</script>
@endpush