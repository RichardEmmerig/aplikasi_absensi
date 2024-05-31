<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if (isset($_POST['fun'])) {
    if ($_POST['fun'] == "proses_simpan") {
        if (isset($_POST['nama_divisi'])) {
            $nama_divisi = $_POST['nama_divisi'];
            $sql = "INSERT INTO t_divisi (divisi) values ('" . $nama_divisi . "')";
            $proses = mysqli_query($conn, $sql);
            if ($proses) {
                echo 1;
            } else {
                echo "GAGAL : " . $sql;
            }
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
    } else if ($_POST['fun'] == "proses_edit") {
        if (isset($_POST['nama_divisi'])) {
            $id = $_POST['id'];
            $nama_divisi = $_POST['nama_divisi'];
            $sql = "UPDATE t_divisi SET divisi = '" . $nama_divisi . "' ";
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
        $sql = "SELECT * FROM t_divisi WHERE id_divisi = '" . $id . "' ";
        $proses = mysqli_query($conn, $sql);
        if ($proses) {
            $rowcount = mysqli_num_rows($proses);
            if ($rowcount > 0) {
                while ($fetching = mysqli_fetch_array($proses)) {
                    $data[] = array(
                        'id_divisi' => $fetching['id_divisi'],
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
