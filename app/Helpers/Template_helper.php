<?php

function formatStatus($status)
{
    if ($status == '0') {
        $result = '
            <div class="text-center">
                <span class="badge badge-danger">Tidak Aktif</span>
            </div>            
        ';
    } else {
        $result = '
            <div class="text-center">
                <span class="badge badge-success">Aktif</span>
            </div>            
        ';
    }

    return $result;
}

function formatStatusProduk($status)
{
    if ($status == '0') {
        $result = '
            <div class="text-center">
                <span class="label label-danger">Tidak Tersedia</span>
            </div>            
        ';
    } else {
        $result = '
            <div class="text-center">
                <span class="label label-success">Tersedia</span>
            </div>            
        ';
    }

    return $result;
}

function formatStatusPesan($status)
{
    if ($status == '1') {
        $result = '
            <div class="text-center">
                <span class="badge badge-warning">Belum Diproses</span>
            </div>
        ';
    } else if ($status == '2') {
        $result = '
            <div class="text-center">
                <span class="badge badge-primary">Diproses</span>
            </div>
        ';
    } else if ($status == '3') {
        $result = '
            <div class="text-center">
                <span class="badge badge-info">Dalam Perjalanan</span>
            </div>
        ';
    } else if ($status == '4') {
        $result = '
            <div class="text-center">
                <span class="badge badge-success">Selesai</span>
            </div>
        ';
    } else {
        $result = '
            <div class="text-center">
                <span class="badge badge-danger">Dibatalkan</span>
            </div>
        ';
    }

    return $result;
}

function formatTgl($waktu, $tipe)
{
    if ($tipe == 0) {
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu'
        );
        $hr = date('w', strtotime($waktu));
        $hari = $hari_array[$hr];

        $tanggal = date('j', strtotime($waktu));

        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];

        $tahun = date('Y', strtotime($waktu));

        return "$hari, $tanggal $bulan $tahun";
    } else if ($tipe == 1) {
        $tanggal = date('j', strtotime($waktu));

        $bulan_array = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];

        $tahun = date('Y', strtotime($waktu));

        return "$tanggal $bulan $tahun";
    } else {
        $tanggal = date('j', strtotime($waktu));

        $bulan_array = array(
            1 => '01',
            2 => '02',
            3 => '03',
            4 => '04',
            5 => '05',
            6 => '06',
            7 => '07',
            8 => '08',
            9 => '09',
            10 => '10',
            11 => '11',
            12 => '12',
        );
        $bl = date('n', strtotime($waktu));
        $bulan = $bulan_array[$bl];

        $tahun = date('Y', strtotime($waktu));

        return "$tanggal/$bulan";
    }
}

function formatWaktu($waktu)
{
    $newDateTime = date('h:i A', strtotime($waktu));
    return "$newDateTime";
}

function formatRupiah($angka, $tipe)
{
    if ($tipe == 0) {
        $hasil = number_format($angka, 0, ',', '.');
    } else {
        $hasil =  'Rp. ' . number_format($angka, 0, ',', '.');
    }

    return $hasil;
}

function uploadImage($img)
{
    $img_name = $img->getRandomName();
    $img->move('uploads/userimg', $img_name);

    return $img_name;
}

function uploadFile($file)
{
    $file_name = $file->getRandomName();
    $file->move('uploads/arsip', $file_name);

    return $file_name;
}

function getDropdownListKey($table, $columns, $orderby, $where = null, $wherekey = null)
{
    $db = \Config\Database::connect();
    if ($where == null) {
        $data = $db->table($table)->select($columns)
            ->where('status', '1')
            ->orderBy($orderby, 'asc')->get();
    } else {
        $data = $db->table($table)->select($columns)
            ->where('status', '1')
            ->where($where, $wherekey)
            ->orderBy($orderby, 'asc')->get();
    }
    if (isset($data)) {
        $data = $data->getResultArray();
        $finaldata = [];
        $temp = 0;
        // $id = $id->getResultArray();
        foreach ($data as $key => $value) {
            $index = 1;
            foreach ($data[$key] as $d) {
                if ($index % 2 == 0) {
                    array_push($finaldata, [$d, $temp]);
                } else {
                    $temp = $d;
                }
                $index++;
            }
        }
        return $finaldata;
    }
}

function tempKategori($table, $columns)
{
    $db = \Config\Database::connect();
    $query = $db->query("SELECT " . $columns . " FROM " . $table)->getRow();
    return $query->kategori;
}

function tempDepartemen($table)
{
    $db = \Config\Database::connect();
    $query = $db->query("SELECT d.nama_departemen FROM user as u INNER JOIN departemen as d ON d.id = u.id_departemen")->getRow(); // d($query);
    var_dump($query);
}

function field_enums($table = '', $field = '', $title = '')
{
    $enums = array();
    if ($table == '' || $field == '') return $enums;
    $db = \Config\Database::connect();
    preg_match_all("/'(.*?)'/", $db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->getRow()->Type, $matches);

    // $enums[''] = '- Pilih ' . $title . ' -';
    foreach ($matches[1] as $key => $value) {
        if ($value == 0) {
            $enums[$value] = '0. Dibatalkan';
        } else if ($value == 1) {
            $enums[$value] = '1. Belum Diproses';
        } else if ($value == 2) {
            $enums[$value] = '2. Diproses';
        } else if ($value == 3) {
            $enums[$value] = '3. Dalam Perjalanan';
        } else if ($value == 4) {
            $enums[$value] = '4. Selesai';
        }
    }
    return $enums;
}

function _autonumber($field, $table, $Parse, $Digit_Count)
{
    $NOL = "0";
    $query = "Select " . $field . " from " . $table . " where " . $field . " like '" . $Parse . "%' order by " . $field . " DESC LIMIT 0,2";

    $db = \Config\Database::connect();
    $data = $db->query($query)->getResultArray();

    $counter = 2;
    if (sizeof($data) == 0) {
        while ($counter < $Digit_Count) {
            $NOL = "0" . $NOL;
            $counter++;
        }

        return $Parse . $NOL . "1";
    } else {
        $R = $data[0][$field];
        $K = sprintf("%d", substr($R, -$Digit_Count));
        $K = $K + 1;
        $L = $K;

        while (strlen($L) != $Digit_Count) {
            $L = $NOL . $L;
        }

        return $Parse . $L;
    }
}
