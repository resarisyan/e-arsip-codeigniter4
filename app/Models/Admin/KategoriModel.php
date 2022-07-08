<?php

namespace App\Models\Admin;

use CodeIgniter\Model;


class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $column_order = [null, 'nama_kategori'];
    protected $column_search = ['id', 'nama_kategori'];
    protected $allowedFields = ['nama_kategori', 'status'];

    public function getAllKategori()
    {
        return $this->findAll();
    }

    public function getRulesValidation($method)
    {
        $rulesValidation = [
            'nama_kategori' => [
                'label' => 'Nama Kategori',
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
        $result = $this->like('nama_kategori', $search)
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
        $result = $this->like('nama_kategori', $search)
            ->countAllResults();

        return $result;
    }
}
