<?php

namespace App\Controllers\User;

use \App\Controllers\BaseController;
use \App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $data = [
            'title' => 'Parking Management System',
            'user' => $userModel->where('npm', session('npm'))->first()
        ];

        return view('r_user/index', $data);
    }

    public function profile()
    {
        //tolong masukin di setiap method//
        $userModel = new UserModel();
        $data = [
            'title' => 'Parking Management System',
            'user' => $userModel->where('npm', session('npm'))->first()
        ];

        return view('r_user/profile', $data);
    }
}
