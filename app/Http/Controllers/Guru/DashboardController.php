<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\guru_kelas;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Siswa::count('id');
        $guru = Guru::count('id');
        $guru_kelas = guru_kelas::count('id');
        $kelas = Kelas::count('id');
        return view('frontend.guru.index', compact('siswa', 'guru', 'guru_kelas', 'kelas'));
    }
}
