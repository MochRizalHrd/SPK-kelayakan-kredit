<?php

namespace App\Controllers;
use App\Models\WPModel;

class Home extends BaseController
{
    protected $wpModel;

    public function __construct()
    {
        $this->wpModel = new WPModel();
    }

    public function index()
    {
        $wp = new \App\Models\WPModel();
        $ranking = $this->wpModel->getRanking();
        $labels = array_column($ranking, 'nama');
        $data = array_column($ranking, 'nilai');

        return view('dashboard/dashboard', [
            'title' => 'Dashboard',
            'labels' => json_encode($labels),
            'data' => json_encode($data),
            'jumlahKriteria' => count($wp->getKriteria()),
            'jumlahAlternatif'=> count($wp->getAlternatif()),
            
        ]);
    }
}
