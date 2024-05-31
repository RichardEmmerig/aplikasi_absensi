<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if ($_REQUEST['fun'] == 'fetch_users') {

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $searchValue = $_POST['search']['value']; // Search value

    if ($searchValue != '') {
        $date_range = " AND t_pegawai.no_wa LIKE '%" . $searchValue . "%' OR t_pegawai.nama_lengkap LIKE '%" . $searchValue . "%' ";
    } else {
        $date_range = "";
    }

    $columns = ' t_pegawai.id_pegawai, t_pegawai.username, t_pegawai.password, t_pegawai.status, t_pegawai.nama_lengkap, t_pegawai.jenis_kelamin, t_pegawai.no_wa, t_pegawai.divisi, t_divisi.id_divisi, t_divisi.divisi ';
    $table = ' t_pegawai, t_divisi ';
    $where = " WHERE t_pegawai.username !='' AND t_pegawai.status != 1 " . $date_range . "AND t_pegawai.divisi = t_divisi.id_divisi";

    $columns_order = array(
        0 => 'id_pegawai',
    );

    $sql = "SELECT " . $columns . " FROM " . $table . " " . $where;

    $result = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $result = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY " . $columns_order[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'];

    if ($requestData['length'] != "-1") {
        $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'];
    }

    // echo $sql;

    $result = mysqli_query($conn, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while ($row = mysqli_fetch_array($result)) {
        $count++;
        $nestedData = array();

        $nama_lengkap_link = "
        <td scope=\"row\"><a href=\"index.php?menu=data_pegawai&id_pegawai=" . $row['id_pegawai'] . " \">" . $row['nama_lengkap'] . "</td>
        ";
        $aksi = "
        <button type=\"button\" data-id=\" " . $row['id_pegawai'] . " \" class=\"btn btn-primary my-2 btn_edit_pegawai\">Edit</button>
        <button type=\"button\" data-id=\" " . $row['id_pegawai'] . " \" class=\"btn btn-danger my-2 btn_delete_pegawai\">Delete</button>
        ";

        $nestedData['no'] = $count;
        $nestedData['username'] = $row["username"];
        $nestedData['password'] = $row["password"];
        $nestedData['status'] = $row["status"];
        $nestedData['nama_lengkap'] = $nama_lengkap_link;
        $nestedData['jenis_kelamin'] = $row["jenis_kelamin"];
        $nestedData['no_wa'] = $row['no_wa'];
        $nestedData['divisi'] = $row["divisi"];
        $nestedData['aksi'] = $aksi;

        $data[] = $nestedData;
    }

    $json_data = array(
        "draw"            => intval($requestData['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "records"         => $data
    );

    echo json_encode($json_data);
}

if ($_REQUEST['fun'] == 'fetch_selected_user') {

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $searchValue = $_POST['search']['value']; // Search value

    $date_range = "";

    $columns = ' * ';
    $table = ' t_absensi ';
    $where = " WHERE t_absensi.id_pegawai = '" . $_POST['id_pegawai'] . "'";

    $columns_order = array(
        0 => 'id_pegawai',
    );

    $sql = "SELECT " . $columns . " FROM " . $table . " " . $where;

    $result = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $result = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY " . $columns_order[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'];

    if ($requestData['length'] != "-1") {
        $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'];
    }

    // echo $sql;

    $result = mysqli_query($conn, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while ($row = mysqli_fetch_array($result)) {
        $count++;
        $nestedData = array();

        $getHari = date('l', strtotime($row['tgl_absen']));
        switch ($getHari) {
            case "Monday":
                $setHari = "Senin";
                break;
            case "Tuesday":
                $setHari = "Selasa";
                break;
            case "Wednesday":
                $setHari = "Rabu";
                break;
            case "Thursday":
                $setHari = "Kamis";
                break;
            case "Friday":
                $setHari = "Jumat";
                break;
            case "Saturday":
                $setHari = "Sabtu";
                break;
            case "Sunday":
                $setHari = "Minggu";
                break;
        }

        $nestedData['no'] = $count;
        $nestedData['hari'] = $getHari;
        $nestedData['tgl_absen'] = $row["tgl_absen"];
        $nestedData['masuk'] = $row["absen_masuk"];
        $nestedData['pulang'] = $row["absen_pulang"];
        $nestedData['keterangan'] = $row["absen_ket"];
        $nestedData['lokasi_masuk'] = $row['lat_masuk'] . " | " . $row['long_masuk'];
        $nestedData['lokasi_pulang'] = $row['lat_pulang'] . " | " . $row['long_pulang'];

        $data[] = $nestedData;
    }

    $json_data = array(
        "draw"            => intval($requestData['draw']),
        "recordsTotal"    => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "records"         => $data
    );

    echo json_encode($json_data);
}



if (isset($_POST['fun'])) {
    if ($_POST['fun'] == "proses_simpan") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $alamat_ktp = $_POST['alamat_ktp'];
        $alamat_domisili = $_POST['alamat_domisili'];
        $no_wa = $_POST['no_wa'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $status_pekerja = $_POST['status_pekerja'];
        $divisi = $_POST['id_divisi'];
        $sql = "INSERT INTO t_pegawai (username, `password`, `status`, nama_lengkap, alamat_ktp, alamat_domisili, no_wa, tgl_lahir, jenis_kelamin, status_pekerja, divisi) values ('" . $username . "','" . $password . "','3','" . $nama_lengkap . "','" . $alamat_ktp . "','" . $alamat_domisili . "','" . $no_wa . "','" . $tgl_lahir . "','" . $jenis_kelamin . "','" . $status_pekerja . "','" . $divisi . "')";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            echo 1;
        } else {
            echo "GAGAL : " . $sql;
        }
    } else if ($_POST['fun'] == "proses_hapus") {
        $id = $_POST['id'];
        $sql = "DELETE FROM t_divisi WHERE id_divisi = '" . $id . "' ";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            echo 1;
        } else {
            echo "GAGAL : " . $sql;
        }

        // nama_lengkap = '" . $nama_lengkap . "', 
    } else if ($_POST['fun'] == "proses_edit") {
        $id_pegawai = $_POST['id'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $alamat_ktp = $_POST['alamat_ktp'];
        $alamat_domisili = $_POST['alamat_domisili'];
        $no_wa = $_POST['no_wa'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $status_pekerja = $_POST['status_pekerja'];
        $divisi = $_POST['id_divisi'];
        $sql = "UPDATE t_pegawai SET nama_lengkap = '" . $nama_lengkap . "', alamat_ktp = '" . $alamat_ktp . "', alamat_domisili = '" . $alamat_domisili . "', no_wa = '" . $no_wa . "', tgl_lahir = '" . $tgl_lahir . "', jenis_kelamin = '" . $jenis_kelamin . "', status_pekerja = '" . $status_pekerja . "', divisi = '" . $divisi . "' WHERE id_pegawai = '" . $id_pegawai . "' ";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            echo $sql;
            echo 2;
        } else {
            echo "GAGAL : " . $sql;
        }
    } else if ($_POST['fun'] == "proses_get_edit") {
        $id = $_POST['id'];
        $data = [];
        $sql = "SELECT * FROM t_pegawai WHERE id_pegawai = '" . $id . "' ";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            $rowcount = mysqli_num_rows($proses);
            if ($rowcount > 0) {
                while ($fetching = mysqli_fetch_array($proses)) {
                    $data[] = array(
                        'id_pegawai' => $fetching['id_pegawai'],
                        'nama_lengkap' => $fetching['nama_lengkap'],
                        'alamat_ktp' => $fetching['alamat_ktp'],
                        'alamat_domisili' => $fetching['alamat_domisili'],
                        'no_wa' => $fetching['no_wa'],
                        'tgl_lahir' => $fetching['tgl_lahir'],
                        'jenis_kelamin' => $fetching['jenis_kelamin'],
                        'status_pekerja' => $fetching['status_pekerja'],
                        'divisi' => $fetching['divisi'],
                    );
                }
                echo json_encode($data);
            } else {
                echo 0;
            }
        } else {
            echo "SQL GAGAL : " . $sql;
        }
    }
} else {
    echo "Gagal Total";
};
