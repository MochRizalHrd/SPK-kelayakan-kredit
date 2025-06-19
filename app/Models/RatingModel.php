<?php

namespace App\Models;

use CodeIgniter\Model;

class RatingModel extends Model
{
    protected $table = 'rating_kecocokan_nilai';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama',
        'kelayakan_usaha',
        'riwayat_kredit',
        'potensi_pendapatan',
        'jaminan',
        'analisis_pasar'


    ];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
