<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;


class Berkas extends BaseController
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
        
		return view('r_admin/view_berkas', $data);
	}
	public function create()
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
		return view('r_admin/form_upload', $data);
	}

	public function save()
	{
		if (!$this->validate([
			'keterangan' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} Tidak boleh kosong'
				]
			],
			'berkas' => [
				'rules' => 'uploaded[berkas]|ext_in[berkas,pdf]|max_size[berkas,2048]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'ext_in' => 'File Extention Harus Berupa jpg,jpeg,gif,png',
					'max_size' => 'Ukuran File Maksimal 2 MB'
				]

			]
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}

		$berkas = new PengumumanModel();
		$dataBerkas = $this->request->getFile('berkas');
		$fileName = $dataBerkas->getRandomName();
		$berkas->insert([
			'berkas' => $fileName,
			'keterangan' => $this->request->getPost('keterangan')
		]);
		$dataBerkas->move('uploads/berkas/', $fileName);
		session()->setFlashdata('success', 'Berkas Berhasil diupload');
		return redirect()->to(base_url('/admin/listPengumuman'));
	}

	function download($id)
	{
		$berkas = new PengumumanModel();
		$data = $berkas->find($id);
		return $this->response->download('uploads/berkas/' . $data->berkas, null);
	}

	public function delete($id)
    {
        $berkasModel = new PengumumanModel();
        $berkas = $berkasModel->find($id);

		if ($berkas) {
			// Hapus file terlebih dahulu
			$path = WRITEPATH . 'uploads/berkas/' . $berkas->berkas;
			if (file_exists($path)) {
				unlink($path);
			}
	
			// Hapus data dari database
			$berkasModel->delete($id);
	
			session()->setFlashdata('success', 'Berkas berhasil dihapus.');
		} else {
			session()->setFlashdata('error', 'Berkas tidak ditemukan.');
		}

        return redirect()->to(base_url('admin/listPengumuman'));
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
		return view('r_admin/modul', $data);
	}
}