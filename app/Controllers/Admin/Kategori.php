<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KategoriModel;

class Kategori extends BaseController
{
    protected $halaman, $title, $kategori;

    public function __construct()
    {
        $this->halaman = 'kategori';
        $this->title = 'Kategori';
        $this->kategori = new KategoriModel();
    }

    public function index()
    {
        $data = [
            'halaman' => $this->halaman,
            'title' => $this->title,
            'main' => 'kategori/index'
        ];

        return view('admin/kategori', $data);
    }

    public function ajaxList()
    {
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']['value'];

        $total = $this->kategori->ajaxGetTotal();
        $output = [
            'length' => $length,
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total
        ];

        if ($search !== '') {
            $list = $this->kategori->ajaxGetDataSearch($search, $length, $start);
        } else {
            $list = $this->kategori->ajaxGetData($length, $start);
        }

        if ($search !== '') {
            $total_search = $this->kategori->ajaxGetTotalSearch($search);
            $output = [
                'recordsTotal' => $total_search,
                'recordsFiltered' => $total_search
            ];
        }

        $data = [];
        $no = $start;
        foreach ($list as $mylist) {
            $status = '
            <div class="text-center">
                <a href="javascript:void(0)" data-toggle="tooltip" title="' . ($mylist['status'] == 0  ? 'Aktifkan' : 'Nonaktifkan') . '">
                    ' . formatStatus($mylist['status']) . '
                </a>
            </div>';

            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $mylist["nama_kategori"];
            $row[] = $status;
            $data[] = $row;
        }

        $output['data'] = $data;
        echo json_encode($output);
    }

    function ajaxSave()
    {
        $this->_validate('save');

        $data = [
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'status' => '1'
        ];


        if ($this->kategori->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
            exit();
        }
    }

    public function _validate($method)
    {
        if (!$this->validate($this->kategori->getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('nama_kategori')) {
                $data['inputerror'][] = 'nama_kategori';
                $data['error_string'][] = $validation->getError('nama_kategori');
                $data['status'] = FALSE;
            }

            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
}
