<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table      = 'data_kriteria';         // Nama tabel di database
    protected $primaryKey = 'id';               // Primary key

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';      // Bisa juga 'object' jika kamu mau
    protected $useSoftDeletes   = false;

    protected $allowedFields = ['kriteria', 'jenis', 'bobot'];

    protected $useTimestamps = true; // Aktifkan created_at & updated_at otomatis
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validasi opsional
    protected $validationRules    = [
        'kriteria' => 'required|max_length[100]',
        'bobot'    => 'required|decimal'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
