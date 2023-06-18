<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data =
            [
                'title' => 'Parking Management System'
            ];
        return view('auth/login', $data);
    }
}
