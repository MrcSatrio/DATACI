<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisTransaksiModel extends Model
{
    protected $table      = 'jenis_transaksi';
    protected $primaryKey = 'id_jenis_transaksi';

    protected $useAutoIncrement = false;

    protected $allowedFields =
    [
        'id_jenis_transaksi',
        'nama_jenis_transaksi',
        'deskripsi_jenis_transaksi'
    ];
}
