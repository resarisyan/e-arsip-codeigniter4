<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UserModel;

class User extends BaseController
{
    protected $halaman, $title, $user;

    public function __construct()
    {
        $this->halaman = 'user';
        $this->title = 'User';
        $this->user = new UserModel();
    }

    public function index()
    {
        $data = [
            'halaman' => $this->halaman,
            'title' => $this->title,
            'main' => 'user/index'
        ];

        return view('admin/user', $data);
    }

    public function ajaxList()
    {

        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']['value'];

        $total = $this->user->ajaxGetTotal(session()->get('id_departemen'));
        $output = [
            'length' => $length,
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => 1
        ];

        if ($search !== '') {
            $list = $this->user->ajaxGetDataSearch($search, $length, $start);
        } else {
            $list = $this->user->ajaxGetData($length, $start);
        }

        if ($search !== '') {
            $total_search = $this->user->ajaxGetTotalSearch($search);
            $output = [
                'recordsTotal' => $total_search,
                'recordsFiltered' => $total_search
            ];
        }

        $data = [];
        $no = $start;
        foreach ($list as $mylist) {
            $aksi = '
            <div class="text-center">
                <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Ubah Data" onclick="ajaxEdit(' . $mylist["id"] . ')">
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus Data" onclick="ajaxDelete(' . $mylist["id"] . ')">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>';

            $status = '
            <div class="text-center">
                <a href="javascript:void(0)" data-toggle="tooltip" title="' . ($mylist['status'] == 0  ? 'Aktifkan' : 'Nonaktifkan') . '" onclick="ajaxStatus(' . $mylist["id"] . ')">
                    ' . formatStatus($mylist['status']) . '
                </a>
            </div>';

            $foto = '
            <div class="text-center">
                <img src="' . base_url('uploads/userimg') . '/' . $mylist['foto'] . '"alt="' . $mylist['foto'] . '" width="auto" height="125px">
            </div>
            ';

            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $foto;
            $row[] = $mylist["nama_user"];
            $row[] = $mylist["email"];
            $row[] = $status;
            $row[] = $aksi;
            $data[] = $row;
        }

        $output['data'] = $data;
        echo json_encode($output);
    }

    function ajaxSave()
    {
        $this->_validate('save');

        $data = [
            'nama_user' => $this->request->getVar('nama_user'),
            'email' => $this->request->getVar('email'),
            'password' => md5($this->request->getVar('password')),
            'level' => '2',
            'foto' => uploadImage($this->request->getFile('foto')),
            'id_departemen' => session()->get('id_departemen'),
            'status' => '1',
        ];

        if ($this->user->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function ajaxEdit($id)
    {
        $data = $this->user->find($id);
        echo json_encode($data);
    }

    function ajaxUpdate()
    {
        $this->_validate('update');
        $id = $this->request->getVar('id');
        $user = $this->user->find($id);

        if ($this->request->getFile('foto') == '') {
            $foto = $user['foto'];
        } else {
            unlink('uploads/userimg/' . $user['foto']);
            $foto = uploadImage($this->request->getFile('foto'));
        }

        if ($this->request->getVar('password') == '') {
            $password = $user['password'];
        } else {
            $password = md5($this->request->getVar('password'));
        }
        $data = [
            'id' => $id,
            'nama_user' => $this->request->getVar('nama_user'),
            'email' => $this->request->getVar('email'),
            'password' => $password,
            'level' => '2',
            'foto' => $foto,
            'id_departemen' => session()->get('id_departemen'),
        ];

        if ($this->user->save($data)) {
            session()->set('foto', $foto);
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function ajaxDelete($id)
    {
        $user = $this->user->find($id);
        unlink('uploads/userimg/' . $user['foto']);

        if ($this->user->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function ajaxStatus($id)
    {
        $user = $this->user->find($id);
        $data['id'] = $id;
        if ($user['status'] == '0') {
            $data['status'] = '1';
        } else {
            $data['status'] = '0';
        }

        if ($this->user->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function _validate($method)
    {
        if (!$this->validate($this->user->getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('nama_user')) {
                $data['inputerror'][] = 'nama_user';
                $data['error_string'][] = $validation->getError('nama_user');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('email')) {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = $validation->getError('email');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('password')) {
                $data['inputerror'][] = 'password';
                $data['error_string'][] = $validation->getError('password');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('foto')) {
                $data['inputerror'][] = 'foto';
                $data['error_string'][] = $validation->getError('foto');
                $data['status'] = FALSE;
            }
            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
}
