<?php

namespace App\Controllers;

use App\Models\RatingModel;

class Rating extends BaseController
{
    protected $ratingModel;

    public function __construct()
    {

        $this->ratingModel = new RatingModel();
    }


    public function view(): string
    {
        $data = [
            'rating' => $this->ratingModel->findAll(),
            'title' => 'Data Rating Kecocokan Nilai'
        ];
        return view('dashboard/rating', $data);   // Kirim ke view
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

        $this->ratingModel->save($data);

        return redirect()->to(base_url('rating_nilai'))->with('success', 'Data rating kecocokan nilai berhasil ditambahkan.');
    }

    public function editRating($id)
    {
        $ratingModel = new RatingModel();
        $rating = $ratingModel->find($id);

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

        $ratingModel->update($id, $data);

        return redirect()->to(base_url('rating_nilai'))->with('success', 'Data rating kecocokan nilai berhasil diperbarui.');
    }

    public function deleteRating($id)
    {
        $ratingModel = new RatingModel();
        $ratingModel->delete($id);
        return redirect()->to(base_url('rating_nilai'))->with('success', 'Data rating kecocokan nilai dihapus.');
    }
}
