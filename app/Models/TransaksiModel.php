<?php
// TransaksiModel.php
namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $useTimestamps = true;

    protected $allowedFields =
    [
        'id_transaksi',
        'kodebooking_transaksi',
        'npm',
        'id_jenis_transaksi',
        'saldoawal_transaksi',
        'nominal_transaksi',
        'saldoakhir_transaksi',
        'id_jenis_pembayaran',
        'id_status_transaksi',
        'bukti_pembayaran',
        'created_at',
        'updated_at'
    ];

    public function searchTransaksi($keyword, $startDate, $endDate)
    {
        $query = $this->select('transaksi.*, user.nama')
            ->join('user', 'user.npm = transaksi.npm')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi');

        if (!empty($keyword)) {
            $query->groupStart()
                ->like('transaksi.kodebooking_transaksi', $keyword)
                ->orLike('user.npm', $keyword)
                ->orLike('user.nama', $keyword)
                ->groupEnd();
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query->where('transaksi.created_at >=', $startDate . ' 00:00:00')
                ->where('transaksi.created_at <=', $endDate . ' 23:59:59');
        }

        return $query->findAll();
    }
}
