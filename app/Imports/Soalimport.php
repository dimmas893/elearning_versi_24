<?php

namespace App\Imports;

use App\Models\Soal;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Soalimport implements ToModel
{

    public function __construct($guru_id, $kelas_id, $category_soal_id, $mata_pelajaran_id, $tahun_ajaran, $semester_id, $tanggal)
    {
        $this->guru_id = $guru_id;
        $this->kelas_id = $kelas_id;
        $this->category_soal_id = $category_soal_id;
        $this->mata_pelajaran_id = $mata_pelajaran_id;
        $this->tahun_ajaran = $tahun_ajaran;
        $this->semester_id = $semester_id;
        $this->tanggal = $tanggal;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Soal([
            // 'id'     => $row[0],
            'guru_id'     => $this->guru_id,
            'kelas_id'     => $this->kelas_id,
            'category_soal_id'     => $this->category_soal_id,
            'mata_pelajaran_id'     => $this->mata_pelajaran_id,
            'soal'     => $row[0],
            'opsi_a'    => $row[1],
            'opsi_b'    => $row[2],
            'opsi_c'    => $row[3],
            'opsi_d'    => $row[4],
            'jawaban'    => $row[5],
            'tahun_ajaran'    => $this->tahun_ajaran,
            'semester_id'    => $this->semester_id,
            'tanggal'    => $this->tanggal,
        ]);
    }
}
