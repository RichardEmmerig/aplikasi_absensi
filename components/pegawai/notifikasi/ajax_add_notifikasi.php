<?php
session_start();

require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

// Variabel untuk nama notifikasi - $nmNotif
// $nmNotif_absen_masuk = "Absen Masuk";

switch ($_POST["target"]) {
    case 'absenMasuk':
        $nama_notifikasi = $_POST['nama_notifikasi'];
        $waktu_tgl_notifikasi = $_POST['waktu_tgl_notifikasi'];
        $isi_notifikasi = $_POST['isi_notifikasi'];
        $id_pegawai = $_SESSION["abs-id"];
        $sql_absenMasuk = "INSERT INTO t_notifikasi (nama_notifikasi, waktu_tgl_notifikasi, isi_notifikasi, id_pegawai) VALUES ('" . $nama_notifikasi . "','" . $waktu_tgl_notifikasi . "','" . $isi_notifikasi . "','" . $id_pegawai . "') ";
        $proses = mysqli_query($conn, $sql_absenMasuk);
        if ($proses) {
            echo 1;
        } else {
            echo "Notifikasi GAGAL : " . $sql_absenMasuk;
        }
        break;

    default:
        # code...
        break;
}
