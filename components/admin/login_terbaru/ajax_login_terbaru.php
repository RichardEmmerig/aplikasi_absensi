<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

$requestData = $_REQUEST;
$start = $_REQUEST['start'];

$searchValue = "";

$columns_order = array(
    0 => 'id_absensi',
);

$sql = "SELECT * FROM t_absensi, t_pegawai WHERE t_absensi.id_pegawai = t_pegawai.id_pegawai AND DAY(tgl_absen) = DAY(CURRENT_DATE()) AND MONTH(tgl_absen) = MONTH(CURRENT_DATE()) AND YEAR(tgl_absen) = YEAR(CURRENT_DATE()) ORDER BY t_absensi.absen_masuk ASC";

$result = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($result);
$totalFiltered = $totalData;

$result = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($result);
$totalFiltered = $totalData;

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

    $nestedData['tanggal'] = $row["tgl_absen"];
    $nestedData['nama_lengkap'] = $row["nama_lengkap"];
    $nestedData['jam_masuk'] = "Masuk pada jam : " . $row['absen_masuk'];

    $data[] = $nestedData;
}

$json_data = array(
    "draw"            => intval($requestData['draw']),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "records"         => $data
);

echo json_encode($json_data);
