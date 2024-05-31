<?php
$servername = "localhost";
// $username = "selar353_absensi_smi";
// $password = "";
// $dbname = "selar353_smi_absensi_app";
$username = "root";
$password = "";
$dbname = "smi_absensi_app";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
} else {
	// echo "Connected successfully";
}
