<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\guru_kelas;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Nilai_tugas;
use App\Models\Nilai_Ujian;
use App\Models\Nilai_Ulangan;
use App\Models\Raport;
use App\Models\Ruangan;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RaportController extends Controller
{
    public function index()
    {

        $semester = Semester::all();
        $kelas = Kelas::all();
        $nilai_tugas = DB::table('nilai_tugas')
            ->leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_tugas.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_tugas.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_tugas.tahun_ajaran as tahun_ajaran',
                // 'nilai_tugas.id as id_nilai',
                // 'nilai_tugas.status as tugas_status',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_tugas.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->distinct()
            ->get();


        $nilai_ulangan = DB::table('nilai_ulangan')
            ->leftjoin('siswa', 'nilai_ulangan.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_ulangan.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ulangan.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ulangan.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ulangan.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        $nilai_ujian = DB::table('nilai_ujian')
            ->leftjoin('siswa', 'nilai_ujian.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_ujian.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ujian.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ujian.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ujian.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        // $nilai_tugas = Nilai_tugas::leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')->select(
        //     'siswa.name as siswa_name',

        //     DB::raw('sum(nilai) as nilai')
        // )
        //    ->groupBy('siswa.name', 'semesters', 'kelas.kelas')
        //     ->limit(10)
        //     ->orderBy('nilai', 'desc')
        //     ->get();


        // $nilai_ann = $nilai_ujian->nilai
        // $nilai_tugas = Nilai_tugas::with('hitungTugas')->sum('nilai');
        // $nilai = $nilai_tugas->hitungTugas($nilai_tugas);
        // dd($nilai_ann);  
        return view('frontend.guru.raport.index', compact('nilai_tugas', 'nilai_ulangan', 'nilai_ujian', 'kelas', 'semester'));
    }

    public function raport(Request $request)
    {

        $semester = Semester::all();
        $kelas = Kelas::all();
        $raport = Raport::with('siswa', 'kelas')->get();
        return view('frontend.guru.raport.buat', compact('raport', 'kelas', 'semester'));
    }

    public function raport_cari(Request $request)
    {

        $semester = Semester::all();
        $raport = Raport::with('siswa', 'kelas')->where('semester', 'like', '%' . $request->cari . '%')->where('kelas_id', 'like', '%' . $request->kelas . '%')->get();
        $kelas = Kelas::all();
        return view('frontend.guru.raport.cari_nilai', compact('raport', 'kelas', 'semester'));
    }

    public function get_raport(Request $request, $id)
    {
        // $nilai_tugas = DB::table('nilai_tugas')
        //     ->leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')
        //     ->select(
        //         'siswa.name as siswa_name',
        //         'nilai_tugas.id as id_nilai',
        //         // 'nilai_tugas.status as tugas_status',

        //         DB::raw('AVG(nilai) as nilai')
        //     )
        //     ->groupBy('siswa.name', 'nilai_tugas.id')
        //     ->limit(10)
        //     ->orderBy('nilai', 'desc')
        //     ->get();

        $raport = Raport::FindOrFail($id);
        return view('frontend.guru.raport.raport-get', compact('raport'));
    }

    public function get_raport_admin()
    {
        $semester = Semester::all();
        // $raport = Raport::FindOrFail($id);
        return view('admin.guru.raport', compact('semester'));
    }

    public function raport_save(Request $request, $id)
    {
        $booking = Raport::findOrFail($id);
        $booking['nilai_tugas'] = $request->nilai_tugas;
        $booking['nilai_ulangan'] = $request->nilai_ulangan;
        $booking['nilai_ujian'] = $request->nilai_ujian;
        $booking['nilai_raport'] = $request->nilai_tugas + $request->nilai_ulangan + $request->nilai_ujian;
        $booking->save();
        return back()->with('success', 'berhasi mengirim nilai');
    }

    public function cari_raport(Request $request)
    {

        $semester = Semester::all();
        $kelas = Kelas::all();
        // $nilai_tugas  = Nilai_tugas::where('semester', 'like', '%' . $request->cari . '%')->get();
        $nilai_tugas = DB::table('nilai_tugas')
            ->leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_tugas.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_tugas.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_tugas.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->where('semester', 'like', '%' . $request->cari . '%')
            ->where('kelas_id', 'like', '%' . $request->kelas . '%')
            ->where('tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_tugas.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();


        $nilai_ulangan = DB::table('nilai_ulangan')
            ->leftjoin('siswa', 'nilai_ulangan.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_ulangan.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ulangan.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ulangan.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->where('semester', 'like', '%' . $request->cari . '%')
            ->where('kelas_id', 'like', '%' . $request->kelas . '%')
            ->where('tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ulangan.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();


        $nilai_ujian = DB::table('nilai_ujian')
            ->leftjoin(
                'siswa',
                'nilai_ujian.siswa_id',
                '=',
                'siswa.id'
            )
            ->where('semester', 'like', '%' . $request->cari . '%')
            ->where('kelas_id', 'like', '%' . $request->kelas . '%')
            ->where('tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->leftjoin('kelas', 'nilai_ujian.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ujian.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ujian.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ujian.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        return view('frontend.guru.raport.cari', compact(
            'nilai_tugas',
            'nilai_ujian',
            'nilai_ulangan',
            'kelas',
            'semester'
        ));
    }

    public function wali_kelas()
    {

        $semester = Semester::all();
        $wali_kelas = guru_kelas::where('guru_id', Auth::guard('guru')->user()->id)->first();
        $raport = DB::table('raport')
        ->leftjoin(
            'siswa',
            'raport.siswa_id',
            '=',
            'siswa.id'
        )
        ->leftjoin(
            'kelas',
            'raport.kelas_id',
            '=',
            'kelas.id'
        )
        ->leftjoin(
            'semester',
            'raport.semester',
            '=',
            'semester.id'
        )
        ->where('kelas_id', $wali_kelas->kelas_id)
        ->select(
            'semester.name as semester',
            'raport.nilai_tugas as nilai_tugas',
            'raport.nilai_ulangan as nilai_ulangan',
            'raport.nilai_ujian as nilai_ujian',
            'raport.nilai_raport as nilai_raport',
            'raport.tahun_ajaran as tahun_ajaran',
            'raport.id as id',
            // 'raport.semester as semester',
            'siswa.name as siswa_name',
            'siswa.nisn as siswa_nisn',
            'kelas.kelas as kelas_name',
        )
            ->groupBy('semester.name', 'raport.nilai_tugas', 'raport.nilai_ulangan', 'raport.nilai_ujian', 'raport.nilai_raport', 'raport.id', 'raport.semester', 'siswa.name', 'siswa.nisn', 'raport.tahun_ajaran', 'kelas.kelas')
            ->limit(10)
            ->orderBy('semester', 'desc')
            ->get();
        return view('frontend.guru.wali_kelas.raport', compact('raport', 'semester'));
    }


    public function wali_kelas_nilai()
    {

        $semester = Semester::all();
        $wali_kelas = guru_kelas::where('guru_id', Auth::guard('guru')->user()->id)->first();
        $nilai_tugas = DB::table('nilai_tugas')
            ->leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_tugas.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_tugas.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_tugas.tahun_ajaran as tahun_ajaran',
                // 'nilai_tugas.id as id_nilai',
                // 'nilai_tugas.status as tugas_status',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->where('kelas_id', $wali_kelas->kelas_id)
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_tugas.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->distinct()
            ->get();


        $nilai_ulangan = DB::table('nilai_ulangan')
            ->leftjoin('siswa', 'nilai_ulangan.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_ulangan.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ulangan.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ulangan.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->where('kelas_id', $wali_kelas->kelas_id)
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ulangan.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        $nilai_ujian = DB::table('nilai_ujian')
            ->leftjoin('siswa', 'nilai_ujian.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_ujian.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ujian.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ujian.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )

            ->where('kelas_id', $wali_kelas->kelas_id)
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ujian.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();
        return view('frontend.guru.wali_kelas.nilai', compact('nilai_ujian', 'nilai_tugas', 'nilai_ulangan', 'semester'));
    }
    public function wali_kelas_nilai_cari(Request $request)
    {

        $semester = Semester::all();
        $wali_kelas = guru_kelas::where('guru_id', Auth::guard('guru')->user()->id)->first();
        $nilai_tugas = DB::table('nilai_tugas')
            ->leftjoin('siswa', 'nilai_tugas.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_tugas.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_tugas.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_tugas.tahun_ajaran as tahun_ajaran',
                // 'nilai_tugas.id as id_nilai',
                // 'nilai_tugas.status as tugas_status',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->where('kelas_id', $wali_kelas->kelas_id)
            ->where('semester', 'like', '%' . $request->semester . '%')
            ->where('tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_tugas.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->distinct()
            ->get();


        $nilai_ulangan = DB::table('nilai_ulangan')
            ->leftjoin('siswa', 'nilai_ulangan.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_ulangan.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ulangan.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ulangan.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )
            ->where('kelas_id', $wali_kelas->kelas_id)
            ->where('semester', 'like', '%' . $request->semester . '%')
            ->where('tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ulangan.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();

        $nilai_ujian = DB::table('nilai_ujian')
            ->leftjoin('siswa', 'nilai_ujian.siswa_id', '=', 'siswa.id')
            ->leftjoin('kelas', 'nilai_ujian.kelas_id', '=', 'kelas.id')
            ->select(
                'siswa.name as siswa_name',
                'nilai_ujian.semester as semesters',
                'kelas.kelas as kelas_name',
                'siswa.nisn as nisn_siswa',
                'nilai_ujian.tahun_ajaran as tahun_ajaran',

                DB::raw('SUM(nilai) as nilai'),
                DB::raw('COUNT(siswa_id) as siswa_id')
            )

            ->where('kelas_id', $wali_kelas->kelas_id)
            ->where('semester', 'like', '%' . $request->semester . '%')
            ->where('tahun_ajaran', 'like', '%' . $request->tahun_ajaran . '%')
            ->groupBy('siswa.name', 'semesters', 'kelas.kelas', 'siswa.nisn', 'nilai_ujian.tahun_ajaran')
            ->limit(10)
            ->orderBy('nilai', 'desc')
            ->get();
        return view('frontend.guru.wali_kelas.nilai', compact('nilai_ujian', 'nilai_tugas', 'nilai_ulangan', 'semester'));
    }

    public function wali_kelas_raport_cari(Request $request)
    {

        $semester = Semester::all();
        $wali_kelas = guru_kelas::where('guru_id', Auth::guard('guru')->user()->id)->first();
        $raport = Raport::with('kelas', 'siswa')->where('kelas_id', $wali_kelas->kelas_id)->where('tahun_ajaran', 'like', '%' . $request->cari . '%')->where('semester', 'like', '%' . $request->semester . '%')->get();
        return view('frontend.guru.wali_kelas.cari_raport', compact('raport', 'semester'));
    }

    public function wali_kelas_raport_cari_id(Request $request, $id)
    {
        $raport = Raport::FindOrFail($id);
        return view('frontend.guru.wali_kelas.beri_nilai', compact('raport'));
    }

    public function wali_kelas_raport_cari_id_post(Request $request, $id)
    {
        $booking = Raport::findOrFail($id);
        $booking['nilai_tugas'] = $request->nilai_tugas;
        $booking['nilai_ulangan'] = $request->nilai_ulangan;
        $booking['nilai_ujian'] = $request->nilai_ujian;
        $booking['nilai_raport'] = $request->nilai_tugas + $request->nilai_ulangan + $request->nilai_ujian;
        $booking->save();
        return back()->with('success', 'berhasi mengirim nilai');
    }

    // public function raport_store(Request $reques_

    //     $datajadwal = Jadwal::with('kelas')->where('id', $request->jadwal_id)->first();
    //     $dataSiswa = Ruangan::where('kelas_id', $datajadwal->kelas_id)->get();


    //     foreach ($dataSiswa as $p) {
    //         Raport::create([
    //             'nilai_tugas' => null,
    //             'nilai_ulangan' => null,
    //             'nilai_ujian' => null,
    //             'nilai_raport' => null,
    //             'siswa_id' => $p->siswa_id
    //         ]);

    //         return back()->with('success', 'tugas berhasil di buat');
    //     }

    //     return back()->with('error', 'tugas gagal di buat');
    // }
}
