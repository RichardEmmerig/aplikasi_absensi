<?php
$jammenit = date('H:i');
$getMonthName = date('F', strtotime(date("Y/m/d")));
$todaysDate = date("d/m/Y");
$todaysDay = date("l");

if ($_SESSION["abs-status"] != "3") {
    header("Location: index.php");
} else {
?>
    <style>
        #map {
            width: 100%;
            height: 350px;
        }
    </style>
    <div class="px-5 mt-3">

        <div class="row mb-2">
            <!-- HEADER - ABSEN -->
            <div class="col-lg-7">
                <?php
                require_once "components/header.php";
                ?>
            </div>
            <!-- Quotes -->
            <div class="col-lg-5">
                <?php
                include_once "components/quotes.php";
                ?>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <?php
                // Panggil header
                require_once "components/pegawai/sub-navbar-pegawai.php";
                ?>

                <div class="row mt-3">
                    <!-- KOTAK KALENDER -->
                    <div class="col-lg-3 mb-2">
                        <div id="calendar"></div>
                        <hr>
                        <div class="mt-4 px-4">
                            <p><span style="background-color: #ffc107; color: black; padding: 5px 8px; border-radius: 5px; font-weight: bold;">Kuning</span> : Belum absen pulang</p>
                            <p><span style="background-color: #CCF7FF; color: black; padding: 5px 8px; border-radius: 5px; font-weight: bold;">Biru</span> : Sudah Absen</p>
                        </div>
                    </div>

                    <!-- KOTAK DATA TOTAL KEHADIRAN -->
                    <div class="col-lg-9 mb-2">
                        <table id="table_data_absensi_alt" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr style="background-color: #d4f0fc">
                                    <th scope="col">No</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Tanggal Absensi</th>
                                    <th scope="col">Masuk</th>
                                    <th scope="col">Pulang</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = "SELECT * FROM t_absensi, t_pegawai WHERE t_pegawai.id_pegawai = t_absensi.id_pegawai AND t_absensi.id_pegawai = '" . $_SESSION["abs-id"] . "' ";
                                $proses = mysqli_query($conn, $sql);
                                $rowcount = mysqli_num_rows($proses);
                                if ($rowcount != 0) {
                                    while ($fetching = mysqli_fetch_array($proses)) {
                                        $getHari = date('l', strtotime($fetching['tgl_absen']));
                                        switch ($getHari) {
                                            case "Monday":
                                                $setHari = "Senin";
                                                break;
                                            case "Tuesday":
                                                $setHari = "Selasa";
                                                break;
                                            case "Wednesday":
                                                $setHari = "Rabu";
                                                break;
                                            case "Thursday":
                                                $setHari = "Kamis";
                                                break;
                                            case "Friday":
                                                $setHari = "Jumat";
                                                break;
                                            case "Saturday":
                                                $setHari = "Sabtu";
                                                break;
                                            case "Sunday":
                                                $setHari = "Minggu";
                                                break;
                                        }

                                        if ($fetching['absen_pulang'] == "00:00:00") {
                                ?>
                                            <tr class="bg-warning">
                                            <?php
                                        } else {
                                            ?>
                                            <tr>
                                            <?php
                                        }
                                            ?>
                                            <td scope="row"><?php echo $no; ?></td>
                                            <td scope="row"><?php echo $setHari; ?></td>
                                            <td scope="row"><?php echo $fetching['tgl_absen']; ?></td>
                                            <td scope="row"><?php echo $fetching['absen_masuk']; ?></td>
                                            <td scope="row"><?php echo $fetching['absen_pulang']; ?></td>
                                            <td scope="row"><?php echo $fetching['absen_ket']; ?></td>
                                            </tr>
                                        <?php
                                        $no++;
                                    }
                                } else {
                                        ?>
                                        <tr>
                                            <td scope="row" colspan="9">Data Absensi Kosong</td>
                                        </tr>
                                    <?php
                                }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
<?php
}
?>