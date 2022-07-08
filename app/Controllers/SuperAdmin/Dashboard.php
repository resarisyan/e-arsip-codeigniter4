<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\SuperAdmin\DashboardModel;

class Dashboard extends BaseController
{
    protected $halaman, $title, $dashboard;

    public function __construct()
    {
        $this->halaman = 'dashboard';
        $this->title = 'Dashboard';
        $this->dashboard = new DashboardModel();
    }

    public function index()
    {
        $data = [
            'halaman' => $this->halaman,
            'title' => $this->title,
            'main' => 'dashboard',
            'total_user' => $this->dashboard->tableCount('user'),
            'total_kategori' => $this->dashboard->tableCount('kategori'),
            'total_departemen' => $this->dashboard->tableCount('departemen'),
            'total_arsip' => $this->dashboard->tableCount('arsip'),
        ];

        return view('superadmin/dashboard', $data);
    }
}
