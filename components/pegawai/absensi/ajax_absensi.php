<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if ($_POST["fun"] == "absenMasuk") {
    $daId = $_POST['daId'];
    $daDate = $_POST['daDate'];
    $daTime = $_POST['daTime'];
    $daLatMasuk = $_POST['daLat'];
    $daLongMasuk = $_POST['daLong'];
    $sql = "INSERT INTO t_absensi (id_pegawai, tgl_absen, absen_masuk, lat_masuk, long_masuk) values ('" . $daId . "', '" . $daDate . "', '" . $daTime . "', '" . $daLatMasuk . "', '" . $daLongMasuk . "')";
    $proses = mysqli_query($conn, $sql);
    if ($proses) {
        echo 1;
    } else {
        echo "GAGAL : " . $sql;
    }
}

if ($_POST["fun"] == "absenPulang") {
    $daId = $_POST['daId'];
    $daKegiatan = $_POST['daKegiatan'];
    $daDate = $_POST['daDate'];
    $daTime = $_POST['daTime'];
    $daLatPulang = $_POST['daLat'];
    $daLongPulang = $_POST['daLong'];
    $sql = "UPDATE t_absensi SET absen_ket = '" . $daKegiatan . "', absen_pulang = '" . $daTime . "', lat_pulang = '" . $daLatPulang . "', long_pulang = '" . $daLongPulang . "'  WHERE id_pegawai = '" . $daId . "' AND tgl_absen = '" . $daDate . "'";
    $proses = mysqli_query($conn, $sql);
    if ($proses) {
        echo 1;
    } else {
        echo "GAGAL : " . $sql;
    }
}
