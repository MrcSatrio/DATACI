<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Search_user extends BaseController
{
    protected $userModel;

    public function index()
    {
        $npm = session('npm');
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $result = $this->userModel
                ->join('role', 'role.id_role = user.id_role')
                ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                
                ->groupStart()
                ->like('user.npm', $keyword)
                ->orLike('user.nama', $keyword)
                ->groupEnd()
                ->findAll();

            // Cek apakah hasil pencarian tidak kosong
            if (!empty($result)) {
                $data = [
                    'title' => 'Parking Management System',
                    'user' => $this->userModel
                        ->join('role', 'role.id_role = user.id_role')
                        ->join('kartu', 'kartu.id_kartu = user.id_kartu')
                        ->first(),
                    'result' => $result,
                    'keyword' => $keyword,
                ];

                return view('r_admin/search_user', $data);
            } else {
                echo '<script>alert("Pengguna tidak ditemukan!");</script>';
                return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
            }
        }
    }
}
