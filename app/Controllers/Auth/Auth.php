<?php

namespace App\Controllers\Auth;

use \App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $userModel;
    public function index()
    {
        $data =
            [
                'title' => 'Parking Management System'
            ];
        return view('auth/login', $data);
    }

    public function login()
    {
        $npm = $this->request->getVar('npm');
        $password = $this->request->getVar('password');
        $user = $this->userModel->where('npm', $npm)->first();

        if ($user) {
            if (md5($password) == $user['password']) {
                //Session untuk login
                $session = session();
                $sessionData = [
                    'npm' => $user['npm'],
                    'nama' => $user['nama'],
                    'id_role' => $user['id_role']

                ];
                $session->set($sessionData);
                if ($user['id_role'] == 1) {
                    return redirect()->to('/admin/dashboard');
                } elseif ($user['id_role'] == 2) {
                    return redirect()->to('/keuangan/dashboard');
                } elseif ($user['id_role'] == 3) {
                    return redirect()->to('/operator/dashboard');
                } else {
                    return redirect()->to('/user/dashboard');
                }
            } else {
                return redirect()->to('/')->withInput()->with('msg', 'NIM atau Password Salah');
            }
        } else {
            return redirect()->to('/')->withInput()->with('msg', 'Hubungi Administrator Terkait' . $npm);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        session_write_close();
        return redirect()->to('/');
    }

    ///////////////////////FORGOT PASSWORD////////////////////////////
    public function forgot_password()
    {

        $data =
            [
                'title' => 'Parking Management System'
            ];
        return view('auth/forgot_password_view', $data);
    }

    ///////////////////////RESET PASSWORD////////////////////////////
    public function change_password()
    {

        $data =
            [
                'title' => 'Parking Management System'
            ];
        return view('auth/reset_password_view', $data);
    }

    public function password_reset()
    {

        helper(['string']);
        $rules = [
            'email' => 'required|min_length[4]|max_length[100]|valid_email'
        ];

        if ($this->validate($rules)) {

            $token = mt_rand(100000, 999999);

            $userdata = $this->userModel->where('email', $this->request->getVar('email'))->first();

            if (!$userdata) {
                // Jika email tidak ditemukan di database
                echo '<script>alert("Email not found in the database.");</script>';
                echo '<script>window.location.href = "' . base_url('/forgotpassword') . '";</script>';
                exit;
            }


            $data = [
                'email' => $this->request->getVar('email'),
                'token' => $token,
            ];
            $this->userModel->update($userdata['npm'], $data);

            $to = $data['email'];
            $subject = 'Reset Password Link';
            $token_no = $token;
            $message = 'Halo ' . $userdata['nama'] . '<br><br>'
                . 'Masukkan Token Dibawah ini untuk melakukan Reset Password.'
                . '<br>' . 'Token Reset Password Anda: <br> <h1>' . $token_no . ' </h1> <br>'
                . '<span style="color: red; font-weight: bold;">⚠️ PERHATIAN !!! JANGAN BERIKAN TOKEN KEPADA ORANG LAIN ⚠️</span>' . '<br>'
                . '<span style="color: red; font-weight: bold;">⚠️ ABAIKAN EMAIL INI JIKA ANDA TIDAK MELAKUKAN RESET PASSWORD ⚠️</span>' . '<br><br>'
                . 'Terima kasih,' . '<br><br>' . ' Biu Parking Management';


            $email = \Config\Services::email();
            $email->setTo($to);
            $email->setFrom('biuparkingmanagement@gmail.com', 'Biu Parking Management');
            $email->setSubject($subject);
            $email->setMessage($message);
            if ($email->send()) {
                $successMessage = 'Token sukses terkirim. Silakan periksa email yang terdaftar.<br> *Jika tidak muncul di kotak masuk, mohon cek folder spam di Gmail.';
                session()->setFlashdata('success', $successMessage);
                return redirect()->to(site_url('/resetpassword'));
            } else {
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }

            return $this->response->redirect(site_url('/resetpassword'));
        }
    }

    public function update_password()
    {
        $rules = [
            'token' => [
                'rules' => 'required|min_length[6]|max_length[6]',
                'errors' => [
                    'required' => 'Token tidak boleh kosong',
                    'min_length' => 'Token harus terdiri dari 6 angka',
                    'max_length' => 'Token tidak lebih dari 6 angka'
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
            'confirmpassword' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama dengan password'
                ]
            ],

        ];

        if ($this->validate($rules)) {


            $token = $this->request->getVar('token');

            $password = $this->request->getVar('password');

            $userdata = $this->userModel->where('token', $token)->first();

            if (!empty($userdata)) {
                $data = [

                    'password' => md5($password),
                    'token' => null,
                ];
                $this->userModel->update($userdata['npm'], $data);

                return $this->response->redirect(site_url('/'));
            } else {
                // Token tidak ditemukan dalam database
                session()->setFlashdata('errortoken', 'Token tidak valid.');
                return redirect()->back()->withInput();
            }
            session()->setFlashdata('success', 'Silahkan Login Dengan Password Baru');
            return redirect()->to(base_url())->withInput();
        } else {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
    }
}
