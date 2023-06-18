<?php

namespace App\Models;

use CodeIgniter\Model;

class HargaModel extends Model
{
    protected $table      = 'harga';
    protected $primaryKey = 'id_harga';

    protected $allowedFields = ['id_harga', 'nama_harga', 'nominal'];
}
