<?php
require_once "library/lib_connection.php";
require_once "library/lib_config.php";
?>
<style>
    .section_data_pegawai,
    .section_data_absensi {
        opacity: 0.5;
        cursor: not-allowed;
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

                <div class="col-lg mb-2">
                    <h3>Cetak Data Absensi</h3>
                    <hr>
                    <table id="table_data_absensi_karyawan" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Tanggal Absensi</th>
                                <th scope="col">Masuk</th>
                                <th scope="col">Pulang</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Lokasi Masuk</th>
                                <th scope="col">Lokasi Pulang</th>
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
                                    $timestamp = strtotime($fetching['tgl_absen']);
                                    $get_day = date('l', $timestamp);
                                    if ($get_day == "Monday") {
                                        $set_day = "Senin";
                                    } else if ($get_day == "Tuesday") {
                                        $set_day = "Selasa";
                                    } else if ($get_day == "Wednesday") {
                                        $set_day = "Rabu";
                                    } else if ($get_day == "Thursday") {
                                        $set_day = "kamis";
                                    } else if ($get_day == "Friday") {
                                        $set_day = "Jumat";
                                    } else if ($get_day == "Saturday") {
                                        $set_day = "Sabtu";
                                    } else if ($get_day == "Sunday") {
                                        $set_day = "Minggu";
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
                                        <td scope="row"><?php echo $fetching['nama_lengkap']; ?></td>
                                        <td scope="row"><?php echo $set_day; ?></td>
                                        <td scope="row"><?php echo $fetching['tgl_absen']; ?></td>
                                        <td scope="row"><?php echo $fetching['absen_masuk']; ?></td>
                                        <td scope="row"><?php echo $fetching['absen_pulang']; ?></td>
                                        <td scope="row"><?php echo $fetching['absen_ket']; ?></td>
                                        <td scope="row"><?php echo $fetching['lat_masuk'] . " | " . $fetching['long_masuk'];; ?></td>
                                        <td scope="row"><?php echo $fetching['lat_pulang'] . " | " . $fetching['long_pulang'];; ?></td>
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