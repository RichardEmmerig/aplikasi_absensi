<?php
$jammenit = date('H:i');
$getMonthName = date('F', strtotime(date("Y/m/d")));
$todaysDate = date("d/m/Y");
$todaysTgl = date("d");
$todaysThn = date("Y");
$todaysDay = date("l");

?>
<style>
    .button_absen {
        padding: 6px 24px;
        cursor: pointer;
        border: 0px;
        position: relative;
        transition: all .25s ease;
        background: #2c4755;
        color: #fff;
        overflow: hidden;
        border-radius: 4px;
    }

    .load {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: inherit
    }

    .load::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        border: 3px solid #fff;
        width: 20px;
        height: 20px;
        border-left: 3px solid transparent;
        border-bottom: 3px solid transparent;
        animation: loading1 1s ease infinite;
        z-index: 10
    }

    .load::before {
        content: '';
        position: absolute;
        border-radius: 50%;
        border: 3px dashed #fff;
        width: 20px;
        height: 20px;
        border-left: 3px solid transparent;
        border-bottom: 3px solid transparent;
        animation: loading1 2s linear infinite;
        z-index: 5
    }

    @keyframes loading1 {
        0% {
            transform: rotate(0deg)
        }

        100% {
            transform: rotate(360deg)
        }
    }

    .button_absen.active {
        transform: scale(.85)
    }

    .button_absen.activeLoading .loading {
        visibility: visible;
        opacity: 1
    }

    .button_absen .loading {
        opacity: 0;
        visibility: hidden
    }
</style>
<div class="px-5 mt-3">

    <!-- Quotes -->
    <div class="row mb-2">
        <div class="col">
            <?php
            include_once "components/quotes.php";
            ?>
        </div>
    </div>

    <!-- HEADER - ABSEN -->
    <div class="row mb-2">
        <div class="col-lg-7">
            <?php
            require_once "components/header.php";
            ?>
        </div>
        <div class="col-lg-5">
            <div class="row card-body m-1" style="background-color: #d4f0fc">
                <div class="col">
                    <h6><?php echo $todaysTgl . " " . $getMonthName . " " . $todaysThn; ?> </h6>
                    <h5>08:00 - 16:00 WIB</h5>
                    <small>Saatnya Absen</small>
                </div>
                <div class="col" style="display: flex; justify-content: end; align-items: center;">
                    <button class="button_absen">
                        Absen
                        <span class="load loading"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- AKTIFITAS -->
    <div class="row mb-2">
        <div class="col">
            <div class="row card-body m-1" style="background-color: #d4f0fc">
                <div class="col-lg-6">
                    <div class="row px-3">
                        <h5>Aktifitas hari ini</h5>
                    </div>
                    <div class="row px-3">
                        <button id="btn_tambah_aktifitas" class="btn btn-primary">Tambah Aktifitas</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="col my-3 py-3 px-3 text-center rounded text-white" style="background-color: #2596BE;">
                        <h5>Tidak ada tugas hari ini</h5>
                        <button id="btn_buat_tugas" class="btn btn-primary">Buat Tugas</button>
                    </div>
                    <div class="col my-3 py-3 px-3 text-center rounded text-white" style="background-color: #1A7485;">
                        <h5>Tidak ada Acara hari ini</h5>
                        <button id="btn_buat_acara" class="btn btn-primary">Buat Acara</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PENGUMUMAN - REKAN KERJA -->
    <div class="row mb-2">
        <div class="col">
            <div class="row card-body m-1" style="background-color: #d4f0fc">
                <h5 class="my-3 mx-3">Pengumuman</h5>
                <?php
                $sql = "SELECT * FROM t_pengumuman LIMIT 4";
                $proses = mysqli_query($conn, $sql);
                if ($proses) {
                    while ($fetching = mysqli_fetch_array($proses)) {
                        $isi_pengumuman = $fetching['isi_pengumuman'];
                        $output_isi_pengumuman = str_replace('<br>', ' ', $isi_pengumuman);
                        $clean_isi_pengumuman = strip_tags($output_isi_pengumuman);
                        $limited_isi_pengumuman = substr($clean_isi_pengumuman, 0, 40) . '...';
                ?>
                        <a href="index.php?menu=halaman_pengumuman" class="list-group-item list-group-item-action mb-3">
                            <div class="notification-info">
                                <div class="notification-list-user-img"><img src="https://img.icons8.com/ios-glyphs/512/megaphone.png" alt="" class="user-avatar-md"></div>
                                <div class="notification-list-user-block">
                                    <span class="notification-list-user-name"><?php echo $fetching['nama_pengumuman']; ?></span>
                                    <span><?php echo $limited_isi_pengumuman; ?></span><br>
                                    <span><?php echo $fetching['waktu_tgl_pengumuman']; ?></span>
                                </div>
                            </div>
                        </a>
                <?php
                    }
                }
                ?>
                <div class="buka_pengumuman">
                    <a href="">Buka semua Pengumuman</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="row card-body m-1" style="background-color: #d4f0fc">
                <div class="row my-3 mx-1">
                    <div class="col">
                        <h5>Rekan Kerja</h5>
                        <h6>Berikut daftar rekan kerja satu divisi <span class="notification-list-user-name">{divisi BD}</span></h6>
                    </div>
                </div>
                <div class="row mx-1">
                    <div class="col">
                        <i>NAMA | JABATAN | PENEMPATAN | NO HP | EMAIL</i><br>
                        <div class="col my-2 card">1</div>
                        <div class="col my-2 card">2</div>
                        <div class="col my-2 card">3</div>
                        <div class="col my-2 card">4</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>