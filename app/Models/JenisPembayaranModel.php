<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPembayaranModel extends Model
{
    protected $table      = 'jenis_pembayaran';
    protected $primaryKey = 'id_jenis_pembayaran';

    protected $useAutoIncrement = false;

    protected $allowedFields = ['id_jenis_pembayaran', 'nama_jenis_pembayaran'];
}
