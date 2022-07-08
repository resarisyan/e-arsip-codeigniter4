<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    protected $table = 'arsip';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'no_arsip', 'nama_arsip', 'file_arsip', 'ukuran_file', 'deskripsi',
        'created_at', 'updated_at', 'id_kategori', 'id_departemen', 'id_user', 'status'
    ];

    public function getRulesValidation($method)
    {
        if ($method == 'update') {
            $fileRules = 'max_size[file_arsip,100024]|ext_in[file_arsip,pdf]';
        } else {
            $fileRules = 'uploaded[file_arsip]|max_size[file_arsip,100024]|ext_in[file_arsip,pdf]';
        }
        $rulesValidation = [
            'no_arsip' => [
                'label' => 'No Arsip',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'nama_arsip' => [
                'label' => 'Nama File',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'deskripsi' => [
                'label' => 'deskripsi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'user' => [
                'label' => 'User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'file_arsip' => [
                'label' => 'File Arsip',
                'rules' => $fileRules,
                'errors' => [
                    'uploaded' => '{field} Harus Dipilih.',
                    'max_size' => '{field} Melebihi Ukuran Yang Ditentukan (Max 1MB).',
                    'ext_in' => 'Format {field} Tidak Sesuai.'
                ]
            ],
        ];

        return $rulesValidation;
    }

    public function ajaxGetData($length, $start)
    {
        // $result = $this->orderBy('id', 'desc')
        //     ->findAll($length, $start);
        $result = $this->select(
            'arsip.id, arsip.no_arsip, arsip.nama_arsip, arsip.file_arsip, arsip.ukuran_file, 
            arsip.deskripsi, arsip.status, arsip.created_at, arsip.updated_at, departemen.nama_departemen, kategori.nama_kategori, user.nama_user'
        )
            ->join('departemen', 'departemen.id = arsip.id_departemen', 'inner')
            ->join('kategori', 'kategori.id = arsip.id_kategori', 'inner')
            ->join('user', 'user.id = arsip.id_user', 'inner')
            ->where('arsip.id_departemen', session()->get('id_departemen'))
            ->orderBy('id', 'desc')
            ->findAll($length, $start);
        return $result;
    }

    public function getDetailArsip($kode_arsip)
    {
        $result = $this->select(
            'arsip.id, arsip.no_arsip, arsip.nama_arsip, arsip.file_arsip, arsip.ukuran_file, 
            arsip.deskripsi, arsip.status, arsip.created_at, arsip.updated_at, departemen.nama_departemen, kategori.nama_kategori, user.nama_user'
        )
            ->join('departemen', 'departemen.id = arsip.id_departemen', 'inner')
            ->join('kategori', 'kategori.id = arsip.id_kategori', 'inner')
            ->join('user', 'user.id = arsip.id_user', 'inner')
            ->orderBy('id', 'desc')
            ->where('no_arsip', $kode_arsip)
            ->where('arsip.id_departemen', session()->get('id_departemen'))
            ->get()->getRowArray();

        return $result;
    }


    public function ajaxGetDataSearch($search, $length, $start)
    {
        $result = $this->select(
            'arsip.id, arsip.no_arsip, arsip.nama_arsip, arsip.file_arsip, arsip.ukuran_file, 
            arsip.deskripsi, arsip.status, arsip.created_at, arsip.updated_at, departemen.nama_departemen, kategori.nama_kategori, user.nama_user'
        )
            ->join('departemen', 'departemen.id = arsip.id_departemen', 'inner')
            ->join('kategori', 'kategori.id = arsip.id_kategori', 'inner')
            ->join('user', 'user.id = arsip.id_user', 'inner')
            ->like('no_arsip', $search)
            ->orLike('nama_arsip', $search)
            ->where('arsip.id_departemen', session()->get('id_departemen'))
            ->orderBy('id', 'desc')
            ->findAll($length, $start);
        return $result;
    }

    public function ajaxGetTotal()
    {
        $result = $this->where('id_departemen', session()->get('id_departemen'))->countAllResults();

        if (isset($result)) {
            return $result;
        }

        return 0;
    }

    public function ajaxGetTotalSearch($search)
    {
        $result = $this->select(
            'arsip.id, arsip.no_arsip, arsip.nama_arsip, arsip.file_arsip, arsip.ukuran_file, 
            arsip.deskripsi, arsip.status, arsip.created_at, arsip.updated_at, departemen.nama_departemen, kategori.nama_kategori, user.nama_user'
        )
            ->join('departemen', 'departemen.id = arsip.id_departemen', 'inner')
            ->join('kategori', 'kategori.id = arsip.id_kategori', 'inner')
            ->join('user', 'user.id = arsip.id_user', 'inner')
            ->like('no_arsip', $search)
            ->orLike('nama_arsip', $search)
            ->where('arsip.id_departemen', session()->get('id_departemen'))
            ->countAllResults();

        return $result;
    }
}
