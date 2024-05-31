<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

// Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$searchValue = mysqli_real_escape_string($conn, $_POST['search']['value']); // Search value

// Search 
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " and jabatan like '%" . $searchValue . "%' ";
}

// Total number of records without filtering
$sel = mysqli_query($conn, "select count(*) as allcount from t_jabatan ORDER BY id_jabatan ASC");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$selQuery = "select count(*) as allcount from t_jabatan" . $searchQuery;
$sel = mysqli_query($conn, $selQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

// Fetch records
$empQuery = "SELECT * FROM from t_jabatan WHERE 1 AND " . $searchQuery . " ORDER BY id_jabatan ASC " . $row . "," . $rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

$no = 1;
// $sql = "SELECT * FROM t_divisi, t_jabatan WHERE t_divisi.id_jabatan = t_jabatan.id_jabatan ORDER BY id_divisi ASC";
// $proses = mysqli_query($conn, $sql);
// $rowcount = mysqli_num_rows($proses);
while ($fetching = mysqli_fetch_array($empRecords)) {
    $aksi = "
    <button type='button' data-id=" . $fetching['id_jabatan'] . " class='btn btn-primary my-2 btn_edit_divisi'>Edit</button>
    <button type='button' data-id=" . $fetching['id_jabatan'] . " class='btn btn-danger my-2 btn_delete_divisi'>Delete</button>";
    $data[] = array(
        'no' => $no,
        'jabatan' => $fetching['jabatan'],
        'aksi' => $aksi,
    );
    $no++;
}
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
