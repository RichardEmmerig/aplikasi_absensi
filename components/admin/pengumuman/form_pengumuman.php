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
                            <?php
                            if (isset($_GET['id_pengumuman'])) {
                                $sql = "SELECT * FROM t_pengumuman WHERE id_pengumuman = '" . $_GET["id_pengumuman"] . "' ";
                                $proses = mysqli_query($conn, $sql);
                                $rowcount = mysqli_num_rows($proses);
                                if ($rowcount != 0) {
                                    while ($fetching = mysqli_fetch_array($proses)) {
                                        $nama_pengumuman = $fetching['nama_pengumuman'];
                                        $waktu_tgl_pengumuman = $fetching['waktu_tgl_pengumuman'];
                                        $isi_pengumuman = $fetching['isi_pengumuman'];
                                        $id_pegawai = $fetching['id_pegawai'];
                                    }
                                }
                            }
                            $admin = (isset($id_pegawai)) ? $id_pegawai : $_SESSION["abs-id"];
                            ?>
                            <div class="row">
                                <input type="text" id="id_pegawai" value="<?php echo $admin; ?>" disabled hidden>
                                <div class="col">
                                    <input class="form-control" type="text" name="txtNama_pengumuman" id="nama_pengumuman" placeholder="Nama Pengumuman" value="<?php if (isset($nama_pengumuman)) echo $nama_pengumuman; ?>">
                                </div>
                                <div class="col">
                                    <input class="form-control" type="text" name="txtTgl_pengumuman" id="waktu_tgl_pengumuman" value="<?php if (isset($waktu_tgl_pengumuman)) echo $waktu_tgl_pengumuman; ?>" disabled>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <!-- QUILL JS -->
                                    <div id="isi_pengumuman">
                                        <!-- WADUH HADEUH -->
                                        <?php if (isset($isi_pengumuman)) {
                                            echo $isi_pengumuman;
                                        } else {
                                        ?>
                                            <h3><b>Pengumuman</b></h3>
                                            <br>
                                            <p>Diberitahukan...</p>
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Pengaturan tambahan
                                                    </button>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">Pengumuman Langsung :</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <span>Untuk (perorang)</span><br>
                                                            <select class="form-control" name="" id="pd_perorang">
                                                                <option value="">Nama Pegawai</option>
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <span>Untuk Divisi</span><br>
                                                            <select class="form-control" name="" id="pd_perdivisi">
                                                                <option value="">Divisi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col text-right">
                                    <button class="btn btn-success" id="tbh_pengumuman">Tambah Pengumuman</button>
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