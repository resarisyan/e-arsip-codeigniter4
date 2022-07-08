<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'halaman' => 'home',
        ];
        return view('home', $data);
    }
}
