<?php

namespace App\Models\SuperAdmin;

use CodeIgniter\Model;


class DepartemenModel extends Model
{
    protected $table = 'departemen';
    protected $column_order = [null, 'nama_departemen', 'status'];
    protected $column_search = ['id', 'nama_departemen'];
    protected $allowedFields = ['nama_departemen', 'status'];

    public function getAllDepartemen()
    {
        return $this->where("status = '1'")->findAll();
    }

    public function getRulesValidation($method)
    {
        $rulesValidation = [
            'nama_departemen' => [
                'label' => 'Nama Departemen',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ]
        ];

        return $rulesValidation;
    }

    public function ajaxGetData($length, $start)
    {
        $result = $this->orderBy('id', 'desc')
            ->findAll($length, $start);
        return $result;
    }

    public function ajaxGetDataSearch($search, $length, $start)
    {
        $result = $this->like('nama_departemen', $search)
            ->orderBy('id', 'desc')
            ->findAll($length, $start);
        return $result;
    }

    public function ajaxGetTotal()
    {
        $result = $this->countAll();

        if (isset($result)) {
            return $result;
        }

        return 0;
    }

    public function ajaxGetTotalSearch($search)
    {
        $result = $this->like('nama_departemen', $search)
            ->countAllResults();

        return $result;
    }
}
