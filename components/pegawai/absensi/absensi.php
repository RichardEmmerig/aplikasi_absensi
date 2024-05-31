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
            height: 300px;
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
                <div class="row mb-4">
                    <div class="col-lg-6 mb-2">
                        <div id="map">map</div>
                        <div>
                            <span>Lat : <span id="setLat">x</span> |</span>
                            <span>Long : <span id="setLong">x</span> |</span>
                            <span>Kota : <span id="setKota">x</span> |</span>
                            <span>Kelurahan : <span id="setKelurahan">x</span></span>
                        </div>
                    </div>

                    <div class="col-lg-6 pt-2 border-top">
                        <div>
                            <h5>Jam : <?php echo $jammenit; ?></h5>
                            <span>Hari/Tanggal : <?php echo $todaysDay . "/" . $todaysDate; ?> </span><br>
                        </div>
                        <div class="mt-3">
                            <input name="daLat" id="daLat" type="hidden">
                            <input name="daLong" id="daLong" type="hidden">
                            <?php
                            $masuk_kantor = "11";
                            $jam_skrng = date('H');
                            $sql = "SELECT * FROM t_absensi, t_pegawai WHERE t_pegawai.id_pegawai = t_absensi.id_pegawai AND t_absensi.id_pegawai = '" . $_SESSION["abs-id"] . "' AND tgl_absen = '" . date("Y/m/d") . "' ";
                            $proses = mysqli_query($conn, $sql);
                            $rowcount = mysqli_num_rows($proses);
                            if ($rowcount == 0) {
                                if ($jam_skrng > $masuk_kantor + 1) { ?>
                                    <!-- <span>Anda Masuk Kesiangan</span><br>
                                <span>Silahkan Berikan Alasan Keterlambatan anda : </span><br>
                                <textarea class="form-control" placeholder="..."></textarea>
                                <i>Fitur belum berjalan</i><br> -->
                                <?php
                                }
                                ?>
                                <input name="daId" id="daId" type="hidden" value="<?php echo $_SESSION["abs-id"]; ?>">
                                <input name="daDate" id="daDate" type="hidden" value="<?php echo date("Y/m/d"); ?>">
                                <input name="daTime" id="daTime" type="hidden" value="<?php echo $jammenit; ?>">
                                <button id="btn_asben" type="button" class="btn btn-primary">Absen</button>
                                <?php
                                ?>
                                <?php
                            } else {
                                while ($fetching = mysqli_fetch_array($proses)) {
                                    if ($fetching['absen_ket'] != "" && $fetching['absen_pulang'] != "00:00:00") { ?>
                                        <span>Anda Sudah Absen Pulang Untuk Hari Ini</span>
                                    <?php
                                    } else {
                                    ?>
                                        <textarea id="daKegiatan" placeholder="Kegiatan Hari Ini"></textarea><br>
                                        <input name="daId2" id="daId2" type="hidden" value="<?php echo $_SESSION["abs-id"]; ?>">
                                        <input name="daDate2" id="daDate2" type="hidden" value="<?php echo date("Y/m/d"); ?>">
                                        <input name="daTime2" id="daTime2" type="hidden" value="<?php echo $jammenit; ?>">
                                        <button id="btn_asben2" type="button" class="btn btn-primary">Absen Pulang</button>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
}
?>