<?php

namespace App\Http\Controllers\Guru;

use App\Exports\SoalExport;
use App\Http\Controllers\Controller;
use App\Imports\Soalimport;
use App\Models\Category_soal;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

set_time_limit(10800);

class SoalController extends Controller
{
    public function index($category_soal, $jadwal)
    {
        // $jadwal = Jadwal::where('id', decrypt($jadwal))->first();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $jadwal = Jadwal::where('id', decrypt($jadwal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', $jadwal->mata_pelajaran_id)->get();

        $kelas = Kelas::all();
        // $soal = Soal::with('guru')->get();
        return view('frontend.guru.soal.mata_pelajaran', compact('mata_pelajaran', 'kelas', 'category_soal', 'jadwal'));
    }

    public function export(Request $request)
    {
        // return Excel::download(new SoalExport(), 'soal.xlsx');


        $guru_id = Auth::guard('guru')->user()->id;
        $kelas_id = $request->kelas_id;
        $category_soal_id = $request->category_soal_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;
        // $tahun_ajaran = \Carbon\Carbon::now('Asia/Jakarta')->format('Y');
        $semester_id = $request->semester_id;
        // return (new SoalExport($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $tahun_ajaran, $semester_id))->download('invoices.xlsx');

        return Excel::download(new SoalExport($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $semester_id), 'soal.xlsx');
    }

    public function import(Request $request)
    {
        $guru_id = Auth::guard('guru')->user()->id;
        $kelas_id = $request->kelas_id;
        $category_soal_id = $request->category_soal_id;
        $mata_pelajaran_id = $request->mata_pelajaran_id;
        $tahun_ajaran = $request->tahun_ajaran;
        $semester_id = $request->semester_id;
        $tanggal = $request->tanggal;
        Excel::import(new Soalimport($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $tahun_ajaran, $semester_id, $tanggal), request()->file('file'));

        return back();
    }


    public function semester($mata_pelajaran_id, $category_soal)
    {
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $semester = Semester::all();

        return view('frontend.guru.soal.semester', compact('mata_pelajaran', 'category_soal', 'semester'));
    }


    public function soal($semester, $category_soal, $mata_pelajaran_id)
    {
        // $semestersemester = Semester::FindOrFail(decrypt($semester));

        $semestersemester = Semester::where('id', decrypt($semester))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();
        $soal = Soal::with('guru', 'mata_pelajaran', 'kelas')->where('tahun_ajaran', \Carbon\Carbon::now('Asia/Jakarta')->format('Y'))->where('semester_id', $semestersemester->id)->where('category_soal_id', $category_soal->id)->where('kelas_id', $category_soal->kelas_id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('guru_id', Auth::guard('guru')->user()->id)->get();

        return view('frontend.guru.soal.index', compact('semestersemester', 'category_soal', 'mata_pelajaran', 'soal'));
    }

    public function store(Request $request)
    {
        $create = [
            'soal' => $request->soal,
            // 'file' => $request->file('file')->store('assets/soal', 'public'),
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'jawaban' => $request->jawaban,
            'tahun_ajaran' => $request->tahun_ajaran,
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'category_soal_id' => $request->category_soal_id,
            'semester_id' => $request->semester_id,
        ];

        $soal =  Soal::create($create);
        // dd($soal);
        return back()->with('success', 'berhasil menambah soal');
        // return view('frontend.guru.soal.index', compact('mata_pelajaran', 'soal', 'category_soal'))->with('success', 'berhasil menambahkan soal');
    }



    // siswa
    public function siswa_index($category_soal, $jadwal)
    {
        // $jadwal = Jadwal::where('id', decrypt($jadwal))->first();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $jadwal = Jadwal::where('id', decrypt($jadwal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', $jadwal->mata_pelajaran_id)->get();

        $kelas = Kelas::all();
        // $soal = Soal::with('guru')->get();
        return view('frontend.siswa.soal.mata_pelajaran', compact('mata_pelajaran', 'kelas', 'category_soal', 'jadwal'));
    }

    public function siswa_semester($mata_pelajaran_id, $category_soal)
    {
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $semester = Semester::all();

        return view('frontend.siswa.soal.semester', compact('mata_pelajaran', 'category_soal', 'semester'));
    }


    public function siswa_soal($semester, $category_soal, $mata_pelajaran_id)
    {
        // $semestersemester = Semester::FindOrFail(decrypt($semester));

        $semestersemester = Semester::where('id', decrypt($semester))->firstOrFail();
        $category_soal = Category_soal::where('id', decrypt($category_soal))->firstOrFail();
        $mata_pelajaran = MataPelajaran::where('id', decrypt($mata_pelajaran_id))->firstOrFail();

        $soal = DB::table('soal')
        ->leftjoin('kelas', 'soal.kelas_id', '=', 'kelas.id')
        ->leftjoin('mata_pelajaran', 'soal.mata_pelajaran_id', '=', 'mata_pelajaran.id')
        ->leftjoin('semester', 'soal.semester_id', '=', 'semester.id')
        ->where('tahun_ajaran', \Carbon\Carbon::now('Asia/Jakarta')->format('Y'))
            ->where('semester_id', $semestersemester->id)
            ->where('category_soal_id', $category_soal->id)
            ->where('kelas_id', $category_soal->kelas_id)
            ->where('mata_pelajaran_id', $mata_pelajaran->id)
            ->select(
                'soal.soal as soal',
                'soal.opsi_a as opsi_a',
                'soal.opsi_b as opsi_b',
                'soal.opsi_c as opsi_c',
                'soal.opsi_d as opsi_d',
                'soal.id as id',
                'soal.jawaban as jawaban',
                'soal.tanggal as tanggal',
                'semester.name as semester',
                'kelas.kelas as kelas',
                'mata_pelajaran.name as mata_pelajaran',
                // 'nilai_tugas.id as id_nilai',
                // 'nilai_tugas.status as tugas_status',

                DB::raw('COUNT(tanggal) as total'),
            )
            ->groupBy('soal.soal', 'soal.id', 'soal.opsi_a', 'soal.opsi_b', 'soal.opsi_c', 'soal.opsi_d', 'soal.jawaban', 'semester.name', 'kelas.kelas', 'mata_pelajaran.name', 'soal.tanggal')
            // ->limit(10)
            ->orderBy('tanggal', 'desc')
            ->distinct()
            ->get();
        // $soal = Soal::with('guru', 'mata_pelajaran', 'kelas')->get();

        return view('frontend.siswa.soal.index', compact('semestersemester', 'category_soal', 'mata_pelajaran', 'soal'));
    }
}
