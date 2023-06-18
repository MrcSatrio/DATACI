<?php

namespace App\Controllers\Keuangan;

use \App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $userModel;
    public function index()
    {
        $limit = 9; // Jumlah item per halaman
        $offset = $this->request->getVar('page') ? ($this->request->getVar('page') - 1) * $limit : 0;
        $totalRows = $this->transaksiModel->countAllResults();

        $data = [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                    ->join('role', 'role.id_role = user.id_role')
                    ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                    ->where('npm', session('npm'))
                    ->first(),
            'transaksi' => $this->transaksiModel
                ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
                ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
                ->findAll($limit, $offset),
            'riwayat' => $this->transaksiModel
                ->join('user', 'user.npm = transaksi.npm')
                ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
                ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
                ->where('transaksi.npm', session('npm'))
                ->findAll(),
            'role' => $this->roleModel->findAll(),
            'pager' => $this->pager->makeLinks($offset, $limit, $totalRows, 'pagination')
        ];

        return view('r_keuangan/dashboard', $data);
    }
}
