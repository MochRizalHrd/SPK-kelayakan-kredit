<?php

namespace App\Controllers;

class Perhitungan extends BaseController
{
    public function view(): string
    {
        $data = [
            'title' => 'Data Perhitungan'
        ];
        return view('dashboard/perhitungan.php',$data);
    }
    public function hasil(): string
    {
        $data = [
            'title' => 'Hasil Perangkingan'
        ];
        return view('dashboard/hasilakhir.php',$data);
    }
}
