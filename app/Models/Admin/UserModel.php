<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama_user', 'email', 'password', 'level', 'foto', 'id_departemen', 'status'];

    public function getRulesValidation($method)
    {
        if ($method == 'update') {
            $imgRules = 'max_size[foto,1024]|is_image[foto]|ext_in[foto,png,jpg,jpeg]';
            $passwordRules = 'permit_empty';
        } else {
            $imgRules = 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|ext_in[foto,png,jpg,jpeg]';
            $passwordRules = 'required';
        }
        $rulesValidation = [
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => $passwordRules,
                'errors' => [
                    'required' => '{field} Harus Diisi.'
                ]
            ],
            'foto' => [
                'label' => 'Foto',
                'rules' => $imgRules,
                'errors' => [
                    'uploaded' => '{field} Harus Dipilih.',
                    'max_size' => '{field} Melebihi Ukuran Yang Ditentukan (Max 1MB).',
                    'is_image' => 'Format {field} Tidak Sesuai.',
                    'ext_in' => 'Format {field} Tidak Sesuai.'
                ]
            ],
        ];

        return $rulesValidation;
    }

    public function ajaxGetData($length, $start)
    {
        $result = $this->where('level', '2')->where('id_departemen', session()->get('id_departemen'))->orderBy('id', 'desc')
            ->findAll($length, $start);
        return $result;
    }

    public function ajaxGetDataSearch($search, $length, $start)
    {
        $result = $this->where('level', '2')->where('id_departemen', session()->get('id_departemen'))->like('nama_user', $search)
            ->orderBy('id', 'desc')
            ->findAll($length, $start);
        return $result;
    }

    public function ajaxGetTotal($id)
    {
        $result = $this->where('level', '2')->where('id_departemen', $id)->countAllResults();

        if (isset($result)) {
            return $result;
        }

        return 0;
    }

    public function ajaxGetTotalSearch($search)
    {
        $result = $this->where('level', '2')->where('id_departemen', session()->get('id_departemen'))->like('nama_user', $search)
            ->countAllResults();

        return $result;
    }
}
