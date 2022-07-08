<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user';

    public function login($email, $password)
    {
        return $this->where([
            'email' => $email,
            'password' => $password
        ])->get()->getRowArray();
    }

    public function getDetailUser($id)
    {
        return $this->select('user.nama_user, user.email, user.level, user.foto, departemen.nama_departemen')
            ->join('departemen', 'departemen.id = user.id_departemen', 'inner')
            ->where('user.id', $id)
            ->get()->getRowArray();
    }
}
