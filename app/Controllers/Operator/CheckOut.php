<?php

namespace App\Controllers\Operator;

use \App\Controllers\BaseController;

class CheckOut extends BaseController
{
    protected $userModel;
    protected $kartuModel;
    protected $transaksiModel;
    public function index()
{
    $nominal_transaksi = $this->request->getVar('nominal_transaksi');
    $user_parking = $this->userModel
        ->join('kartu', 'kartu.id_kartu = user.id_kartu')
        ->where('kartu.nomor_kartu', $this->request->getVar('nomor_kartu'))
        ->first();
    $validasi = [
        'nomor_kartu' => [
            'rules' => 'required|numeric|is_not_unique[kartu.nomor_kartu]',
            'errors' => [
                'required' => 'Nomor Kartu tidak boleh kosong',
                'numeric' => 'Nomor Kartu harus berupa angka',
                'is_not_unique' => 'Kartu Tidak Ada Di Database',
            ]
        ]
    ];

    if (!$this->validate($validasi)) {
        session()->setFlashdata('error', $this->validator->listErrors());
        return redirect()->back()->withInput();
    } elseif ($user_parking['id_status'] == 1) {
        if ($user_parking['saldo'] < $nominal_transaksi) {
            session()->setFlashdata('error', 'Saldo Tidak Cukup');
            return redirect()->back()->withInput();
        } else {
            $this->transaksiModel->save([
                'kodebooking_transaksi' => substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 6)), 0, 6),
                'npm' => $user_parking['npm'],
                'id_jenis_transaksi' => $this->request->getVar('id_jenis_transaksi'),
                'saldoawal_transaksi' => $user_parking['saldo'],
                'nominal_transaksi' => $nominal_transaksi,
                'saldoakhir_transaksi' => $user_parking['saldo'] - $nominal_transaksi,
                'id_status_transaksi' => $this->request->getVar('id_status_transaksi'),
                'id_jenis_pembayaran' => $this->request->getVar('id_jenis_pembayaran'),
            ]);
            $this->kartuModel->save([
                'id_kartu' => $user_parking['id_kartu'],
                'saldo' => $user_parking['saldo'] - $nominal_transaksi
            ]);
            session()->setFlashdata('success', 'Transaksi Berhasil Silahkan Buka Boom Gate');
            return redirect()->back()->withInput();
        }
    } elseif ($user_parking['id_status'] == 2) {
        $masaBerlaku = strtotime($user_parking['masa_berlaku']);
        $currentTime = time();

        if ($masaBerlaku <= $currentTime) {
            if ($user_parking['saldo'] < $nominal_transaksi) {
                session()->setFlashdata('error', 'Saldo Tidak Cukup');
                return redirect()->back()->withInput();
            } else {
                $this->transaksiModel->save([
                    'kodebooking_transaksi' => substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 6)), 0, 6),
                    'npm' => $user_parking['npm'],
                    'id_jenis_transaksi' => $this->request->getVar('id_jenis_transaksi'),
                    'saldoawal_transaksi' => $user_parking['saldo'],
                    'nominal_transaksi' => $nominal_transaksi,
                    'saldoakhir_transaksi' => $user_parking['saldo'] - $nominal_transaksi,
                    'id_status_transaksi' => $this->request->getVar('id_status_transaksi'),
                    'id_jenis_pembayaran' => $this->request->getVar('id_jenis_pembayaran'),
                ]);
                $this->kartuModel->save([
                    'id_kartu' => $user_parking['id_kartu'],
                    'saldo' => $user_parking['saldo'] - $nominal_transaksi
                ]);
                session()->setFlashdata('success', 'Transaksi Berhasil Silahkan Buka Boom Gate');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Kartu Member');
            return redirect()->back()->withInput();
        }
    }
}

        // $data =
        //     [
        //         'title' => 'Parking Management System',
        //         'user' => $this->userModel
        //             ->join('role', 'role.id_role = user.id_role')
        //             ->where('npm', session('npm'))
        //             ->first()
        //     ];

        // return view('r_operator/dashboard', $data);
    }
