<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Rapat extends Model
{
    protected $table            = 'tb_rapat';
    protected $primaryKey       = 'id_rapat';
    protected $returnType       = 'object';
    protected $allowedFields    = ['rapat'];
    protected $useTimestamp     = 'true';
    protected $useSoftDeletes   = 'true';
}
