<?php

namespace App\Controllers\Keuangan;

use \App\Controllers\BaseController;

class Transaksi extends BaseController
{
    protected $userModel;
    protected $kartuModel;
    protected $transaksiModel;
    protected $statustransaksiModel;
    protected $hargaModel;
    protected $pager;

    public function transaksi_inputkodebooking()
    {
        $data =
            [
                'title' => 'Parking Management System',
                'user' => $this->userModel
                    ->join('role', 'role.id_role = user.id_role')
                    ->where('npm', session('npm'))
                    ->first()
            ];

        return view('r_keuangan/transaksi_inputkodebooking', $data);
    }

    public function transaksi_validasiinputkodebooking()
    {
        $kodebooking = $this->request->getVar('kodebooking_transaksi');
        $databook = $this->transaksiModel->where('kodebooking_transaksi', $kodebooking)->first();

        if (empty($databook)) {
            session()->setFlashdata('error', 'Maaf, Kode Booking Tidak Ditemukan. Harap masukkan data dengan benar atau periksa kembali kode yang dimasukkan.');
            return redirect()->back();
        }

        $id_status_transaksi = $databook['id_status_transaksi'];
        $status_transaksi = $this->statustransaksiModel->where('id_status_transaksi', $id_status_transaksi)->first();
        $status_nama = $status_transaksi['nama_status_transaksi'];

        if ($status_nama == 'APPROVED') {
            session()->setFlashdata('error', 'Maaf, Kode Booking Sudah Tervalidasi');
            return redirect()->back();
        }
        elseif ($status_nama == 'COMPLETE') {
            session()->setFlashdata('error', 'Maaf, Kode Booking Tidak Ditemukan. Harap masukkan data dengan benar atau periksa kembali kode yang dimasukkan.');
            return redirect()->back();
        }
        elseif ($status_nama == 'CANCEL') {
            session()->setFlashdata('error', 'Maaf, Kode Booking Sudah Dibatalkan.');
            return redirect()->back();
        }

        $harga = $this->hargaModel->where('nama_harga', 'kartu_hilang')->first();
        $total_harga = $databook['nominal_transaksi'] + $harga['nominal'];

        $data = [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                ->join('role', 'role.id_role = user.id_role')
                ->where('npm', session('npm'))
                ->first(),
            'transaksi' => $this->transaksiModel
                ->join('user', 'user.npm = transaksi.npm')
                ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
                ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
                ->where('kodebooking_transaksi', $kodebooking)
                ->first(),
            'harga' => $total_harga
        ];

        return view('r_keuangan/transaksi_validasiinputkodebooking', $data);
    }

    public function transaksi_approve()
    {
        $validationRules = [
            'nomor_kartu' => [
                    'rules' => 'is_unique[kartu.nomor_kartu]',
                    'errors' => [
                        'is_unique' => 'Nomor Kartu ini Telah Digunakan Sebelumnya',
                        'required' => 'Harus Di Isi'
                    ]
                ]
        ];
    
        if (!$this->validate($validationRules)) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->to("keuangan/transaksi_inputkodebooking");
        }
        $kodebooking_transaksi = $this->request->getVar('kode_booking');
        $nomor_kartu = $this->request->getVar('nomor_kartu');

        $data =
            [
                'title' => 'Parking Management System',
                'user' => $this->userModel
                    ->join('role', 'role.id_role = user.id_role')
                    ->where('npm', session('npm'))
                    ->first(),
                'transaksi' => $this->transaksiModel
                    ->join('user', 'user.npm = transaksi.npm')
                    ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                    ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
                    ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
                    ->where('kodebooking_transaksi', $kodebooking_transaksi)
                    ->first(),
                'harga' => $this->request->getVar('total_harga'),
            ];
        $transaksi = $this->transaksiModel
            ->join('user', 'user.npm = transaksi.npm')
            ->join('kartu', 'kartu.id_kartu = user.id_kartu')
            ->where('kodebooking_transaksi', $kodebooking_transaksi)
            ->first();

        $this->transaksiModel->save(
            [
                'id_transaksi' => $transaksi['id_transaksi'],
                'saldoawal_transaksi' => $transaksi['saldo'],
                'saldoakhir_transaksi' => $transaksi['saldo'] + $transaksi['nominal_transaksi'],
                'id_status_transaksi' => 3,
            ]
        );
        if (!$nomor_kartu) {
            $this->kartuModel->save(
                [
                    'id_kartu' => $transaksi['id_kartu'],
                    'saldo' => $transaksi['saldo'] + $transaksi['nominal_transaksi'],
                ]
            );
        } else {
            $this->kartuModel->save(
                [
                    'id_kartu' => $transaksi['id_kartu'],
                    'nomor_kartu' => $nomor_kartu,
                    'saldo' => $transaksi['saldo'] + $transaksi['nominal_transaksi'],
                ]
            );
        }


        return view('r_keuangan/transaksi_approve', $data);
    }

    public function topup()
    {
        if (!$this->validate([
            'nominal' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Pilih Nominal Saldo!'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $kodebooking_transaksi = substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 6)), 0, 6);
        $npm = $this->request->getVar('npm');
        $nominal_saldo = $this->request->getVar('nominal');
        $saldo_awal = $this->request->getVar('saldoawal');
        $id_jenis_transaksi = $this->request->getVar('jenis_transaksi');
        $id_status_transaksi = $this->request->getVar('status_transaksi');
        $saldo_akhir = $saldo_awal + $nominal_saldo;

        $transaksi = [
            'kodebooking_transaksi' => $kodebooking_transaksi,
            'npm' => $npm,
            'id_jenis_transaksi' => $id_jenis_transaksi,
            'saldoawal_transaksi' => $saldo_awal,
            'nominal_transaksi' => $nominal_saldo,
            'saldoakhir_transaksi' => $saldo_akhir,
            'id_status_transaksi' => $id_status_transaksi
        ];
        $this->transaksiModel->save($transaksi);

        return redirect()->to("user/transaksi_result/$kodebooking_transaksi/$nominal_saldo");
    }

    public function transaksi_kartuHilang()
    {
        if (!$this->validate([
            'nominal_transaksi' => [
                'rules' => 'numeric',
                'errors' => [
                    'numeric' => 'Pilih Nominal Saldo!'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // pengambilan data hasil input an dari form
        $user = $this->userModel
            ->join('kartu', 'kartu.id_kartu = user.id_kartu')
            ->where('npm', session('npm'))
            ->first();
        $nominal_transaksi = $this->request->getVar('nominal_transaksi');
        $idjenis = $this->request->getVar('id_jenis_transaksi');
        $status = $this->request->getVar('id_status_transaksi');
        $saldoawal_transaksi = $this->request->getVar('saldoawal_transaksi');

        // Generate kode booking secara acak nanti akan menampilkan kode booking hanya 4
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';

        // perulangan generate kode booking secara acak
        $booking_code = '';
        for ($i = 0; $i < 3; $i++) {
            $booking_code .= $chars[mt_rand(0, strlen($chars) - 1)];
            $booking_code .= $numbers[mt_rand(0, strlen($numbers) - 1)];
        }

        // Tambahkan operasi penjumlahan antara saldo awal dan nominal
        $saldoakhir_transaksi = $nominal_transaksi + $saldoawal_transaksi;

        //total harga yang harus dibayar, saldo dan kartu baru
        $harga = $this->hargaModel->where('nama_harga', 'kartu_hilang')->first();
        $total_harga = $nominal_transaksi + $harga['nominal'];

        // Simpan data booking ke dalam database
        $this->transaksiModel->save(
            [
                'kodebooking_transaksi' => $booking_code,
                'npm' => $user['npm'],
                'id_jenis_transaksi' => $idjenis,
                'saldoawal_transaksi' => $saldoawal_transaksi,
                'nominal_transaksi' => $nominal_transaksi,
                'saldoakhir_transaksi' => $saldoakhir_transaksi,
                'id_status_transaksi' => $status
            ]
        );
        $this->kartuModel->save(
            [
                'id_kartu' => $user['id_kartu'],
                'nomor_kartu' => null,
            ]
        );
        // perpindahan ke function transaksi result untuk menampilan kodebooking dan nominal 

        return redirect()->to("user/transaksi_result/$booking_code/$total_harga");
    }

    public function transaksi_result($booking_code, $nominal_saldo)
    {
        $data = [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                ->join('role', 'role.id_role = user.id_role')
                ->where('npm', session('npm'))
                ->first(),
            'booking_code' => $booking_code,
            'nominal_saldo' => $nominal_saldo
        ];
        //  menampilkan hasil data booking code dan nominal saldo ke form transaksi_formResult
        return view('r_user/transaksi_formResult', $data);
    }
    public function riwayat()
{
    $limit = 9; // Jumlah item per halaman
    $currentPage = $this->request->getVar('page_pagination') ? $this->request->getVar('page_pagination') : 1;

    $data = [
        'title' => 'Parking Management System',
        'user' => $this->userModel
            ->join('role', 'role.id_role = user.id_role')
            ->where('npm', session('npm'))
            ->first(),
        'transaksi' => $this->transaksiModel
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = transaksi.id_jenis_pembayaran')
            ->whereIn('transaksi.id_jenis_transaksi', [1, 2]) // Menggunakan whereIn untuk mencari id_jenis_transaksi 1 atau 2
            ->orderBy('updated_at', 'DESC')
            ->paginate($limit, 'pagination'),
        'pager' => $this->transaksiModel
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = transaksi.id_jenis_pembayaran')
            ->whereIn('transaksi.id_jenis_transaksi', [1, 2]) // Menggunakan whereIn untuk mencari id_jenis_transaksi 1 atau 2
            ->orderBy('created_at', 'DESC')
            ->pager,
        'currentPage' => $currentPage,
        'limit' => $limit,
    ];

    return view('r_keuangan/transaksi_riwayat', $data);
}
}