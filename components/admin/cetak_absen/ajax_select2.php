<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if (isset($_POST['id_divisi'])) {
    $select_id = $_POST["select_id"];
} else {
    $select_id = "";
}
$no = 1;
// Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$searchValue = mysqli_real_escape_string($conn, $_POST['search']['value']); // Search value

// Search 
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " AND CONCAT_WS(nama_lengkap, no_wa, t_divisi.divisi) like '%" . $searchValue . "%' ";
}

// Total number of records without filtering
$sel = mysqli_query($conn, "select count(*) as allcount from t_pegawai ORDER BY id_pegawai ASC");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$selQuery = "select count(*) as allcount FROM t_pegawai, t_divisi WHERE 1 AND t_pegawai.divisi = t_divisi.id_divisi " . $searchQuery;
$sel = mysqli_query($conn, $selQuery);
// echo $selQuery;
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

// Fetch records
$empQuery = "SELECT * FROM t_pegawai, t_divisi WHERE 1 AND t_pegawai.divisi = t_divisi.id_divisi " . $searchQuery . " ORDER BY id_pegawai ASC LIMIT " . $row . "," . $rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

// if ($select_id != 0) {
//     $sql = "SELECT * FROM t_pegawai, t_jabatan WHERE t_pegawai.id_jabatan = t_jabatan.id_jabatan AND id_jabatan = '" . $select_id . "' ORDER BY id_pegawai ASC LIMIT 5";
// } else {
//     $sql = "SELECT * FROM t_pegawai, t_jabatan WHERE t_pegawai.id_jabatan = t_jabatan.id_jabatan ORDER BY id_pegawai ASC LIMIT 5";
// }
// $proses = mysqli_query($conn, $sql);
// $rowcount = mysqli_num_rows($proses);
while ($fetching = mysqli_fetch_array($empRecords)) {
    if ($fetching["id_pegawai"] != 1) {
        $data[] = array(
            'id' => $fetching['id_pegawai'],
            'nama_lengkap' => $fetching['nama_lengkap'],
            'no_wa' => $fetching['no_wa'],
            'divisi' => $fetching['divisi'],
        );
        $no++;
    }
}

$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
