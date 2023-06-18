<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;

class Pengumuman extends BaseController
{
	public function readBerkas()
	{
        $data =
        [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                ->join('role', 'role.id_role = user.id_role')
                ->where('npm', session('npm'))
                ->first(),
            'role' => $this->roleModel->findAll()
        ];
		$berkas = new PengumumanModel();
		$data['berkas'] = $berkas->findAll();
        
		return view('r_user/pengumuman', $data);
	}
	
	function download($id)
	{
		$berkas = new PengumumanModel();
		$data = $berkas->find($id);
		return $this->response->download('uploads/berkas/' . $data->berkas, null);
	}
	public function modul()
	{
        $data =
        [
            'title' => 'Parking Management System',
            'user' => $this->userModel
                ->join('role', 'role.id_role = user.id_role')
                ->where('npm', session('npm'))
                ->first(),
            'role' => $this->roleModel->findAll()
        ];        
		return view('r_user/modul', $data);
    }
}