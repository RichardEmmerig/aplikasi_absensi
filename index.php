<?php
require_once "library/lib_connection.php";
require_once "library/lib_config.php";
ob_start();
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no, viewport-fit=cover">
    <link rel="icon" type="image/x-icon" href="assets/icon/logo.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/date-1.2.0/fc-4.2.1/fh-3.3.1/kt-2.8.0/r-2.4.0/rg-1.3.0/rr-1.3.1/sc-2.0.7/sb-1.4.0/sp-2.1.0/sl-1.5.0/sr-1.2.0/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.2.5/build/vanilla-calendar.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/navbar_style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/@uvarov.frontend/vanilla-calendar@2.2.5/build/vanilla-calendar.min.js" defer></script>
    <title>Aplikasi Absensi</title>
</head>

<body>

    <div class="maintaince-update">
        <span>This Website renewing code structure in progress <a href="https://github.com/RichardEmmerig/aplikasi_absensi.git">Check github repo</a></span>
    </div>

    <?php
    if (isset($_GET["menu"])) {
        $menu = $_GET["menu"];
    } else {
        $menu = "";
    }

    if (isset($_SESSION['abs-id'])) {
        require_once "components/navbar.php";
    }

    ?>
    <div class="information_alert">
        <span id="information_alert_span">[pesan]</span>
        <div class="information_alert_close">
            <span>X</span>
        </div>
    </div>
    <?php

    switch ($menu) {

            // lupa password
        case 'lupapassword':
            require_once "components/under-cons.php";
            break;

            // dashboard admin
        case 'dashboard':
            require_once "components/admin/dashboard.php";
            break;
        case 'login_terbaru':
            require_once "components/admin/login_terbaru/login_terbaru.php";
            break;
        case 'data_pegawai':
            require_once "components/admin/data_pegawai/data_pegawai.php";
            break;
        case 'cetak_absen':
            require_once "components/admin/cetak_absen/cetak_absen.php";
            break;
        case 'pengumuman':
            require_once "components/admin/pengumuman/pengumuman.php";
            break;
        case 'form_pengumuman':
            require_once "components/admin/pengumuman/form_pengumuman.php";
            break;
        case 'divisi_posisi':
            require_once "components/admin/divisi_posisi/divisi_posisi.php";
            break;
        case 'divisi':
            require_once "components/admin/divisi/divisi.php";
            break;
        case 'posisi':
            require_once "components/admin/posisi/posisi.php";
            break;
        case 'quotes':
            require_once "components/admin/quotes/quotes.php";
            break;

            // absensi karyawan
        case 'pegawai':
            require_once "components/pegawai/pegawai/pegawai.php";
            break;
        case 'absensi':
            require_once "components/pegawai/absensi/absensi.php";
            break;
        case 'dataabsensi':
            require_once "components/pegawai/absensi/dataabsensi.php";
            break;
        case 'cetakpegawai':
            require_once "components/pegawai/absensi/cetakabsenkaryawan.php";
            break;
        case 'agenda':
            require_once "components/pegawai/agenda/agenda.php";
            break;
        case 'hris':
            require_once "components/pegawai/hris/hris.php";
            break;
        case 'pengumuman':
            require_once "components/pegawai/pengumuman/pengumuman.php";
            break;
        case 'halaman_pengumuman':
            require_once "components/pegawai/pengumuman/halaman_pengumuman.php";
            break;
        case 'profil_pegawai':
            require_once "components/pegawai/profil_pegawai/profil_pegawai.php";
            break;
        case 'pengaturan_pegawai':
            require_once "components/pegawai/pengaturan_pegawai/pengaturan_pegawai.php";
            break;

            // profil user
        case 'profil':
            require_once "components/under-cons.php";
            break;

            // logout
        case 'logout':
            require_once "components/logout.php";
            break;

        default:
            // always login
            require_once "components/login.php";
    }

    if (isset($_SESSION['abs-id'])) {
        require_once "components/footer.php";
    }

    ?>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- ✅ load jquery UI ✅ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Boostrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Datatables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/af-2.5.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/cr-1.6.1/date-1.3.0/fc-4.2.1/fh-3.3.1/kt-2.8.1/r-2.4.0/rg-1.3.0/rr-1.3.2/sc-2.1.0/sb-1.4.0/sp-2.1.1/sl-1.6.0/sr-1.2.1/datatables.min.js"></script>
    <!-- SELECT2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- QUILL JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Assets JS -->
    <script src="components/main.js"></script>

    <script src="components/admin/login_terbaru/dt_login_terbaru.js"></script>
    <script src="components/admin/data_pegawai/dt_data_pegawai.js"></script>
    <script src="components/admin/cetak_absen/dt_cetak_absen.js"></script>
    <script src="components/admin/pengumuman/dt_pengumuman.js"></script>
    <script src="components/admin/divisi_posisi/dt_divisi_posisi.js"></script>
    <script src="components/admin/divisi/dt_divisi.js"></script>
    <script src="components/admin/posisi/dt_posisi.js"></script>
    <script src="components/admin/quotes/dt_quotes.js"></script>

    <script src="components/pegawai/absensi/dt_absensi_pegawai.js"></script>
    <script src="components/pegawai/pegawai_main.js"></script>
    <script src="components/pegawai/profil_pegawai/dt_profil_pegawai.js"></script>

</body>

</html>