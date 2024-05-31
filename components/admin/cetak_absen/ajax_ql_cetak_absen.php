<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if ($_REQUEST['action'] == 'fetch_users') {

    $requestData = $_REQUEST;
    $start = $_REQUEST['start'];

    $initial_date = strtotime($_REQUEST['initial_date']);
    $final_date = strtotime($_REQUEST['final_date']);
    $tanggal1 = date("Y-m-d", $initial_date);
    $tanggal2 = date("Y-m-d", $final_date);
    $no_wa = $_REQUEST['no_wa'];
    if (!empty($no_wa) && !empty($initial_date) && !empty($final_date)) {
        $date_range = " AND t_absensi.tgl_absen BETWEEN '" . $tanggal1 . "' AND '" . $tanggal2 . "' AND t_pegawai.no_wa LIKE '%" . $no_wa . "%' ";
    } else if (!empty($initial_date) && !empty($final_date)) {
        $date_range = " AND t_absensi.tgl_absen BETWEEN '" . $tanggal1 . "' AND '" . $tanggal2 . "' ";
    } else if (!empty($no_wa)) {
        $date_range = " AND t_pegawai.no_wa LIKE '%" . $no_wa . "%' ";
    } else {
        $date_range = "";
    }

    $columns = ' t_absensi.id_absen, t_absensi.id_pegawai, t_absensi.tgl_absen, t_absensi.absen_ket, t_absensi.absen_masuk, t_absensi.status_jam_masuk, t_absensi.ket_terlambat, t_absensi.absen_pulang, t_absensi.lat_masuk, t_absensi.long_masuk, t_absensi.lat_pulang, t_absensi.long_pulang, t_absensi.id_zona, t_absensi.zona_masuk, t_pegawai.id_pegawai, t_pegawai.nama_lengkap ';
    $table = ' t_absensi, t_pegawai ';
    $where = " WHERE t_absensi.id_pegawai = t_pegawai.id_pegawai AND t_pegawai.id_pegawai !='' " . $date_range;

    $columns_order = array(
        0 => 'id_absen',
    );

    $sql = "SELECT " . $columns . " FROM " . $table . " " . $where;

    $result = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    if (!empty($requestData['search']['value'])) {
        $sql .= " AND ( nama_lengkap LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR tgl_absen LIKE '%" . $requestData['search']['value'] . "%' )";
    }

    $result = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($result);
    $totalFiltered = $totalData;

    $sql .= " ORDER BY " . $columns_order[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'];

    if ($requestData['length'] != "-1") {
        $sql .= " LIMIT " . $requestData['start'] . " ," . $requestData['length'];
    }

    $result = mysqli_query($conn, $sql);
    $data = array();
    $counter = $start;

    $count = $start;
    while ($row = mysqli_fetch_array($result)) {
        $count++;
        $nestedData = array();

        $timestamp = strtotime($row['tgl_absen']);
        $get_day = date('l', $timestamp);
        if ($get_day == "Monday") {
            $set_day = "Senin";
        } else if ($get_day == "Tuesday") {
            $set_day = "Selasa";
        } else if ($get_day == "Wednesday") {
            $set_day = "Rabu";
        } else if ($get_day == "Thursday") {
            $set_day = "kamis";
        } else if ($get_day == "Friday") {
            $set_day = "Jumat";
        } else if ($get_day == "Saturday") {
            $set_day = "Sabtu";
        } else if ($get_day == "Sunday") {
            $set_day = "Minggu";
        }

        $nestedData['no'] = $count;
        $nestedData['nama_lengkap'] = $row["nama_lengkap"];
        $nestedData['hari'] = $set_day;
        $nestedData['tgl_absen'] = $row["tgl_absen"];
        $nestedData['keterangan'] = $row["absen_ket"];
        $nestedData['masuk'] = $row["absen_masuk"];
        $nestedData['lokasi_masuk'] = $row['lat_masuk'] . " | " . $row['long_masuk'];
        $nestedData['pulang'] = $row["absen_pulang"];
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
