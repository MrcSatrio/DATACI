<?php

namespace App\Controllers\User;

use \App\Controllers\BaseController;

class Riwayat extends BaseController

{
    protected $userModel;
    protected $transaksiModel;
    protected $pagerModel;

    public function riwayat()
{
    $limit = 9; // Jumlah item per halaman
    $currentPage = $this->request->getVar('page_pagination') ? $this->request->getVar('page_pagination') : 1;

    $npm = session('npm');

    $data = [
        'title' => 'Parking Management System',
        'user' => $this->userModel
            ->join('role', 'role.id_role = user.id_role')
            ->where('npm', $npm)
            ->first(),
        'transaksi' => $this->transaksiModel
        ->where('npm', $npm)
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = transaksi.id_jenis_pembayaran')
            ->orderBy('created_at', 'DESC')
            ->paginate($limit, 'pagination'),
        'pager' => $this->transaksiModel
        ->where('npm', $npm)
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = transaksi.id_jenis_pembayaran')
            ->orderBy('created_at', 'DESC')
            ->pager,
            'currentPage' => $currentPage,
                'limit' => $limit,
    ];

    return view('r_user/transaksi_riwayat', $data);
}

}
