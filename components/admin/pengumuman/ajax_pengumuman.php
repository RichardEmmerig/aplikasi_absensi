<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

switch ($_POST['fun']) {
    case 'fetch_pengumuman':
        $requestData = $_REQUEST;
        $start = $_REQUEST['start'];

        $searchValue = $_POST['search']['value']; // Search value

        $date_range = "";

        $columns = ' * ';
        $table = ' t_pengumuman ';
        $where = "";

        $columns_order = array(
            0 => 'id_pengumuman',
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

            $nestedData['no'] = $count;
            $nestedData['nama_pengumuman'] = $row['nama_pengumuman'];
            $nestedData['waktu_tgl_pengumuman'] = $row["waktu_tgl_pengumuman"];
            $nestedData['isi_pengumuman'] = $row["isi_pengumuman"];
            $nestedData['id_pegawai'] = $row["id_pegawai"];

            $aksi = "
            <button type=\"button\" data-id=\"" . $row['id_pengumuman'] . "\" class=\"btn btn-primary my-2 btn_edit_pengumuman\">Edit</button>
            <button type=\"button\" data-id=\"" . $row['id_pengumuman'] . "\" class=\"btn btn-danger my-2 btn_delete_pengumuman\">Delete</button>
            ";

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
        break;

    case 'tbh_pengumuman':
        $nama_pengumuman = $_POST['nama_pengumuman'];
        $waktu_tgl_pengumuman = $_POST['waktu_tgl_pengumuman'];
        $isi_pengumuman = $_POST['isi_pengumuman'];
        $admin = $_POST['admin'];
        $sql = "INSERT INTO t_pengumuman (nama_pengumuman, waktu_tgl_pengumuman, isi_pengumuman, id_pegawai) values ('" . $nama_pengumuman . "', '" . $waktu_tgl_pengumuman . "', '" . $isi_pengumuman . "', '" . $admin . "')";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            echo 1;
        } else {
            echo "GAGAL : " . $sql;
        }
        break;

    default:
        # code...
        break;
}
