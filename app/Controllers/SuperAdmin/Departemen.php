<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\SuperAdmin\DepartemenModel;

class Departemen extends BaseController
{
    protected $halaman, $title, $departemen;

    public function __construct()
    {
        $this->halaman = 'departemen';
        $this->title = 'Departemen';
        $this->departemen = new DepartemenModel();
    }

    public function index()
    {
        $data = [
            'halaman' => $this->halaman,
            'title' => $this->title,
            'main' => 'departemen'
        ];

        return view('superadmin/departemen', $data);
    }

    public function ajaxList()
    {
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']['value'];

        $total = $this->departemen->ajaxGetTotal();
        $output = [
            'length' => $length,
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total
        ];

        if ($search !== '') {
            $list = $this->departemen->ajaxGetDataSearch($search, $length, $start);
        } else {
            $list = $this->departemen->ajaxGetData($length, $start);
        }

        if ($search !== '') {
            $total_search = $this->departemen->ajaxGetTotalSearch($search);
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

            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $mylist["nama_departemen"];
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
            'nama_departemen' => $this->request->getVar('nama_departemen'),
            'status' => '1'
        ];


        if ($this->departemen->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
            exit();
        }
    }

    public function ajaxEdit($id)
    {
        $departemen = $this->departemen->find($id);
        echo json_encode($departemen);
    }

    public function ajaxUpdate()
    {
        $this->_validate('update');

        $data = [
            'id' => $this->request->getVar('id'),
            'nama_departemen' => $this->request->getVar('nama_departemen'),
        ];

        if ($this->departemen->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
            exit();
        }
    }

    public function ajaxDelete($id)
    {
        if ($this->departemen->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function ajaxStatus($id)
    {
        $departemen = $this->departemen->find($id);
        $data['id'] = $id;
        if ($departemen['status'] == '0') {
            $data['status'] = '1';
        } else {
            $data['status'] = '0';
        }

        if ($this->departemen->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function _validate($method)
    {
        if (!$this->validate($this->departemen->getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('nama_departemen')) {
                $data['inputerror'][] = 'nama_departemen';
                $data['error_string'][] = $validation->getError('nama_departemen');
                $data['status'] = FALSE;
            }

            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
}
