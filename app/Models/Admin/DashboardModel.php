<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function userCount($id_departemen)
    {
        return $this->db->table('user')
            ->where('id_departemen', $id_departemen)
            ->where('level', '2')
            ->countAllResults();
    }
    public function kategoriCount()
    {
        return $this->db->table('kategori')->countAll();
    }
    public function arsipCount($id_departemen)
    {
        return $this->db->table('arsip')
            ->where('id_departemen', $id_departemen)
            ->countAllResults();
    }
}
