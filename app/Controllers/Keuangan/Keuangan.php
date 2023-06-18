<?php

namespace App\Controllers\Keuangan;

use \App\Controllers\BaseController;
use \App\Models\UserModel;

class Keuangan extends BaseController
{
    public function index()
    {
        //tolong masukin di setiap method//
        $userModel = new UserModel();
        
        $data = [
            'title' => 'Parking Management System',
            'user' => $userModel->where('npm', session('npm'))->first()
        ];


        return view('r_keuangan/index', $data);
    }

    public function tambah()
    {
        $userModel = new UserModel();
        
        $data = [
            'title' => 'Parking Management System',
            'user' => $userModel->where('npm', session('npm'))->first()
        ];

        return view('r_keuangan/tambahmhs', $data);
    }
}
