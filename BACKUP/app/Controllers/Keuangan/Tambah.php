<?php

namespace App\Controllers\Keuangan;

use \App\Controllers\BaseController;
use \App\Models\UserModel;

class Keuangan extends BaseController
{
    public function register()
    {
        $usermodel = new UserModel();
        $kartumodel = new KartuModel();

        $npm = $this->request->getVar('npm');
        $password = $this->request->getVar('password');

        // Validasi NPM
        if (strlen($npm) < 10 || !ctype_digit($npm)) {
            session()->setFlashdata('error_npm', '<br>');
            return redirect()->to('/tambahmhs');
        }

        // Validasi Password
        if (strlen($password) < 8 || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/\d/', $password)) {
        session()->setFlashdata('error_pass', '<br>');
        return redirect()->to('/tambahmhs');
        }

        // Jika berhasil, simpan data ke database
        $datakartu = [    'nomor_kartu' => $this->request->getVar('nomor_kartu'),    'saldo' => $this->request->getVar('saldo'),];
        $kartumodel->save($datakartu);

        $datauser = [    'npm' => $npm,    'id_kartu' => $kartumodel->getInsertID(),    'id_role' => $this->request->getVar('id_role'),    'nama' => $this->request->getVar('nama'),    'password' => md5($password),];

        $usermodel->insert($datauser);

        // Tampilkan pesan berhasil
        session()->setFlashdata('success', '<br>');
        return redirect()->to('/tambahmhs');
    }

}