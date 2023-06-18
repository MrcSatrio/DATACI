<?php

namespace App\Controllers\Operator;

use \App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $hargaModel;
    protected $transaksiModel;
    protected $roleModel;
    protected $pager;
    public function index()
    {
        //tolong masukin di setiap method//
        $data =
            [
                'title' => 'Parking Management System',
                'user' => $this->userModel
                    ->join('role', 'role.id_role = user.id_role')
                    ->where('npm', session('npm'))
                    ->first(),
                'parkir_motor' => $this->hargaModel->where('nama_harga', 'parkir_motor')->first(),
                'parkir_mobil' => $this->hargaModel->where('nama_harga', 'parkir_mobil')->first(),
                'riwayat' => $this->transaksiModel->where('id_jenis_transaksi', 3)->findAll()
            ];

        return view('r_operator/dashboard', $data);
    }
    public function riwayat()
{
    $limit = 9; // Jumlah item per halaman
    $currentPage = $this->request->getVar('page_pagination') ? $this->request->getVar('page_pagination') : 1;
    $data = [
        'title' => 'Parking Management System',
        'user' => $this->userModel
            ->join('role', 'role.id_role = user.id_role')
            ->where('npm', session('npm'))
            ->first(),
        'riwayat' => $this->transaksiModel
            ->where('id_jenis_transaksi', 3)
            ->orderBy('updated_at', 'DESC')
            ->paginate($limit, 'pagination'),
        'pager' => $this->transaksiModel
            ->where('id_jenis_transaksi', 3)
            ->orderBy('updated_at', 'DESC')
            ->pager,
            'currentPage' => $currentPage,
            'limit' => $limit,
    ];

    return view('r_operator/riwayat_transaksi_parkir', $data);
}

    public function modul()
	{
        $data =
        [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                ->join('role', 'role.id_role = user.id_role')
                ->where('npm', session('npm'))
                ->first(),
            'role' => $this->roleModel->findAll()
        ];        
		return view('r_operator/modul', $data);
	}
}
