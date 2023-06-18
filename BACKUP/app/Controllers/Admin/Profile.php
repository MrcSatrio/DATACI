<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;

class Profile extends BaseController
{
    protected $userModel;
    protected $roleModel;
    public function index()
    {
        $data =
            [
                'title' => 'Parking Management System',
                'user' => $this->userModel
                    ->join('role', 'role.id_role = user.id_role')
                    ->where('npm', session('npm'))
                    ->first()
            ];

        return view('r_' . $data['user']['nama_role'] . '/profile', $data);
    }

    /////////////////////// UPDATE PROFILE ////////////////////////////////////////
    public function updateProfil()
    {
        if (!$this->validate([
            'email' => [
                'rules' => 'required|is_unique[user.email]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'is_unique' => 'Email telah digunakan'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $newemail = $this->request->getVar(('email'));

        $user = $this->userModel
            ->join('role', 'role.id_role = user.id_role')
            ->where('npm', session('npm'))
            ->first();

        $this->userModel->update($user['npm'], ['email' => $newemail]);

        session()->setFlashdata('success', 'Email Telah diubah');
        return redirect()->to(base_url($user['nama_role'] . '/profile'));
    }
}
