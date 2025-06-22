<?php

namespace App\Models;

use CodeIgniter\Model;

class WPModel extends Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // Mengambil semua data alternatif (UMKM)
    public function getAlternatif()
    {
        return $this->db->table('data_konsumen')->get()->getResultArray();
    }

    // Mengambil semua data kriteria beserta bobot dan tipe
    public function getKriteria()
    {
        return $this->db->table('data_kriteria')->get()->getResultArray();
    }

    // Mengambil nilai dari data_konsumen dan konversi nilai kategori ke angka
    public function getNilaiAlternatif()
    {
        $alternatif = $this->getAlternatif();
        $kriteria = $this->getKriteria();

        $result = [];
        foreach ($alternatif as $alt) {
            foreach ($kriteria as $krit) {
                $kritKey = $this->formatKolomKriteria($krit['kriteria']);
                $result[] = [
                    'id_alternatif' => $alt['id'],
                    'id_kriteria'   => $krit['id'],
                    'nilai'         => $this->konversiNilai($alt[$kritKey] ?? '-')
                ];
            }
        }

        return $result;
    }

    // Format nama kolom dari nama kriteria
    private function formatKolomKriteria($text)
    {
        return strtolower(str_replace(' ', '_', $text));
    }

    // Konversi nilai teks ke angka
    public function konversiNilai($teks)
    {
        $mapping = [
            'Sangat Buruk' => 1,
            'Buruk'        => 2,
            'Cukup'        => 3,
            'Baik'         => 4,
            'Sangat Baik'  => 5
        ];
        return $mapping[$teks] ?? (is_numeric($teks) ? (float)$teks : 0);
    }

    // Mendapatkan nilai masing-masing alternatif terhadap semua kriteria
    public function getDetailNilai()
    {
        $nilai = $this->getNilaiAlternatif();
        $alternatif = $this->getAlternatif();
        $kriteria = $this->getKriteria();

        $altMap = array_column($alternatif, 'nama', 'id');

        $result = [];
        foreach ($nilai as $n) {
            $altId = $n['id_alternatif'];
            $kritId = $n['id_kriteria'];

            $result[$altId]['nama'] = $altMap[$altId];
            $result[$altId]['nilai'][$kritId] = $n['nilai'];
        }

        return $result;
    }

    // Tahap 1 & 2: Hitung bobot relatif dan nilai pangkat untuk tiap alternatif
    public function getPangkatWP()
    {
        $nilai = $this->getNilaiAlternatif();
        $kriteria = $this->getKriteria();
        $bobotTotal = array_sum(array_column($kriteria, 'bobot'));

        $bobotMap = [];
        foreach ($kriteria as $k) {
            $bobotMap[$k['id']] = $k['bobot'] / $bobotTotal;
        }

        $dataNilai = [];
        foreach ($nilai as $n) {
            $dataNilai[$n['id_alternatif']][$n['id_kriteria']] = $n['nilai'];
        }

        $hasilPangkat = [];
        foreach ($dataNilai as $idAlt => $kritVals) {
            foreach ($kritVals as $idK => $val) {
                $hasilPangkat[$idAlt][$idK] = pow($val, $bobotMap[$idK]);
            }
        }

        return $hasilPangkat;
    }

    // Tahap 3: Menghitung nilai vektor S
    public function hitungS()
    {
        $pangkat = $this->getPangkatWP();
        $nilaiS = [];

        foreach ($pangkat as $idAlt => $kritVals) {
            $s = 1;
            foreach ($kritVals as $val) {
                $s *= $val;
            }
            $nilaiS[$idAlt] = $s;
        }

        return $nilaiS;
    }

    // Tahap 4: Menghitung nilai V (preferensi)
    public function hitungV()
    {
        $nilaiS = $this->hitungS();
        $totalS = array_sum($nilaiS);

        $nilaiV = [];
        foreach ($nilaiS as $id => $s) {
            $nilaiV[$id] = $s / $totalS;
        }

        return $nilaiV;
    }

    // Tahap 5: Mengurutkan ranking berdasarkan nilai V
    public function getRanking()
    {
        $v = $this->hitungV();
        arsort($v);

        $alternatif = $this->getAlternatif();
        $altMap = array_column($alternatif, 'nama', 'id');

        $result = [];
        foreach ($v as $id => $val) {
            $result[] = [
                'id'    => $id,
                'nama'  => $altMap[$id] ?? 'N/A',
                'nilai' => $val
            ];
        }

        return $result;
    }
}