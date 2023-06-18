<?php

namespace App\Controllers\User;

use \App\Controllers\BaseController;

class KartuHilang extends BaseController
{
    protected $userModel;
    protected $kartuModel;
    public function index()
    {
        $data = [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                ->join('role', 'role.id_role = user.id_role')
                ->where('npm', session('npm'))
                ->first()
        ];

        return view('r_user/transaksi_formKartuHilang', $data);
    }
}
