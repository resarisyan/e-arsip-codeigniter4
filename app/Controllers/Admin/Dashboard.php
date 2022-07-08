<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\DashboardModel;
use App\Models\AuthModel;

class Dashboard extends BaseController
{
    protected $halaman, $title, $dashboard, $auth;

    public function __construct()
    {
        $this->halaman = 'dashboard';
        $this->title = 'Dashboard';
        $this->dashboard = new DashboardModel();
        $this->auth = new AuthModel();
    }

    public function index()
    {
        $data = [
            'halaman' => $this->halaman,
            'title' => $this->title,
            'main' => 'arsip/index',
            'total_user' => $this->dashboard->userCount(session()->get('id_departemen')),
            'total_kategori' => $this->dashboard->kategoriCount(),
            'total_arsip' => $this->dashboard->arsipCount(session()->get('id_departemen')),
            'data_user' => $this->auth->getDetailUser(session()->get('id_user'))
        ];

        return view('admin/dashboard', $data);
    }
}
