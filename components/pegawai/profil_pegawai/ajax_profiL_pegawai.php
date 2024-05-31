<?php
session_start();
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if (isset($_POST['fun'])) {
    if ($_POST['fun'] == "select2_divisi_profil") {
        $id_jabatan = $_POST['id_jabatan'];
        $sql = "SELECT * FROM t_divisi WHERE id_jabatan = '" . $id_jabatan . "' ";
        $proses = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($proses);
        if ($rowcount > 0) {
            while ($fetching = mysqli_fetch_array($proses)) {
                $data[] = array(
                    "id_divisi" => $fetching["id_divisi"],
                    "divisi" => $fetching["divisi"]
                );
            }
        }
        echo json_encode($data);
    }

    if ($_POST['fun'] == "edit_profil") {
        $id_pegawai = $_POST['id_pegawai'];
        // $username = $_POST['username']; - disabled
        $nama_lengkap = $_POST['nama_lengkap'];
        // $no_wa = $_POST['no_wa']; - disabled
        // $status_akun = $_POST['status_akun']; - disabled
        $alamat = $_POST['alamat'];
        $alamat_domisili = $_POST['alamat_domisili'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        // $divisi = $_POST['divisi'];
        // $select_divisi = $_POST['jabatan'];
        // $status_pekerja = $_POST['status_pekerja'];
        // $sql = "UPDATE t_pegawai SET username='" . $username . "', nama_lengkap = '" . $nama_lengkap . "', no_wa='" . $no_wa . "', status='" . $status_akun . "', alamat_ktp='" . $alamat . "', alamat_domisili='" . $alamat_domisili . "', tgl_lahir='" . $tgl_lahir . "', jenis_kelamin='" . $jenis_kelamin . "', id_jabatan='" . $select_jabatan . "', divisi='" . $divisi . "', status_pekerja='" . $status_pekerja . "' WHERE id_pegawai='" . $id_pegawai . "' ";
        $sql = "UPDATE t_pegawai SET nama_lengkap = '" . $nama_lengkap . "', alamat_ktp='" . $alamat . "', alamat_domisili='" . $alamat_domisili . "', tgl_lahir='" . $tgl_lahir . "', jenis_kelamin='" . $jenis_kelamin . "' WHERE id_pegawai='" . $id_pegawai . "' ";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            echo json_encode("1");
        } else {
            echo json_encode("0");
        }
    }
}
