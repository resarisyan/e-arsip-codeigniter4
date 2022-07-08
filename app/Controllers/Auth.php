<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;

class Auth extends BaseController
{
    protected $halaman, $title, $auth;

    public function __construct()
    {
        $this->halaman = 'login';
        $this->title = 'Login';
        $this->auth = new AuthModel();
    }

    public function index()
    {
        $data = [
            'halaman' => $this->halaman,
            'title' => $this->title,
            'main' => 'login/index'
        ];
        return view('auth/login', $data);
    }

    public function login()
    {
        if ($this->validate([
            'email' => [
                'label' => 'E-mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} Wajib Diisi!',
                    'valid_email' => '{field} Email Tidak Valid!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi!',
                ]
            ],
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $data = $this->auth->login($email, md5($password));
            if ($data) {
                $level = $data['level'] == 1 ? 'admin' : 'user';
                $ses_data = [
                    'id_user' => $data['id'],
                    'id_departemen' => $data['id_departemen'],
                    'nama_user' => $data['nama_user'],
                    'foto' => $data['foto'],
                    'level' => $level,
                    'isLoggedIn' => TRUE
                ];
                session()->set($ses_data);
                session()->setFlashdata('success', 'Andah Berhasil Login!');
                if ($data['level'] == 1) {
                    return redirect()->to(route_to('admin.dashboard'));
                } else if ($data['level'] == 2) {
                    return redirect()->to(route_to('user.dashboard'));
                }
            } else {
                session()->setFlashdata('error', 'Username/Password Salah!');
                return redirect()->to(route_to('login'));
            }
        } else {
            $validation = \Config\Services::validation();
            session()->setFlashdata('validationErrors', $validation->getErrors());
            return redirect()->to(route_to('login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        session()->setFlashdata('success', 'Andah Berhasil Logout!');
        return redirect()->to(route_to('login'));
    }
}
