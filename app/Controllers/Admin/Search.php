<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class Search extends BaseController
{
    protected $userModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        // Add any other necessary model initializations
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');
        $id_status_transaksi = $this->request->getVar('id_status_transaksi');

        $transaksi = $this->transaksiModel->searchTransaksi($keyword, $startDate, $endDate, $id_status_transaksi);

        if (!empty($transaksi)) {
            $data = [
                'title' => 'Parking Management System',
                'user' => $this->userModel
                    ->join('role', 'role.id_role = user.id_role')
                    ->where('npm', session('npm'))
                    ->first(),
                'transaksi' => $transaksi
            ];

            return view('r_admin/search', $data);
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
        }
    }
}
