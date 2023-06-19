<?php
namespace App\Controllers\Keuangan;

use \App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $transaksiModel; // Tambahkan model transaksi yang diperlukan

    public function index()
    {
        $limit = 9; // Jumlah item per halaman
        $offset = $this->request->getVar('page') ? ($this->request->getVar('page') - 1) * $limit : 0;
        $totalRows = $this->transaksiModel->countAllResults();

        // Tambahkan parameter tanggal awal dan tanggal akhir untuk memfilter transaksi selama sebulan
        $startDate = date('Y-m-01'); // Tanggal awal bulan saat ini
        $endDate = date('Y-m-t'); // Tanggal akhir bulan saat ini

        // Hitung total nominal transaksi yang disetujui selama sebulan
        $totalApprovedNominal = $this->transaksiModel
            ->selectSum('nominal_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->where('status_transaksi.id_status_transaksi', '3') // Filter status transaksi yang disetujui
            ->where('transaksi.updated_at >=', $startDate) // Filter transaksi mulai dari tanggal awal
            ->where('transaksi.updated_at <=', $endDate) // Filter transaksi sampai tanggal akhir
            ->first();

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
            'pager' => $this->pager->makeLinks($offset, $limit, $totalRows, 'pagination'),
            'totalApprovedNominal' => $totalApprovedNominal['nominal_transaksi'] // Jumlah total nominal transaksi yang disetujui
        ];

        return view('r_keuangan/dashboard', $data);
    }
}
