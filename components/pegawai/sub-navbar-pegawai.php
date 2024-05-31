<?php
$menu = $_GET['menu'];
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--secondary-color);">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <li class="nav-item <?php if ($menu == "absensi") echo "active"; ?>"><a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=absensi">Absen</a></li>
            <li class="nav-item <?php if ($menu == "dataabsensi") echo "active"; ?>"><a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=dataabsensi">Data Absensi</a></li>
            <li class="nav-item <?php if ($menu == "cetakpegawai") echo "active"; ?>"><a class="nav-link btn bg-transparent shadow-none" href="index.php?menu=cetakpegawai">Cetak Data Absensi</a></li>
        </ul>
    </div>
</nav>