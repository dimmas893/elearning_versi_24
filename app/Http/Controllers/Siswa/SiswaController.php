<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Absens;
use App\Models\Guru;
use App\Models\guru_kelas;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Nilai_tugas;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\Soal;
use App\Models\Tugas;
use App\Models\Ujian;
use App\Models\Ulangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::count('id');
        $guru = Guru::count('id');
        $guru_kelas = guru_kelas::count('id');
        $kelas = Kelas::count('id');
        return view('frontend.siswa.index', compact('siswa', 'guru', 'guru_kelas', 'kelas'));
    }

    public function jadwal()
    {
        $ruangan = Ruangan::with('siswa')->where('siswa_id', Auth::guard('siswa')->user()->id)->first();
        $jadwals = Jadwal::with('mata_pelajaran', 'hari', 'guru')->where('kelas_id', $ruangan->kelas_id)->get();
        // dd($jadwals);
        return view('frontend.siswa.jadwal', compact('jadwals'));
    }

    public function masuk(Request $request, $id)
    {
        $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $checkabsen = Absens::where('jadwal_id', $jadwal->id)->where('siswa_id', Auth::guard('siswa')->user()->id)->first();
        // dd($jadwal);
        $ruangan = Ruangan::with('siswa')->where('kelas_id', $jadwal->kelas->id)->get();



        // Jika waktu pada jadwal sesuai maka jalankan code dibawah 
        if (\Carbon\Carbon::now('Asia/Jakarta')->format('H:i') >= $jadwal->jam_masuk && \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') <= $jadwal->jam_keluar) {

            // Code dibawah untuk menampilkan seluruh mahasiswa yang berada di kelas yang sama dan dijadwal yang sama
            // Beserta menampilkan  absensi hari ini


            // $mahasiswa = Jadwal::with(['ruangan'], ['guru'], ['mata_pelajaran'])->where('ruangan_id', $ruangan->id)->where()->where('id', decrypt($id))->first();
            // $absen = Absen::where('guru_id', Auth::guard('guru')->user()->id)->where('jadwal_id', $jadwal->id)->where('siswa_id', $jadwal->ruangan->siswa->id)->get();
            // $siswa = Ruangan::with('siswa')->get();
            $hariini = \Carbon\Carbon::now()->format('Y-m-d');
            $absens = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->get();
            $absen_izin_total = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'izin')->count('siswa_id');
            $absen_alpha_total = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'alpa')->count('siswa_id');
            $absen_sakit_total = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'sakit')->count('siswa_id');



            $counthariini_sakit = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'sakit')->where('created_at', $hariini)->count('siswa_id');
            $counthariini_alpa = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'alpa')->where('created_at', $hariini)->count('siswa_id');
            $counthariini_izin = Absens::with('siswa', 'jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'izin')->where('created_at', $hariini)->count('siswa_id');


            // $tugas_hari_ini = Tugas::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->count();
            // $tugas_hari_ini_tampil = Tugas::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->get();

            // $semua_tugas = Tugas::with('jadwal')->where('jadwal_id', $jadwal->id)->count();
            // $semua_tugas = Tugas::with('jadwal')->where('jadwal_id', $jadwal->id)->count();
            // $semua_tugas_tampil = Nilai_tugas::with('tugas')->where('jadwal_id', $jadwal->id)->where('siswa_id', Auth::guard('siswa')->user()->id)->get();

            // $semua_materi_tampil = Materi::with('jadwal', 'semester')->where('jadwal_id', $jadwal->id)->get();

            $materi_hari_ini = Materi::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->count();

            $hadir = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->get();
            $hadir_count = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'hadir')->where('tanggal', $hariini)->count('siswa_id');

            $count = Ruangan::with('siswa')->where('kelas_id', $jadwal->kelas->id)->count('siswa_id');
            // $pp = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status', 'hadir')->where('tanggal', $hariini)->count('siswa_id');


            $semester = Semester::all();

            // $pp = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status', '!=', null)->where('tanggal', $hariini)->count('siswa_id');
            $hitung_absen = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status', '!=', 'hadir')->where('tanggal', $hariini)->count('siswa_id');
            $sakit = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status',  'sakit')->where('tanggal', $hariini)->count('siswa_id');
            $pp = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status',  'hadir')->where('tanggal', $hariini)->count('siswa_id');
            $izin = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status',  'izin')->where('tanggal', $hariini)->count('siswa_id');
            $alpa = Absens::with('jadwal')->where('jadwal_id', $jadwal->id)->where('status',  'alpa')->where(
                'tanggal',
                $hariini
            )->count('siswa_id');

            // $semua_tugas_tampil_tampil = Nilai_tugas::with('tugas')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->where('siswa_id', Auth::guard('siswa')->user()->id)->get();

            $total = $sakit + $izin + $alpa + $pp;

            $total_hadir = $count - $total;
            $total_hadir_siswa = $count;


            // $semua_tugas = Nilai_tugas::with('tugas')->where('jadwal_id', $jadwal->id)->where('siswa_id', Auth::guard('siswa')->user()->id)->count();
            // $semua_tugas = Tugas::with('jadwal')->where('jadwal_id', $jadwal->id)->count();
            // $semua_ulangan = Ulangan::with('jadwal')->where('jadwal_id', $jadwal->id)->count();
            // $semua_ujian = Ujian::with('jadwal')->where('jadwal_id', $jadwal->id)->count();

            $semua_materi_tampil_count = Materi::with('jadwal')->where('jadwal_id', $jadwal->id)->count();
            // $ulangan_hari_ini = Ulangan::with('jadwal')->where('jadwal_id', $jadwal->id)->where(
            //     'tanggal',
            //     $hariini
            // )->count();

            // $materi_hari_ini_tampil = Materi::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->get();
            $materi_hari_ini_tampil = DB::table('materi')
                ->leftjoin(
                    'semester',
                    'materi.semester',
                    '=',
                    'semester.id'
                )->where('tanggal', $hariini)
                ->select(
                    'materi.judul as judul',
                    'materi.type as type',
                    'materi.file_or_link as file_or_link',
                    'materi.description as description',
                    'materi.pertemuan as pertemuan',
                    // 'materi.semester as semester',
                    'materi.tanggal as tanggal',
                    'materi.tahun_ajaran as tahun_ajaran',
                    'materi.kelas_id as kelas_id',
                    'semester.name as semester',
                )
                ->where(
                    'materi.jadwal_id',
                    $jadwal->id
                )
                ->where('materi.semester', 'like', '%' . $request->semester . '%')
                ->where('materi.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
                ->groupBy(
                    'materi.judul',
                    'materi.type',
                    'materi.file_or_link',
                    'materi.description',
                    'materi.pertemuan',
                    // 'materi.semester',
                    'materi.tanggal',
                    'materi.tahun_ajaran',
                    'materi.kelas_id',
                    'semester.name',
                )
                ->limit(10)
                ->orderBy('semester', 'desc')
                ->get();

            $materi_tampil_semua = DB::table('materi')
                ->leftjoin(
                    'semester',
                    'materi.semester',
                    '=',
                    'semester.id'
                )
                ->select(
                    'materi.judul as judul',
                    'materi.type as type',
                    'materi.file_or_link as file_or_link',
                    'materi.description as description',
                    'materi.pertemuan as pertemuan',
                    // 'materi.semester as semester',
                    'materi.tanggal as tanggal',
                    'materi.tahun_ajaran as tahun_ajaran',
                    'materi.kelas_id as kelas_id',
                    'semester.name as semester',
                )
                ->where(
                    'materi.jadwal_id',
                    $jadwal->id
                )
                ->where('materi.semester', 'like', '%' . $request->semester . '%')
                ->where('materi.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
                ->groupBy(
                    'materi.judul',
                    'materi.type',
                    'materi.file_or_link',
                    'materi.description',
                    'materi.pertemuan',
                    // 'materi.semester',
                    'materi.tanggal',
                    'materi.tahun_ajaran',
                    'materi.kelas_id',
                    'semester.name',
                )
                ->limit(10)
                ->orderBy('semester', 'desc')
                ->get();

            // $soal = DB::table('soal')
            // ->leftjoin(
            //     'semester',
            //     'soal.semester_id',
            //     '=',
            //     'semester.id'
            // )
            //     ->leftjoin(
            //         'kelas',
            //     'soal.kelas_id',
            //         '=',
            //         'kelas.id'
            // )
            //     ->leftjoin(
            //     'category_soal',
            //     'soal.category_soal_id',
            //     '=',
            //         'category_soal.id'
            //     )
            //     ->leftjoin(
            //     'mata_pelajaran',
            //     'soal.mata_pelajaran_id',
            //     '=',
            //     'mata_pelajaran.id'
            // )
            //     ->select(
            //     'soal.soal as soal',
            //     'soal.opsi_a as opsi_a',
            //     'soal.opsi_b as opsi_b',
            //     'soal.opsi_c as opsi_c',
            //     'soal.opsi_d as opsi_d',
            //     'soal.jawaban as jawaban',
            //     'soal.tahun_ajaran as tahun_ajaran',
            //     'semester.name as semester',
            //     'soal.pertemuan as pertemuan',
            //     'mata_pelajaran.name as mata_pelajaran',
            //     'kelas.kelas as kelas',
            //     'category_soal.name as category_soal'
            // )
            //     ->groupBy(
            //     'soal.soal',
            //     'soal.opsi_a',
            //     'soal.opsi_b',
            //     'soal.opsi_c',
            //     'soal.opsi_d',
            //     'soal.jawaban',
            //     'soal.tahun_ajaran',
            //     'semester.name',
            //     'soal.pertemuan',
            //     'mata_pelajaran.name',
            //     'kelas.kelas',
            //     'category_soal.name'
            //     )
            //     ->limit(10)
            //     ->orderBy('semester_id', 'desc')
            //     ->get();

            // $soal = Soal::with('kelas', 'mata_pelajaran', 'semester', 'guru')->where('kelas_id', $jadwal->kelas_id)->where('category_soal_id', '')->get();


            // $semua_ujian_tampil = DB::table('nilai_ujian')
            // ->leftjoin(
            //     'ujian',
            //     'nilai_ujian.ujian_id',
            //     '=',
            //     'ujian.id'
            // )
            //     ->leftjoin(
            //         'semester',
            //         'nilai_ujian.semester',
            //         '=',
            //         'semester.id'
            //     )
            //     ->leftjoin(
            //         'siswa',
            //         'nilai_ujian.siswa_id',
            //         '=',
            //         'siswa.id'
            //     )
            //     ->leftjoin(
            //         'kelas',
            //         'nilai_ujian.kelas_id',
            //         '=',
            //         'kelas.id'
            //     )
            //     ->where(
            //         'nilai_ujian.jadwal_id',
            //         $jadwal->id
            //     )
            //     ->where('siswa_id', Auth::guard('siswa')->user()->id)
            //     ->select(
            //         'siswa.name as siswa_name',
            //         'siswa.nisn as siswa_nisn',
            //         'kelas.kelas as kelas',
            //         'ujian.judul as judul',
            //         'ujian.type as type',
            //         'ujian.pengumpulan as pengumpulan',
            //         'ujian.file_or_link as file_or_link',
            //         'ujian.description as description',
            //         'nilai_ujian.jawaban_siswa as jawaban_siswa',
            //         'nilai_ujian.nilai as nilai',
            //         'nilai_ujian.semester as semester',
            //         'nilai_ujian.komentar_guru as komentar_guru',
            //         'nilai_ujian.tanggal as tanggal_ujian',
            //         'nilai_ujian.pertemuan as pertemuan',
            //         'nilai_ujian.tahun_ajaran as tahun_ajaran',
            //         'nilai_ujian.created_at as created_at',
            //         'nilai_ujian.id as id',
            //         'semester.name as semesters',
            //     )
            //     ->groupBy(
            //         'siswa.name',
            //         'siswa.nisn',
            //         'kelas.kelas',
            //         'ujian.judul',
            //         'ujian.type',
            //         'ujian.file_or_link',
            //         'ujian.description',
            //         'nilai_ujian.jawaban_siswa',
            //         'nilai_ujian.nilai',
            //         'nilai_ujian.semester',
            //         'nilai_ujian.komentar_guru',
            //         'nilai_ujian.tanggal',
            //         'nilai_ujian.pertemuan',
            //         'nilai_ujian.tahun_ajaran',
            //         'ujian.pengumpulan',
            //         'nilai_ujian.created_at',
            //         'nilai_ujian.id',
            //         'semester.name',
            //     )
            //     ->limit(10)
            //     ->orderBy('nilai', 'desc')
            //     ->get();

            // $semua_ulangan_tampil = DB::table('nilai_ulangan')
            // ->leftjoin('ulangan', 'nilai_ulangan.ulangan_id', '=', 'ulangan.id')
            // ->leftjoin('semester', 'nilai_ulangan.semester', '=', 'semester.id')
            // ->leftjoin(
            //     'siswa',
            //     'nilai_ulangan.siswa_id',
            //     '=',
            //     'siswa.id'
            // )
            // ->leftjoin(
            //     'kelas',
            //     'nilai_ulangan.kelas_id',
            //     '=',
            //     'kelas.id'
            // )
            // ->where(
            //     'nilai_ulangan.jadwal_id',
            //     $jadwal->id
            // )
            // ->where('siswa_id', Auth::guard('siswa')->user()->id)
            // ->select(
            //     'siswa.name as siswa_name',
            //     'siswa.nisn as siswa_nisn',
            //     'kelas.kelas as kelas',
            //     'ulangan.judul as judul_ulangan',
            //     'ulangan.type as type',
            //     'ulangan.pengumpulan as pengumpulan',
            //     'ulangan.file_or_link as file_or_link',
            //     'ulangan.description as description',
            //     'nilai_ulangan.jawaban_siswa as jawaban_siswa',
            //     'nilai_ulangan.nilai as nilai',
            //     'nilai_ulangan.semester as semester',
            //     'nilai_ulangan.komentar_guru as komentar_guru',
            //     'nilai_ulangan.tanggal as tanggal_ulangan',
            //     'nilai_ulangan.pertemuan as pertemuan',
            //     'nilai_ulangan.tahun_ajaran as tahun_ajaran',
            //     'nilai_ulangan.created_at as created_at',
            //     'nilai_ulangan.id as id',
            //     'semester.name as semesters',
            // )
            // ->groupBy(
            //     'siswa.name',
            //     'siswa.nisn',
            //     'kelas.kelas',
            //     'ulangan.judul',
            //     'ulangan.type',
            //     'ulangan.file_or_link',
            //     'ulangan.description',
            //     'nilai_ulangan.jawaban_siswa',
            //     'nilai_ulangan.nilai',
            //     'nilai_ulangan.semester',
            //     'nilai_ulangan.komentar_guru',
            //     'nilai_ulangan.tanggal',
            //     'nilai_ulangan.pertemuan',
            //     'nilai_ulangan.tahun_ajaran',
            //     'ulangan.pengumpulan',
            //     'nilai_ulangan.created_at',
            //     'nilai_ulangan.id',
            //     'semester.name',
            // )
            // ->limit(10)
            // ->orderBy('nilai', 'desc')
            // ->get();

            // $semua_tugas_tampil = DB::table('nilai_tugas')
            // ->leftjoin('tugas', 'nilai_tugas.tugas_id', '=', 'tugas.id')
            // ->leftjoin(
            //     'siswa',
            //     'nilai_tugas.siswa_id',
            //     '=',
            //     'siswa.id'
            // )
            // ->leftjoin('kelas', 'nilai_tugas.kelas_id', '=', 'kelas.id')
            //     ->leftjoin(
            //         'semester',
            //         'nilai_tugas.semester',
            //         '=',
            //         'semester.id'
            //     )
            //     ->where('nilai_tugas.jadwal_id', $jadwal->id)
            //     ->where('siswa_id', Auth::guard('siswa')->user()->id)
            //     ->select(
            //         'siswa.name as siswa_name',
            //         'siswa.nisn as siswa_nisn',
            //         'kelas.kelas as kelas',
            //         'tugas.judul as judul',
            //         'tugas.type as type',
            //         'tugas.pengumpulan as pengumpulan',
            //         'tugas.file_or_link as file_or_link',
            //         'tugas.description as description',
            //         'nilai_tugas.jawaban_siswa as jawaban_siswa',
            //         'nilai_tugas.nilai as nilai',
            //         'nilai_tugas.semester as semester',
            //         'nilai_tugas.komentar_guru as komentar_guru',
            //         'nilai_tugas.tanggal as tanggal_tugas',
            //         'nilai_tugas.pertemuan as pertemuan',
            //         'nilai_tugas.tahun_ajaran as tahun_ajaran',
            //         'nilai_tugas.created_at as created_at',
            //         'nilai_tugas.id as id',
            //         'semester.name as semesters',
            //     )
            //     ->groupBy(
            //         'siswa.name',
            //         'siswa.nisn',
            //         'kelas.kelas',
            //         'tugas.judul',
            //         'tugas.type',
            //         'tugas.file_or_link',
            //         'tugas.description',
            //         'nilai_tugas.jawaban_siswa',
            //         'nilai_tugas.nilai',
            //         'nilai_tugas.semester',
            //         'nilai_tugas.komentar_guru',
            //         'nilai_tugas.tanggal',
            //         'nilai_tugas.pertemuan',
            //         'nilai_tugas.tahun_ajaran',
            //         'tugas.pengumpulan',
            //         'nilai_tugas.created_at',
            //         'nilai_tugas.id',
            //         'semester.name',
            //     )
            //     ->limit(10)
            //     ->orderBy('nilai', 'desc')
            //     ->get();

            // $tugas_tampil_hari_ini = DB::table('nilai_tugas')
            // ->leftjoin('tugas', 'nilai_tugas.tugas_id', '=', 'tugas.id')
            // ->leftjoin(
            //     'siswa',
            //     'nilai_tugas.siswa_id',
            //     '=',
            //     'siswa.id'
            // )
            // ->leftjoin('semester', 'nilai_tugas.semester', '=', 'semester.id')
            // ->leftjoin(
            //     'kelas',
            //     'nilai_tugas.kelas_id',
            //     '=',
            //     'kelas.id'
            // )
            // ->where(
            //     'nilai_tugas.jadwal_id',
            //     $jadwal->id
            // )
            // ->where('nilai_tugas.siswa_id', Auth::guard('siswa')->user()->id)
            // ->where(
            //     'nilai_tugas.tanggal',
            //     $hariini
            // )
            //     ->select(
            //         'siswa.name as siswa_name',
            //         'siswa.nisn as siswa_nisn',
            //         'kelas.kelas as kelas',
            //         'tugas.judul as judul',
            //         'tugas.type as type',
            //         'tugas.pengumpulan as pengumpulan',
            //         'tugas.file_or_link as file_or_link',
            //         'tugas.description as description',
            //         'nilai_tugas.jawaban_siswa as jawaban_siswa',
            //         'nilai_tugas.nilai as nilai',
            //         'nilai_tugas.semester as semester',
            //         'nilai_tugas.komentar_guru as komentar_guru',
            //         'nilai_tugas.tanggal as tanggal_tugas',
            //         'nilai_tugas.pertemuan as pertemuan',
            //         'nilai_tugas.tahun_ajaran as tahun_ajaran',
            //         'nilai_tugas.created_at as created_at',
            //         'nilai_tugas.id as id',
            //         'semester.name as semesters',
            //     )
            //     ->groupBy(
            //         'siswa.name',
            //         'siswa.nisn',
            //         'kelas.kelas',
            //         'tugas.judul',
            //         'tugas.type',
            //         'tugas.file_or_link',
            //         'tugas.description',
            //         'nilai_tugas.jawaban_siswa',
            //         'nilai_tugas.nilai',
            //         'nilai_tugas.semester',
            //         'nilai_tugas.komentar_guru',
            //         'nilai_tugas.tanggal',
            //         'nilai_tugas.pertemuan',
            //         'nilai_tugas.tahun_ajaran',
            //         'tugas.pengumpulan',
            //         'nilai_tugas.created_at',
            //         'nilai_tugas.id',
            //         'semester.name',
            //     )
            //     ->limit(10)
            //     ->orderBy('nilai', 'desc')
            //     ->get();

            // $ulangan_tampil_hari_ini = DB::table('nilai_ulangan')
            //     ->leftjoin(
            //         'ulangan',
            //         'nilai_ulangan.ulangan_id',
            //         '=',
            //         'ulangan.id'
            //     )
            //     ->leftjoin(
            //         'siswa',
            //         'nilai_ulangan.siswa_id',
            //         '=',
            //         'siswa.id'
            //     )
            //     ->leftjoin(
            //         'kelas',
            //         'nilai_ulangan.kelas_id',
            //         '=',
            //         'kelas.id'
            //     )
            //     ->leftjoin('semester', 'nilai_ulangan.semester', '=', 'semester.id')
            //     ->where(
            //         'nilai_ulangan.jadwal_id',
            //         $jadwal->id
            //     )
            //     ->where(
            //         'nilai_ulangan.siswa_id',
            //         Auth::guard('siswa')->user()->id
            //     )
            //     ->where(
            //         'nilai_ulangan.tanggal',
            //         $hariini
            //     )
            //     ->select(
            //         'siswa.name as siswa_name',
            //         'siswa.nisn as siswa_nisn',
            //         'kelas.kelas as kelas',
            //         'ulangan.judul as judul',
            //         'ulangan.type as type',
            //         'ulangan.pengumpulan as pengumpulan',
            //         'ulangan.file_or_link as file_or_link',
            //         'ulangan.description as description',
            //         'nilai_ulangan.jawaban_siswa as jawaban_siswa',
            //         'nilai_ulangan.nilai as nilai',
            //         'nilai_ulangan.semester as semester',
            //         'nilai_ulangan.komentar_guru as komentar_guru',
            //         'nilai_ulangan.tanggal as tanggal_ulangan',
            //         'nilai_ulangan.pertemuan as pertemuan',
            //         'nilai_ulangan.tahun_ajaran as tahun_ajaran',
            //         'nilai_ulangan.created_at as created_at',
            //         'nilai_ulangan.id as id',
            //         'semester.name as semesters',
            //     )
            //     ->groupBy(
            //         'siswa.name',
            //         'siswa.nisn',
            //         'kelas.kelas',
            //         'ulangan.judul',
            //         'ulangan.type',
            //         'ulangan.file_or_link',
            //         'ulangan.description',
            //         'nilai_ulangan.jawaban_siswa',
            //         'nilai_ulangan.nilai',
            //         'nilai_ulangan.semester',
            //         'nilai_ulangan.komentar_guru',
            //         'nilai_ulangan.tanggal',
            //         'nilai_ulangan.pertemuan',
            //         'nilai_ulangan.tahun_ajaran',
            //         'ulangan.pengumpulan',
            //         'nilai_ulangan.created_at',
            //         'nilai_ulangan.id',
            //         'semester.name',
            //     )
            //     ->limit(10)
            //     ->orderBy('nilai', 'desc')
            //     ->get();


            // $ujian_tampil_hari_ini = DB::table('nilai_ujian')
            // ->leftjoin(
            //     'ujian',
            //     'nilai_ujian.ujian_id',
            //     '=',
            //     'ujian.id'
            // )
            // ->leftjoin(
            //     'siswa',
            //     'nilai_ujian.siswa_id',
            //     '=',
            //     'siswa.id'
            // )
            // ->leftjoin(
            //     'kelas',
            //     'nilai_ujian.kelas_id',
            //     '=',
            //     'kelas.id'
            // )
            // ->leftjoin(
            //     'semester',
            //     'nilai_ujian.semester',
            //     '=',
            //     'semester.id'
            // )
            // ->where(
            //     'nilai_ujian.jadwal_id',
            //     $jadwal->id
            // )
            //     ->where(
            //         'nilai_ujian.siswa_id',
            //         Auth::guard('siswa')->user()->id
            //     )
            //     ->where(
            //         'nilai_ujian.tanggal',
            //         $hariini
            //     )
            //     ->select(
            //         'siswa.name as siswa_name',
            //         'siswa.nisn as siswa_nisn',
            //         'kelas.kelas as kelas',
            //         'ujian.judul as judul',
            //         'ujian.type as type',
            //         'ujian.pengumpulan as pengumpulan',
            //         'ujian.file_or_link as file_or_link',
            //         'ujian.description as description',
            //         'nilai_ujian.jawaban_siswa as jawaban_siswa',
            //         'nilai_ujian.nilai as nilai',
            //         'nilai_ujian.semester as semester',
            //         'nilai_ujian.komentar_guru as komentar_guru',
            //         'nilai_ujian.tanggal as tanggal_ujian',
            //         'nilai_ujian.pertemuan as pertemuan',
            //         'nilai_ujian.tahun_ajaran as tahun_ajaran',
            //         'nilai_ujian.created_at as created_at',
            //         'nilai_ujian.id as id',
            //         'semester.name as semesters',
            //     )
            //     ->groupBy(
            //         'siswa.name',
            //         'siswa.nisn',
            //         'kelas.kelas',
            //         'ujian.judul',
            //         'ujian.type',
            //         'ujian.file_or_link',
            //         'ujian.description',
            //         'nilai_ujian.jawaban_siswa',
            //         'nilai_ujian.nilai',
            //         'nilai_ujian.semester',
            //         'nilai_ujian.komentar_guru',
            //         'nilai_ujian.tanggal',
            //         'nilai_ujian.pertemuan',
            //         'nilai_ujian.tahun_ajaran',
            //         'ujian.pengumpulan',
            //         'nilai_ujian.created_at',
            //         'nilai_ujian.id',
            //         'semester.name',
            //     )
            //     ->limit(10)
            //     ->orderBy('nilai', 'desc')
            //     ->get();

            // $mahasiswaHadir = $absen->where('parent',  null)->count();
            // $mahasiswaTidakHadir = $absen->where('parent', '==', null)->count();

            // Code dibawah untuk menampilkan data absen yang telah dibuat oleh dosen untuk hari ini
            // dan akan digunakan untuk simpan rekap absen
            // $absen = Absen::where('guru_id', Auth::guard('guru')->user()->id)
            //     ->where('jadwal_id', $jadwal->id)
            //     ->whereDate('created_at', now())
            //     ->first();

            // $ujian_hari_ini = Ujian::with('jadwal')->where('jadwal_id', $jadwal->id)->where('tanggal', $hariini)->count();

            return view('frontend.siswa.kelas', compact(
                'ruangan',
                'jadwal',
                'absens',
                'count',
                'absen_alpha_total',
                'absen_izin_total',
                'absen_sakit_total',
                'counthariini_sakit',
                'counthariini_alpa',
                'counthariini_izin',
                'hariini',
                'hadir',
                'total_hadir_siswa',
                // 'semua_materi_tampil',
                'total_hadir',
                'hitung_absen',
                'checkabsen',
                'semester',
                'materi_hari_ini_tampil',
                'materi_hari_ini',
                'hadir_count',
                'semua_materi_tampil_count',
                'materi_tampil_semua',
                // 'soal'
            ));
        }
    }

    public function absen(Request $request, $id)
    {
        // $hariini = \Carbon\Carbon::now()->format('Y-m-d');
        $booking = Absens::findOrFail($id);
        $booking['status'] = $request->status;
        $booking->save();
        return back()->with('success', 'anda berhasil absen');
    }

    public function jawaban_siswa(Request $request, $id)
    {
        $booking = Nilai_tugas::findOrFail($id);
        $booking['jawaban_siswa'] = $request->jawaban_siswa;
        $booking->save();
        return back()->with('success', 'berhasi mengirim jawaban');
    }

    public function get_jawaban_siswa(Request $request, $id)
    {
        // $id = $request->id;

        // $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $nilai_tugas = Nilai_tugas::find($id);
        // return response()->json($nilai_tugas);
        return view('frontend.siswa.jawaban', compact('nilai_tugas'));

        // dd($nilai_tugas);
    }

    public function cari_tugas_filter(Request $request, $id)
    {
        $semester = Semester::all();

        // $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();

        $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $semua_tugas_tampil = DB::table('nilai_tugas')
        ->leftjoin('tugas', 'nilai_tugas.tugas_id', '=', 'tugas.id')
        ->leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')
        ->leftjoin('kelas', 'nilai_tugas.kelas_id', '=', 'kelas.id')
        ->select(
            'siswa.name as siswa_name',
            'siswa.nisn as siswa_nisn',
            'kelas.kelas as kelas',
            'tugas.judul as judul',
            'tugas.type as type',
            'tugas.pengumpulan as pengumpulan',
            'tugas.file_or_link as file_or_link',
            'tugas.description as description',
            'nilai_tugas.jawaban_siswa as jawaban_siswa',
            'nilai_tugas.nilai as nilai',
            'nilai_tugas.semester as semester',
            'nilai_tugas.komentar_guru as komentar_guru',
            'nilai_tugas.tanggal as tanggal_tugas',
            'nilai_tugas.pertemuan as pertemuan',
            'nilai_tugas.tahun_ajaran as tahun_ajaran',
            'nilai_tugas.created_at as created_at',
            'nilai_tugas.id as id',
        )
            ->where('siswa_id', Auth::guard('siswa')->user()->id)
            ->where('nilai_tugas.jadwal_id', $jadwal->id)
            ->where('nilai_tugas.semester', 'like', '%' . $request->semester . '%')
            ->where('nilai_tugas.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->groupBy(
                'siswa.name',
                'siswa.nisn',
                'kelas.kelas',
                'tugas.judul',
                'tugas.type',
                'tugas.file_or_link',
                'tugas.description',
                'nilai_tugas.jawaban_siswa',
                'nilai_tugas.nilai',
                'nilai_tugas.semester',
                'nilai_tugas.komentar_guru',
                'nilai_tugas.tanggal',
                'nilai_tugas.pertemuan',
                'nilai_tugas.tahun_ajaran',
                'tugas.pengumpulan',
                'nilai_tugas.created_at',
                'nilai_tugas.id',
            )
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        return view('frontend.siswa.tugas.cari_tugas_filter', compact('semua_tugas_tampil', 'jadwal', 'semester'));
    }

    public function cari_materi_filter(Request $request, $id)
    {
        $semester = Semester::all();
        $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $cari_materi_filter = DB::table('materi')
        ->leftjoin('semester', 'materi.semester', '=', 'semester.id')
        ->select(
            'materi.judul as judul',
            'materi.type as type',
            'materi.file_or_link as file_or_link',
            'materi.description as description',
            'materi.pertemuan as pertemuan',
            // 'materi.semester as semester',
            'materi.tanggal as tanggal',
            'materi.tahun_ajaran as tahun_ajaran',
            'materi.kelas_id as kelas_id',
            'semester.name as semester',
        )
            ->where('materi.jadwal_id', $jadwal->id)
            ->where('materi.semester', 'like', '%' . $request->semester . '%')
            ->where('materi.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->groupBy(
                'materi.judul',
                'materi.type',
                'materi.file_or_link',
                'materi.description',
                'materi.pertemuan',
                // 'materi.semester',
                'materi.tanggal',
                'materi.tahun_ajaran',
                'materi.kelas_id',
                'semester.name',
            )
            ->limit(10)
            ->orderBy('semester', 'desc')
            ->get();

        return view('frontend.siswa.materi.cari_materi_filter', compact('cari_materi_filter', 'jadwal', 'semester'));
    }

    public function cari_ulangan_filter(Request $request, $id)
    {
        $semester = Semester::all();
        $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $cari_ulangan_filter = DB::table('nilai_ulangan')
        ->leftjoin('ulangan', 'nilai_ulangan.ulangan_id', '=', 'ulangan.id')
        ->leftjoin('semester', 'nilai_ulangan.semester', '=', 'semester.id')
        ->leftjoin(
            'siswa',
            'nilai_ulangan.siswa_id',
            '=',
            'siswa.id'
        )
            ->leftjoin(
                'kelas',
                'nilai_ulangan.kelas_id',
                '=',
                'kelas.id'
            )
            ->where('nilai_ulangan.jadwal_id', $jadwal->id)
            ->where('nilai_ulangan.semester', 'like', '%' . $request->semester . '%')
            ->where('nilai_ulangan.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->where('siswa_id', Auth::guard('siswa')->user()->id)
            ->select(
                'siswa.name as siswa_name',
                'siswa.nisn as siswa_nisn',
                'kelas.kelas as kelas',
                'ulangan.judul as judul_ulangan',
                'ulangan.type as type',
                'ulangan.pengumpulan as pengumpulan',
                'ulangan.file_or_link as file_or_link',
                'ulangan.description as description',
                'nilai_ulangan.jawaban_siswa as jawaban_siswa',
                'nilai_ulangan.nilai as nilai',
                // 'nilai_ulangan.semester as semester',
                'nilai_ulangan.komentar_guru as komentar_guru',
                'nilai_ulangan.tanggal as tanggal_ulangan',
                'nilai_ulangan.pertemuan as pertemuan',
                'nilai_ulangan.tahun_ajaran as tahun_ajaran',
                'nilai_ulangan.created_at as created_at',
                'nilai_ulangan.id as id',
                'semester.name as semester',
            )
            ->groupBy(
                'siswa.name',
                'siswa.nisn',
                'kelas.kelas',
                'ulangan.judul',
                'ulangan.type',
                'ulangan.file_or_link',
                'ulangan.description',
                'nilai_ulangan.jawaban_siswa',
                'nilai_ulangan.nilai',
                // 'nilai_ulangan.semester',
                'nilai_ulangan.komentar_guru',
                'nilai_ulangan.tanggal',
                'nilai_ulangan.pertemuan',
                'nilai_ulangan.tahun_ajaran',
                'ulangan.pengumpulan',
                'nilai_ulangan.created_at',
                'nilai_ulangan.id',
                'semester.name',
            )
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        return view('frontend.siswa.ulangan.cari_ulangan_filter', compact('cari_ulangan_filter', 'jadwal', 'semester'));
    }

    public function cari_ujian_filter(Request $request, $id)
    {
        $semester = Semester::all();
        $jadwal = Jadwal::with(['kelas'], ['guru'], ['mata_pelajaran'])->where('id', decrypt($id))->first();
        $cari_ujian_filter = DB::table('nilai_ujian')
        ->leftjoin('ujian', 'nilai_ujian.ujian_id', '=', 'ujian.id')
        ->leftjoin('semester', 'nilai_ujian.semester', '=', 'semester.id')
        ->leftjoin(
            'siswa',
            'nilai_ujian.siswa_id',
            '=',
            'siswa.id'
        )
            ->leftjoin('kelas', 'nilai_ujian.kelas_id', '=', 'kelas.id')
            ->where(
                'nilai_ujian.jadwal_id',
                $jadwal->id
            )
            ->where('nilai_ujian.jadwal_id', $jadwal->id)
            ->where('nilai_ujian.semester', 'like', '%' . $request->semester . '%')
            ->where('nilai_ujian.tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->where('siswa_id', Auth::guard('siswa')->user()->id)
            ->select(
                'siswa.name as siswa_name',
                'siswa.nisn as siswa_nisn',
                'kelas.kelas as kelas',
                'ujian.judul as judul',
                'ujian.type as type',
                'ujian.pengumpulan as pengumpulan',
                'ujian.file_or_link as file_or_link',
                'ujian.description as description',
                'nilai_ujian.jawaban_siswa as jawaban_siswa',
                'nilai_ujian.nilai as nilai',
                // 'nilai_ujian.semester as semester',
                'nilai_ujian.komentar_guru as komentar_guru',
                'nilai_ujian.tanggal as tanggal_ujian',
                'nilai_ujian.pertemuan as pertemuan',
                'nilai_ujian.tahun_ajaran as tahun_ajaran',
                'nilai_ujian.created_at as created_at',
                'nilai_ujian.id as id',
                'semester.name as semester',
            )
            ->groupBy(
                'siswa.name',
                'siswa.nisn',
                'kelas.kelas',
                'ujian.judul',
                'ujian.type',
                'ujian.file_or_link',
                'ujian.description',
                'nilai_ujian.jawaban_siswa',
                'nilai_ujian.nilai',
                // 'nilai_ujian.semester',
                'nilai_ujian.komentar_guru',
                'nilai_ujian.tanggal',
                'nilai_ujian.pertemuan',
                'nilai_ujian.tahun_ajaran',
                'ujian.pengumpulan',
                'nilai_ujian.created_at',
                'nilai_ujian.id',
                'semester.name',
            )
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        return view('frontend.siswa.ujian.cari_ujian_filter', compact('cari_ujian_filter', 'jadwal', 'semester'));
    }
}
