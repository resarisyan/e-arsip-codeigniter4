<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User\ArsipModel;

class Arsip extends BaseController
{
    protected $halaman, $title, $arsip;

    public function __construct()
    {
        $this->halaman = 'arsip';
        $this->title = 'Arsip';
        $this->arsip = new ArsipModel();
    }

    public function index()
    {
        $data = [
            'halaman' => $this->halaman,
            'title' => $this->title,
            'main' => 'arsip/index'
        ];

        return view('user/arsip', $data);
    }

    public function view($kode_arsip)
    {
        $data = [
            'halaman' => 'view arsip',
            'title' => 'View Arsip',
            'main' => 'arsip/view',
            'arsip' => $this->arsip->getDetailArsip($kode_arsip)
        ];

        if (isset($data['arsip'])) {
            return view('user/arsip_view', $data);
        } else {
            session()->setFlashdata('error', 'No Arsip Tidak Ditemukan');
            return redirect()->to(route_to('user.arsip'));
        }
    }

    public function ajaxList()
    {
        $draw = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start = $_REQUEST['start'];
        $search = $_REQUEST['search']['value'];

        $total = $this->arsip->ajaxGetTotal();
        $output = [
            'length' => $length,
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total
        ];

        if ($search !== '') {
            $list = $this->arsip->ajaxGetDataSearch($search, $length, $start);
        } else {
            $list = $this->arsip->ajaxGetData($length, $start);
        }

        if ($search !== '') {
            $total_search = $this->arsip->ajaxGetTotalSearch($search);
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

            $file = '
            <div class="text-center">
                <a href="' . route_to('user.arsip.view', $mylist['no_arsip']) . '" class="d-block "><i class="fas fa-file-pdf fa-2x label-danger"></i></a>
                <span class="d-block ">' . number_format(floatval($mylist['ukuran_file']), 0) . ' KB </span>
            </div>
            ';


            $no++;
            $row = [];
            $row[] = $no;
            $row[] = $mylist["no_arsip"];
            $row[] = $mylist["nama_arsip"];
            $row[] = $mylist["nama_kategori"];
            $row[] = $mylist["updated_at"];
            $row[] = $mylist["updated_at"];
            $row[] = $mylist["nama_user"];
            $row[] = $mylist["nama_departemen"];
            $row[] = $file;

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
            'no_arsip' => $this->request->getVar('no_arsip'),
            'nama_arsip' => $this->request->getVar('nama_arsip'),
            'file_arsip' => uploadFile($this->request->getFile('file_arsip')),
            'ukuran_file' => $this->request->getFile('file_arsip')->getSizeByUnit('kb'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'created_at' => date("Y/m/d"),
            'updated_at' => date("Y/m/d"),
            'id_departemen' => session()->get('id_departemen'),
            'id_user' => session()->get('id_user'),
            'id_kategori' => $this->request->getVar('kategori'),
            'status' => '1',
        ];

        if ($this->arsip->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function ajaxEdit($id)
    {
        $data = $this->arsip->find($id);
        echo json_encode($data);
    }

    function ajaxUpdate()
    {
        $this->_validate('update');
        $id = $this->request->getVar('id');
        $arsip = $this->arsip->find($id);

        if ($this->request->getFile('file_arsip') == '') {
            $file = $arsip['file_arsip'];
            $file_size = $arsip['ukuran_file'];
        } else {
            unlink('uploads/arsip/' . $arsip['file_arsip']);
            $file = uploadFile($this->request->getFile('file_arsip'));
            $file_size = $this->request->getFile('file_arsip')->getSizeByUnit('kb');
        }

        $data = [
            'id' => $id,
            'no_arsip' => $this->request->getVar('no_arsip'),
            'nama_arsip' => $this->request->getVar('nama_arsip'),
            'file_arsip' => $file,
            'ukuran_file' => $file_size,
            'deskripsi' => $this->request->getVar('deskripsi'),
            'updated_at' => date("Y/m/d"),
            'id_departemen' => session()->get('id_departemen'),
            'id_user' => session()->get('id_user'),
            'id_kategori' => $this->request->getVar('kategori'),
        ];

        if ($this->arsip->save($data)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function ajaxDelete($id)
    {
        $arsip = $this->arsip->find($id);
        unlink('uploads/arsip/' . $arsip['file_arsip']);

        if ($this->arsip->delete($id)) {
            echo json_encode(['status' => TRUE]);
        } else {
            echo json_encode(['status' => FALSE]);
        }
    }

    public function _validate($method)
    {
        if (!$this->validate($this->arsip->getRulesValidation($method))) {
            $validation = \Config\Services::validation();

            $data = [];
            $data['error_string'] = [];
            $data['inputerror'] = [];
            $data['status'] = TRUE;

            if ($validation->hasError('no_arsip')) {
                $data['inputerror'][] = 'no_arsip';
                $data['error_string'][] = $validation->getError('no_arsip');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('nama_arsip')) {
                $data['inputerror'][] = 'nama_arsip';
                $data['error_string'][] = $validation->getError('nama_arsip');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('file_arsip')) {
                $data['inputerror'][] = 'file_arsip';
                $data['error_string'][] = $validation->getError('file_arsip');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('deskripsi')) {
                $data['inputerror'][] = 'deskripsi';
                $data['error_string'][] = $validation->getError('deskripsi');
                $data['status'] = FALSE;
            }
            if ($validation->hasError('kategori')) {
                $data['inputerror'][] = 'kategori';
                $data['error_string'][] = $validation->getError('kategori');
                $data['status'] = FALSE;
            }
            if ($data['status'] === FALSE) {
                echo json_encode($data);
                exit();
            }
        }
    }
}
