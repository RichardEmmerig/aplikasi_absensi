<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if (isset($_POST['fun'])) {
    if ($_POST['fun'] == "proses_simpan") {
        if (isset($_POST['nama_posisi'])) {
            $id_divisi = $_POST['id_divisi'];
            $nama_posisi = $_POST['nama_posisi'];
            $sql = "INSERT INTO t_posisi (id_divisi, posisi) values ('" . $id_divisi . "', '" . $nama_posisi . "')";
            $proses = mysqli_query($conn, $sql);
            if ($proses) {
                echo 1;
            } else {
                echo "GAGAL : " . $sql;
            }
        }
    } else if ($_POST['fun'] == "proses_hapus") {
        $id = $_POST['id'];
        $sql = "DELETE FROM t_posisi WHERE id_posisi = '" . $id . "' ";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            echo 1;
        } else {
            echo "GAGAL : " . $sql;
        }
    } else if ($_POST['fun'] == "proses_edit") {
        if (isset($_POST['nama_posisi'])) {
            $id_posisi = $_POST['id_posisi'];
            $nama_posisi = $_POST['nama_posisi'];
            $sql = "UPDATE t_posisi SET posisi = '" . $nama_posisi . "' WHERE id_posisi = '" . $id_posisi . "' ";
            $proses = mysqli_query($conn, $sql);
            if ($proses) {
                echo 2;
            } else {
                echo "GAGAL : " . $sql;
            }
        }
    } else if ($_POST['fun'] == "proses_get_edit") {
        $id = $_POST['id'];
        $data = [];
        $sql = "SELECT * FROM t_posisi WHERE id_posisi = '" . $id . "' ";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            $rowcount = mysqli_num_rows($proses);
            if ($rowcount > 0) {
                while ($fetching = mysqli_fetch_array($proses)) {
                    $data[] = array(
                        'id_posisi' => $fetching['id_posisi'],
                        'posisi' => $fetching['posisi'],
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
