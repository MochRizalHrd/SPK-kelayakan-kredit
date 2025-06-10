<?php

namespace App\Controllers;

use App\Models\PembobotanModel;

class Pembobotan extends BaseController
{
    protected $pembobotanModel;

    public function __construct()
    {

        $this->pembobotanModel = new PembobotanModel();
    }


    public function view(): string
    {
        $data = [
            'pembobotan' => $this->pembobotanModel->findAll(),
            'title' => 'Pembobotan Nilai Kriteria'
        ];
        return view('dashboard/pembobotan', $data);   // Kirim ke view
    }

    // Tambah Kriteria Berat
    public function add()
    {

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'bobot' => $this->request->getPost('bobot'),
        ];

        $this->pembobotanModel->save($data);

        return redirect()->to(base_url('pembobotan'))->with('success', 'Data pembobotan nilai kriteria berhasil ditambahkan.');
    }

    public function editPembobotan($id)
    {
        $pembobotanModel = new PembobotanModel();
        $pembobotan = $pembobotanModel->find($id);

        // Ambil data dari form
        $keterangan       = $this->request->getPost('keterangan');
        $bobot            = $this->request->getPost('bobot');

        $data = [
            'keterangan'      => $keterangan,
            'bobot'           => $bobot,
        ];

        $pembobotanModel->update($id, $data);

        return redirect()->to(base_url('pembobotan'))->with('success', 'Data pembobotan nilai kriteria berhasil diperbarui.');
    }

    public function deletePembobotan($id)
    {
        $pembobotanModel = new PembobotanModel();
        $pembobotanModel->delete($id);
        return redirect()->to(base_url('pembobotan'))->with('success', 'Data pembobotan nilai kriteria berhasil dihapus.');
    }
}
