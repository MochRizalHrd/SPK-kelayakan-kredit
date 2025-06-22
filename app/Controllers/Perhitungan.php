<?php

// ==========================
// CONTROLLER: Perhitungan
// ==========================

namespace App\Controllers;

use App\Models\WPModel;

class Perhitungan extends BaseController
{

    protected $wpModel;

    public function __construct()
    {
        $this->wpModel = new WPModel();
    }

    public function view(): string
    {
        $data = [
            'title'     => 'Data Perhitungan',
            'kriteria'  => $this->wpModel->getKriteria(),
            'detail'    => $this->wpModel->getDetailNilai(),
            'nilai_s'   => $this->wpModel->hitungS(),
            'pangkat'   => $this->wpModel->getPangkatWP(),
        ];


        return view('dashboard/perhitungan.php', $data);
    }


    public function hasil(): string
    {
        $rangking = $this->wpModel->getRanking();
        $data = [
            'title' => 'Hasil Perangkingan',
            'rangking' => $rangking
        ];
        return view('dashboard/hasilakhir.php', $data);
    }
}
