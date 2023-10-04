<?php

namespace App\Imports;

use App\Models\Atlet;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class AtletImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        dd($row);
        return new Atlet([
            'atlet_nama_lengkap' => $row[0],
            'atlet_tempat_lahir' => $row[1],
            'atlet_tanggal_lahir' => $row[2],
            'atlet_jenis_kelamin' => $row[3],
            'atlet_alamat' => $row[4],
            'no_hp' => $row[5],
            'atlet_foto' => $row[6],
            'atlet_email' => $row[7],
            'atlet_password' => Hash::make($row[8]),
            'atlet_status' => $row[9],
            'atlet_keterangan' => $row[10],
            'kategori_id' => $row[11],
            'kelas_usia_id' => $row[12],
            'created_at' => $row[13],
            'updated_at' => $row[14],
            'id' => $row[15]
        ]);
    }
}
