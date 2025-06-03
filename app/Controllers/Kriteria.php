<?php

namespace App\Controllers;

use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    protected $kriteriaModel;

    public function __construct()
    {

        $this->kriteriaModel = new KriteriaModel();
    }


    public function view(): string
    {
        $data = [
            'kriteria' => $this->kriteriaModel->findAll(),
            'title' => 'Data Kriteria'
        ];
        return view('dashboard/kriteria', $data);   // Kirim ke view
    }

    // Tambah Kriteria
    public function add()
    {

        $data = [
            'kriteria' => $this->request->getPost('kriteria'),
            'jenis' => $this->request->getPost('jenis'),
            'bobot' => $this->request->getPost('bobot'),
        ];

        $this->kriteriaModel->save($data);

        return redirect()->to(base_url('kriteria'))->with('success', 'Data kriteria berhasil ditambahkan.');
    }

    public function editKriteria($id)
    {
        $kriteriaModel = new KriteriaModel();
        $kriteria = $kriteriaModel->find($id);

        // Ambil data dari form
        $kriteria       = $this->request->getPost('kriteria');
        $jenis       = $this->request->getPost('jenis');
        $bobot          = $this->request->getPost('bobot');

        $data = [
            'kriteria'      => $kriteria,
            'jenis'      => $jenis,
            'bobot'     => $bobot,
        ];

        $kriteriaModel->update($id, $data);

        return redirect()->to(base_url('kriteria'))->with('success', 'Data kriteria berhasil diperbarui.');
    }

    public function delete($id)
    {
        $kriteriaModel = new KriteriaModel();
        $kriteriaModel->delete($id);
        return redirect()->to(base_url('kriteria'))->with('success', 'Data kriteria berhasil dihapus.');
    }
}
