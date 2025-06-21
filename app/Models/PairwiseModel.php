<?php

namespace App\Models;

use CodeIgniter\Model;

class PairwiseModel extends Model
{
    protected $table            = 'pairwise';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['kriteria1_id', 'kriteria2_id', 'nilai'];
    protected $useTimestamps    = false;
}
