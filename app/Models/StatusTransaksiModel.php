<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusTransaksiModel extends Model
{
    protected $table      = 'status_transaksi';
    protected $primaryKey = 'id_status_transaksi';

    protected $useAutoIncrement = false;

    protected $allowedFields =
    [
        'id_status_transaksi',
        'nama_status_transaksi',
        'deskripsi_status_transaksi'
    ];
}
