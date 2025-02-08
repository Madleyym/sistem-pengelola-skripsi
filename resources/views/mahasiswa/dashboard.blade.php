@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Dashboard Mahasiswa</h1>

        <!-- User Info Section -->
        <div class="card mb-4">
            <div class="card-header">
                Informasi Mahasiswa
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                <p><strong>Role:</strong> Mahasiswa</p>
            </div>
        </div>

        <!-- Example: Academic Modules Section -->
        <div class="card mb-4">
            <div class="card-header">
                Modul Akademik
            </div>
            <div class="card-body">
                <ul>
                    <li><a href="#">Daftar Mata Kuliah</a></li>
                    <li><a href="#">Nilai</a></li>
                    <li><a href="#">Jadwal Kuliah</a></li>
                </ul>
            </div>
        </div>

        <!-- Additional Features -->
        <div class="card mb-4">
            <div class="card-header">
                Fitur Tambahan
            </div>
            <div class="card-body">
                <ul>
                    <li><a href="#">Laporan Akademik</a></li>
                    <li><a href="#">Edit Profil</a></li>
                    <li><a href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
@endsection
