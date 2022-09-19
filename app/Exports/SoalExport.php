<?php

namespace App\Exports;

use App\Models\Category_soal;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\Soal;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;

class SoalExport implements FromView
{

    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $semester_id)
    {
        $this->guru_id = $guru_id;
        $this->kelas_id = $kelas_id;
        $this->category_soal_id = $category_soal_id;
        $this->mata_pelajaran_id = $mata_pelajaran_id;
        $this->semester_id = $semester_id;
        // $this->tahun_ajaran = $tahun_ajaran;
    }

    // public function __construct(int $year)
    // {
    //     $this->year = $year;
    // }


    // public function collection()
    // {
    //     return Soal::all();
    // return Soal::with('guru', 'mata_pelajaran', 'kelas')->where('tahun_ajaran', \Carbon\Carbon::now('Asia/Jakarta')->format('Y'))->where('semester_id', $this->semester_id)->where('category_soal_id', $this->category_soal_id)->where('kelas_id', $this->kelas_id)->where('mata_pelajaran_id', $this->mata_pelajaran_id)->where('guru_id', $this->guru_id)->get();
    // }
    public function view(): View
    {
        $soal = Soal::with('guru', 'mata_pelajaran', 'kelas')->where('tahun_ajaran', \Carbon\Carbon::now('Asia/Jakarta')->format('Y'))->where('semester_id', $this->semester_id)->where('category_soal_id', $this->category_soal_id)->where('kelas_id', $this->kelas_id)->where('mata_pelajaran_id', $this->mata_pelajaran_id)->where('guru_id', $this->guru_id)->get();

        return view('frontend.guru.soal.export', compact('soal'));
    }
}
