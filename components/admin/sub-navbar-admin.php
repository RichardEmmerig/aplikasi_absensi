<?php
$menu = $_GET['menu'];
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--secondary-color);">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <?php
            if (isset($_GET['menu'])) {
                $menu = $_GET['menu'];
            } else {
                $menu = "";
            }

            switch ($menu) {
                case 'data_pegawai':
                case "cetak_absen":
            ?>
                    <li class="nav-item <?php if ($menu == "data_pegawai") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=data_pegawai">Lihat Data Pegawai</a>
                    </li>
                    <li class="nav-item <?php if ($menu == "cetak_absen") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=cetak_absen">Cetak Data Absensi</a>
                    </li>
                <?php
                    break;

                case "pengumuman":
                case "form_pengumuman":
                ?>
                    <li class="nav-item <?php if ($menu == "pengumuman") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=pengumuman">Pengumuman</a>
                    </li>
                    <li class="nav-item <?php if ($menu == "form_pengumuman") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=form_pengumuman">Tambah Pengumuman</a>
                    </li>
                <?php
                    break;

                case "divisi":
                case "posisi":
                ?>
                    <li class="nav-item <?php if ($menu == "divisi") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=divisi">Konfigurasi Devisi</a>
                    </li>
                    <li class="nav-item <?php if ($menu == "posisi") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=posisi">Konfigurasi Posisi</a>
                    </li>
                <?php
                    break;

                case "quotes":
                ?>
                    <li class="nav-item <?php if ($menu == "quotes") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=quotes">Konfigurasi Quotes</a>
                    </li>
                <?php
                    break;

                default:
                ?>
                    <li class="nav-item <?php if ($menu == "login_terbaru") echo "active"; ?>">
                        <a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=login_terbaru">Login Terbaru</a>
                    </li>
            <?php
                    break;
            }
            ?>
        </ul>
    </div>
</nav>