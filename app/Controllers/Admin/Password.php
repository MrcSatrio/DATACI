<?php

namespace App\Controllers\Admin;

use \App\Controllers\BaseController;

class Password extends BaseController
{
    protected $userModel;
    public function ubahPassword()
    {
        $data =
            [
                'title' => 'Parking Management System',
                'user' => $this->userModel
                    ->join('role', 'role.id_role = user.id_role')
                    ->where('npm', session('npm'))
                    ->first()
            ];

        return view('r_' . $data['user']['nama_role'] . '/ubahPassword', $data);
    }

    public function updatePassword()
    {
        if (!$this->validate([
            'oldpassword' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    //'matches' => 'Password tidak sama dengan password lama',

                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|regex_match[/[A-Z]/]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password harus terdiri dari 8 karakter atau lebih',
                    'regex_match' => 'Password harus mengandung setidaknya satu huruf besar',
                ]
            ],
            'repassword' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Password tidak sama dengan Password Baru',
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        // Mengambil data dari form
        $oldPassword = $this->request->getVar('oldpassword');
        $newPassword = $this->request->getVar('password');
        // $confirmPassword = $this->request->getVar('repassword');


        // // Validasi password
        // if ($newPassword != $confirmPassword) {
        //     return redirect()->back()->with('con_error', '<br>');
        // }

        // Mengambil data user dari session atau database
        $user = $this->userModel
            ->join('role', 'role.id_role = user.id_role')
            ->where('npm', session('npm'))
            ->first();

        // Memeriksa apakah password lama sesuai
        if (md5($oldPassword) != $user['password']) {
            $errorlm = 'Maaf, Password lama yang anda masukan tidak sesuai';
            return redirect()->back()->with('error_lm', $errorlm);
        }

        // Mengupdate password user
        $this->userModel->update($user['npm'], ['password' => md5($newPassword)]);


        return redirect()->to(base_url($user['nama_role'] . '/ubah_password'))
            ->with('success', 'Password Berhasil di ubah.');
    }
}
