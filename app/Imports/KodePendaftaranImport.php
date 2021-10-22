<?php

namespace App\Imports;

use App\KodePendaftaran;
use Maatwebsite\Excel\Concerns\ToModel;

class KodePendaftaranImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cekkodependaftaran = KodePendaftaran::where('kode','=',$row[0])->count();
        if($cekkodependaftaran == 0)
        {
            $kode = $row[0];
            return new KodePendaftaran([
                'kode' => $kode,
                'is_use' => 'N'
            ]);
        }
       
    }
}
