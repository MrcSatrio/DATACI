<?php

namespace App\Controllers\Operator;

use \App\Controllers\BaseController;
use \App\Models\UserModel;

class Operator extends BaseController
{
    public function index()
    {
        //tolong masukin di setiap method//
        $userModel = new UserModel();
        $data = [
            'title' => 'Parking Management System',
            'user' => $userModel->where('npm', session('npm'))->first()
        ];

        return view('r_operator/index', $data);
    }
}
