<?php
if ($_SESSION["abs-status"] != "1") {
    header("Location: index.php");
} else {
?>
    <style>
        .ql-container {
            height: auto !important;
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

        <section>
            <?php
            // Panggil header
            require_once "components/admin/sub-navbar-admin.php";
            ?>
            <div class="col-12 mb-4 card">
                <div class="card-body" style="width:100%;">
                    <div class="row">
                        <div class="col">
                            <!-- Daftar Pengumuman -->
                            <div class="row" style="display: block;">
                                <table id="data_pengumuman" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Pengumuman</th>
                                            <th scope="col">Waktu / Tanggal</th>
                                            <th scope="col">Isi Pengumuman</th>
                                            <th scope="col">Admin</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
<?php
}
?>