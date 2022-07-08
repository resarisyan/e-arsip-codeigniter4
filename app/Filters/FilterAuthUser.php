<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuperAdmin\ArsipModel;


class FilterAuthUser implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedIn') != true) {
            session()->setFlashdata('error', 'Anda Belum Login!');
            return redirect()->to(route_to('login'));
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('isLoggedIn') == true) {
            if (session()->get('level') == 'user') {
                return redirect()->to(route_to('user.dashboard'));
            }
        }
    }
}
