<?php

namespace App\Models\User;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function arsipCount($id_departemen, $id_user)
    {
        return $this->db->table('arsip')
            ->join('user', 'user.id = arsip.id_user', 'inner')
            ->where('arsip.id_departemen', $id_departemen)
            ->where('user.id', $id_user)
            ->countAllResults();
    }
}
