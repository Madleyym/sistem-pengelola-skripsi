<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Sidang;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_mahasiswa' => Mahasiswa::count(),
            'total_dosen' => Dosen::count(),
            'total_skripsi' => Skripsi::count(),
            'pending_sidang' => Sidang::where('status', 'pending')->count(),
            'skripsi_terbaru' => Skripsi::with('mahasiswa')
                ->latest()
                ->take(5)
                ->get(),
            'jadwal_sidang' => Sidang::with(['skripsi.mahasiswa'])
                ->where('tanggal_sidang', '>=', now())
                ->orderBy('tanggal_sidang', 'desc')
                ->take(5)
                ->get()
        ];

        return view('admin.dashboard', $data);
    }
}
