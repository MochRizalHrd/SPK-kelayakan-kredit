<?php

namespace App\Controllers;

use App\Models\KonsumenModel;

class Konsumen extends BaseController
{
    protected $konsumenModel;

    public function __construct()
    {

        $this->konsumenModel = new KonsumenModel();
    }


    public function view(): string
    {
        $data = [
            'konsumen' => $this->konsumenModel->findAll(),
            'title' => 'Data Konsumen'
        ];
        return view('dashboard/konsumen', $data);   // Kirim ke view
    }

    // Tambah Kriteria
    public function add()
    {

        $data = [
            'nama' => $this->request->getPost('nama'),
            'kelayakan_usaha' => $this->request->getPost('kelayakan_usaha'),
            'riwayat_kredit' => $this->request->getPost('riwayat_kredit'),
            'potensi_pendapatan' => $this->request->getPost('potensi_pendapatan'),
            'jaminan' => $this->request->getPost('jaminan'),
            'analisis_pasar' => $this->request->getPost('analisis_pasar'),
        ];

        $this->konsumenModel->save($data);

        return redirect()->to(base_url('konsumen'))->with('success', 'Data konsumen berhasil ditambahkan.');
    }

    public function editKonsumen($id)
    {
        $konsumenModel = new KonsumenModel();
        $konsumen = $konsumenModel->find($id);

        // Ambil data dari form
        $nama                 = $this->request->getPost('nama');
        $kelayakan_usaha      = $this->request->getPost('kelayakan_usaha');
        $riwayat_kredit       = $this->request->getPost('riwayat_kredit');
        $potensi_pendapatan   = $this->request->getPost('potensi_pendapatan');
        $jaminan              = $this->request->getPost('jaminan');
        $analisis_pasar       = $this->request->getPost('analisis_pasar');

        $data = [
            'nama'                   => $nama,
            'kelayakan_usaha'        => $kelayakan_usaha,
            'riwayat_kredit'         => $riwayat_kredit,
            'potensi_pendapatan'     => $potensi_pendapatan,
            'jaminan'                => $jaminan,
            'analisis_pasar'         => $analisis_pasar,
        ];

        $konsumenModel->update($id, $data);

        return redirect()->to(base_url('konsumen'))->with('success', 'Data konsumen berhasil diperbarui.');
    }

    public function delete($id)
    {
        $konsumenModel = new KonsumenModel();
        $konsumenModel->delete($id);
        return redirect()->to(base_url('konsumen'))->with('success', 'Data konsumen berhasil dihapus.');
    }
}
