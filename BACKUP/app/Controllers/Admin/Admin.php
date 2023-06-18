<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;
use \App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        //tolong masukin di setiap method//
        $userModel = new UserModel();
        $data = [
            'title' => 'Parking Management System',
            'user' => $userModel->where('npm', session('npm'))->first()
        ];

        return view('r_admin/index', $data);
    }

    public function tambah()
    {
        //tolong masukin di setiap method//
        $userModel = new UserModel();
        $data = [
            'title' => 'Parking Management System',
            'user' => $userModel->where('npm', session('npm'))->first()
        ];

        return view('r_admin/tambah', $data);
    }
}
