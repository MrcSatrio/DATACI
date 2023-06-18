<?php namespace App\Controllers\Admin;

use \App\Controllers\BaseController;

class Search extends BaseController
{
    protected $userModel;
    protected $transaksiModel;

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $result = $this->transaksiModel
                ->join('user', 'user.npm = transaksi.npm')
                ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                ->join('role', 'role.id_role = user.id_role')
                ->join('status_transaksi', 'status_transaksi.id_status_transaksi = transaksi.id_status_transaksi')
                ->join('jenis_transaksi', 'jenis_transaksi.id_jenis_transaksi = transaksi.id_jenis_transaksi')
                ->orderBy('transaksi.id_transaksi', 'DESC')
                ->like('user.npm', $keyword)
                ->orLike('transaksi.kodebooking_transaksi', $keyword)
                ->orLike('kartu.nomor_kartu', $keyword)
                ->orLike('user.nama', $keyword)
                ->findAll();

            // Cek apakah hasil pencarian tidak kosong
            if (!empty($result)) {
                $data = [
                    'title' => 'Parking Management System',
                    'user' => $this->userModel
                        ->join('role', 'role.id_role = user.id_role')
                        ->where('npm', session('npm'))
                        ->first(),
                    'result' => $result,
                    'keyword' => $keyword,
                ];

                return view('r_admin/search', $data);
            } else {
                $data = [
                    'title' => 'Parking Management System',
                    'user' => $this->userModel
                        ->join('role', 'role.id_role = user.id_role')
                        ->where('npm', session('npm'))
                        ->first(),
                ];
                
                echo '<script>alert("Transaksi tidak ditemukan!");</script>';
                echo '<script>window.location.href = "transaksi_riwayat";</script>';
            }
            
        } else {
            return redirect()->to(base_url() . 'admin/dashboard');
        }
    }
}
