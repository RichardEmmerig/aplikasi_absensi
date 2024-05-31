<?php
require_once "../../../library/lib_connection.php";
require_once "../../../library/lib_config.php";

if ($_POST["fun"] == "simpan") {
    $daIsiQuotes = $_POST['daIsiQuotes'];
    $sql = "INSERT INTO t_quotes (isi_quotes) values ('" . $daIsiQuotes . "' )";
    $proses = mysqli_query($conn, $sql);
    if ($proses) {
        echo 1;
    } else {
        echo "GAGAL : " . $sql;
    }
}

if ($_POST["fun"] == "proses_edit") {
    $id = $_POST['id'];
    $daIsiQuotes = $_POST['daIsiQuotes'];
    $sql = "UPDATE t_quotes SET isi_quotes = '" . $daIsiQuotes . "' WHERE id_quotes = '" . $id . "' ";
    $proses = mysqli_query($conn, $sql);
    if ($proses) {
        echo 1;
    } else {
        echo "GAGAL : " . $sql;
    }
}

if ($_POST["fun"] == "proses_hapus") {
    $id = $_POST['id'];
    $sql = "DELETE FROM t_quotes WHERE id_quotes = '" . $id . "' ";
    $proses = mysqli_query($conn, $sql);
    if ($proses) {
        echo 1;
    } else {
        echo "GAGAL : " . $sql;
    }
}
