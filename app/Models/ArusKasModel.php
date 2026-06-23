<?php

namespace App\Models;
use CodeIgniter\Model;

class ArusKasModel extends Model
{
    protected $table            = 'arus_kas';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tanggal', 'keterangan', 'tipe', 'nominal'];
    protected $useTimestamps    = true;
}