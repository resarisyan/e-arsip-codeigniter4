<?php

namespace App\Models\SuperAdmin;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function tableCount($table)
    {
        return $this->db->table($table)->countAll();
    }
}
