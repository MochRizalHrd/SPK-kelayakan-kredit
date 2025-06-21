<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\PairwiseModel;
use CodeIgniter\Controller;

class AHPController extends Controller
{
    public function view(): string
    {
        // Ambil data kriteria dari model jika dibutuhkan
        $kriteria = (new KriteriaModel())->findAll();
        $nilai = session('perbandingan_ahp') ?? [];


        // Kirim data ke view jika diperlukan
        return view('dashboard/ahp/bobot_preferensi', [
            'title' => 'Bobot Preferensi AHP',
            'kriteria' => $kriteria,
            'nilai' => $nilai
        ]);
    }

    public function simpan()
    {
        $kriteria = (new KriteriaModel())->findAll();
        $inputData = [];

        foreach ($kriteria as $i) {
            foreach ($kriteria as $j) {
                if ($i['id'] < $j['id']) {
                    $key = 'nilai_' . $i['id'] . '_' . $j['id'];
                    $value = $this->request->getPost($key);

                    if ($value !== null) {
                        $value = floatval($value);
                        // Pembulatan agar nilai seperti 3.00003 jadi 3
                        $value = abs($value - round($value)) < 0.001 ? round($value) : round($value, 5);
                        $inputData[$key] = $value;
                    }
                }
            }
        }
        // Simpan ke session
        session()->set('perbandingan_ahp', $inputData);

        session()->setFlashdata('success', 'Data berhasil disimpan ke session!');
        return redirect()->to(base_url('/ahp/bobot_ahp'));
    }


    public function cekKonsistensi()
    {
        $session = session();
        $nilai = $session->get('perbandingan_ahp');

        if (!$nilai) {
            return redirect()->back()->with('error', 'Data perbandingan belum tersedia.');
        }

        $kriteriaModel = new KriteriaModel();
        $kriteria = $kriteriaModel->findAll();
        $n = count($kriteria);
        $ids = array_column($kriteria, 'id');

        // 1. Matriks Simetris
        $matriks = [];
        foreach ($ids as $i) {
            foreach ($ids as $j) {
                if ($i === $j) {
                    $matriks[$i][$j] = 1;
                } elseif ($i < $j) {
                    $key = "nilai_{$i}_{$j}";
                    $val = floatval($nilai[$key] ?? 1);
                    $val = round($val, 11);
                    $matriks[$i][$j] = $val;
                    $matriks[$j][$i] = round(1 / $val, 11);
                }
            }
        }

        // 2. Matriks 2D
        $matriks2D = [];
        foreach ($ids as $i) {
            $baris = [];
            foreach ($ids as $j) {
                $baris[] = $matriks[$i][$j];
            }
            $matriks2D[] = $baris;
        }

        // 3. Normalisasi & Prioritas
        $totalKolom = array_fill(0, $n, 0);
        foreach ($matriks2D as $row) {
            foreach ($row as $j => $val) {
                $totalKolom[$j] += $val;
            }
        }

        $normalisasi = [];
        $prioritas = [];

        for ($i = 0; $i < $n; $i++) {
            $row = [];
            for ($j = 0; $j < $n; $j++) {
                $row[] = $matriks2D[$i][$j] / $totalKolom[$j];
            }
            $normalisasi[] = $row;

            // Ambil rata-rata baris dan bulatkan ke 11 angka di belakang koma
            $rata2 = array_sum($row) / $n;
            $prioritas[] = round($rata2, 11);
        }


        $engine_vector = [];
        $total_engine_vector = array_fill(0, $n, 0);

        for ($i = 0; $i < $n; $i++) {
            $row = [];
            for ($j = 0; $j < $n; $j++) {
                $val = $matriks2D[$i][$j] * $prioritas[$i]; // *prioritas baris i, bukan j
                $row[] = $val;
                $total_engine_vector[$j] += $val;
            }
            $engine_vector[] = $row;
        }


        $rasio_konsistensi = [];
        $lambda_sum = 0;

        for ($i = 0; $i < $n; $i++) {
            $jumlah = array_sum($engine_vector[$i]); // jumlah dari baris hasil perkalian
            $prioritas_i = $jumlah / $n;             // prioritas = jumlah / n
            $hasil = $jumlah + $prioritas_i;         // hasil = jumlah + prioritas

            $rasio_konsistensi[] = [
                'kriteria' => $kriteria[$i]['kriteria'],
                'jumlah' => $jumlah,
                'prioritas' => $prioritas_i,
                'hasil' => $hasil,
            ];

            $lambda_sum += $hasil;
        }

        $lambda_max = $lambda_sum / $n;
        $ci = ($lambda_max - $n) / $n;
        $ri_table = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];
        $ri = $ri_table[$n - 1] ?? 1.49;
        $cr = $ri != 0 ? $ci / $ri : 0;




        // Simpan ke session
        $session->set('ahp_hasil_konsistensi', [
            'kriteria' => $kriteria,
            'matriks' => $matriks2D,
            'normalisasi' => $normalisasi,
            'prioritas' => $prioritas,
            'engine_vector' => $engine_vector,
            'total_engine_vector' => $total_engine_vector,
            'lambda_max' => $lambda_max,
            'ci' => $ci,
            'cr' => $cr,
            'rasio_konsistensi' => $rasio_konsistensi,
            'total_jumlah' => array_sum(array_map('array_sum', $engine_vector)),
            'total_prioritas' => array_sum($prioritas),
            'total_hasil' => array_sum(array_column($rasio_konsistensi, 'hasil')),
        ]);

        return redirect()->to(base_url('/ahp/bobot_ahp'));
    }



    public function reset()
    {
        // Hapus data perbandingan dari session
        session()->remove('perbandingan_ahp');
        session()->remove('ahp_hasil_konsistensi');

        // Notifikasi sukses
        session()->setFlashdata('success', 'Data perbandingan berhasil di-reset.');

        // Redirect kembali ke form AHP
        return redirect()->to(base_url('/ahp/bobot_ahp'));
    }
}
