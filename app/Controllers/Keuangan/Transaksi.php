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

    $approvedBy = $this->userModel
        ->where('npm', session('npm'))
        ->first();
        $logData = [
            'npm' => session('npm'),
            'action' => 'transaksi_approve',
            'details' => 'Transaksi dengan kode booking ' . $kodebooking_transaksi . ' disetujui',
            'ip_address' => $this->request->getIPAddress()
        ];
    
        $logModel = new \App\Models\LogModel();
        $logModel->insert($logData);
        $data = [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                ->join('role', 'role.id_role = user.id_role')
                ->where('npm', session('npm'))
                ->first(['user.*', 'role.nama_role']), // Add 'role.nama_role' to retrieve the role name
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

    $this->transaksiModel->save([
        'id_transaksi' => $transaksi['id_transaksi'],
        'saldoawal_transaksi' => $transaksi['saldo'],
        'saldoakhir_transaksi' => $transaksi['saldo'] + $transaksi['nominal_transaksi'],
        'id_status_transaksi' => 3,
        'validator' => $approvedBy['nama'] // Menyimpan data Approved by ke dalam kolom 'approved_by'
    ]);

    if (!$nomor_kartu) {
        $this->kartuModel->save([
            'id_kartu' => $transaksi['id_kartu'],
            'saldo' => $transaksi['saldo'] + $transaksi['nominal_transaksi'],
        ]);
    } else {
        $this->kartuModel->save([
            'id_kartu' => $transaksi['id_kartu'],
            'nomor_kartu' => $nomor_kartu,
            'saldo' => $transaksi['saldo'] + $transaksi['nominal_transaksi'],
        ]);
    }

    return view('r_keuangan/transaksi_approve', $data);
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
            ->join('user', 'user.npm = transaksi.npm')
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = transaksi.id_jenis_pembayaran')
            ->whereIn('transaksi.id_jenis_transaksi', [1, 2]) // Menggunakan whereIn untuk mencari id_jenis_transaksi 1 atau 2
            ->orderBy('transaksi.updated_at', 'DESC') // Menentukan kolom updated_at secara spesifik
            ->paginate($limit, 'transaksi_pagination'),
        'pager' => $this->transaksiModel
            ->join('user', 'user.npm = transaksi.npm')
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
            ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
            ->join('jenis_pembayaran', 'jenis_pembayaran.id_jenis_pembayaran = transaksi.id_jenis_pembayaran')
            ->whereIn('transaksi.id_jenis_transaksi', [1, 2]) // Menggunakan whereIn untuk mencari id_jenis_transaksi 1 atau 2
            ->orderBy('transaksi.created_at', 'DESC') // Menentukan kolom created_at secara spesifik
            ->pager,
        'currentPage' => $currentPage,
        'limit' => $limit,
    ];

    return view('r_keuangan/transaksi_riwayat', $data);
}
}