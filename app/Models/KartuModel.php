<?php

namespace App\Models;

use CodeIgniter\Model;

class KartuModel extends Model
{
    protected $table      = 'kartu';
    protected $primaryKey = 'id_kartu';

    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $allowedFields = ['id_kartu', 'nomor_kartu', 'saldo', 'created_at', 'updated_at'];
}
