<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Absensi extends Model
{
    protected $table            = 'tb_absensi';
    protected $primaryKey       = 'id_abseni';
    protected $returnType       = 'object';
    protected $allowedFields    = ['nama','id_rapat','absensi','jabatan','tanggal','no_peg'];
    protected $useTimestamp     = 'true';
    protected $useSoftDeletes   = 'true';

    public function getAbsenByTanggal($tanggal, $id_rapat)
    {
        return $this->db->table('tb_absensi')
        ->where('tanggal', $tanggal)
        ->where('id_rapat', $id_rapat)
        ->get()->getResult();
    }


}
