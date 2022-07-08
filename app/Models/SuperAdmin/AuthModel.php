<?php

namespace App\Models\SuperAdmin;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'admin';

    public function login($email, $password)
    {
        return $this->where([
            'email' => $email,
            'password' => $password
        ])->get()->getRowArray();
    }
}
