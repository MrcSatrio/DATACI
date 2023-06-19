<?php
namespace App\Controllers\User;

use \App\Controllers\BaseController;
use App\Models\PengumumanModel;

class Dashboard extends BaseController
{
    protected $transaksiModel;
    protected $userModel;

    public function index()
    {
        $startDate = date('Y-m-01'); // Tanggal awal bulan saat ini
        $endDate = date('Y-m-t'); // Tanggal akhir bulan saat ini
        
        $totalApprovedNominal = $this->transaksiModel
            ->selectSum('nominal_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->where('jenis_transaksi.id_jenis_transaksi', '3') // Filter jenis transaksi
            ->where('transaksi.npm', session('npm')) // Filter transaksi berdasarkan npm
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
                ->join('user', 'user.npm = transaksi.npm')
                ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
                ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
                ->join('role', 'role.id_role = user.id_role')
                ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                ->where('transaksi.npm', session('npm'))
                ->first(),
            'riwayat' => $this->transaksiModel
                ->join('user', 'user.npm = transaksi.npm')
                ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
                ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
                ->where('transaksi.npm', session('npm'))
                ->findAll(),
            'role' => $this->roleModel->findAll(),
            'totalApprovedNominal' => $totalApprovedNominal['nominal_transaksi'], // Jumlah total nominal transaksi yang disetujui
        ];

        $berkasModel = new PengumumanModel();
        $data['berkas'] = $berkasModel->findAll();

        return view('r_user/dashboard', $data);
    }
}
