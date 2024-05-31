<?php
require_once "library/lib_connection.php";
require_once "library/lib_config.php";
?>
<div class="px-5 mt-3">

    <style>
        /*  FORCE UP CSS  */
        button.dt-button,
        div.dt-button,
        a.dt-button,
        input.dt-button {
            border-radius: 2px;
            color: white;
            background-color: blue;
        }

        button.dt-button,
        div.dt-button,
        a.dt-button,
        input.dt-button {
            border: 1px solid #666;
            background-color: lightblue;
            color: black;
        }
    </style>

    <?php
    // Panggil header
    require_once "components/header.php";
    ?>

    <section>
        <?php
        // Panggil header
        require_once "components/admin/sub-navbar-admin.php";
        ?>
        <div class="col-12 mb-4 card">
            <div class="card-body" style="width:100%;">
                <!-- ====================================================== SEKSI BERISINYA ===== -->

                <!-- COL PILIH DATA PEGAWAI -->
                <div class="row">
                    <div class="col-2 mr-1">
                        <div class="row">
                            <h5>Filter Per Divisi</h5>
                        </div>
                        <div class="row card card-body">
                            <select class="form-control" id="select2_divisi_absensi" name="select_jabatan" style="width: 100% !important;">
                                <?php
                                $data = [];
                                $sql = "SELECT * FROM t_divisi";
                                $proses = mysqli_query($conn, $sql);
                                $rowcount = mysqli_num_rows($proses);
                                if ($rowcount > 0) {
                                    while ($fetching = mysqli_fetch_array($proses)) {
                                ?>
                                        <option value="<?php echo $fetching['id_divisi']; ?>"><?php echo $fetching['divisi']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="col">
                            <div class="row">
                                <h5>Pilih Pegawai</h5>
                            </div>
                            <div class="row">
                                <table id="table_pilih_pegawai" class="table table-striped table-bordered" style="clear: none !important; width: 100% !important;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">No Whatsapp</th>
                                            <th scope="col">Divisi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row well input-daterange">
                    <div class="col">
                        <h5>Tanggal Pertama</h5>
                        <input class="form-control datepicker" type="text" name="initial_date" id="initial_date" placeholder="yyyy-mm-dd" style="height: 40px;" />
                    </div>
                    <div class="col">
                        <h5>Tanggal Kedua</h5>
                        <input class="form-control datepicker" type="text" name="final_date" id="final_date" placeholder="yyyy-mm-dd" style="height: 40px;" />
                    </div>

                    <input hidden type="text" id="no_wa"> <!-- wa for calling data cetak -->
                    <div class="col">
                        <button class="btn btn-success" type="submit" name="filter" id="filter">
                            <i class="fa fa-filter"></i> Filter
                        </button>
                    </div>

                    <div class="col-sm-12 text-danger" id="error_log"></div>
                </div>

                <hr>

                <table id="fetch_users" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
                </table>

            </div>
            <!-- ====================================================== SEKSI BERISINYA ===== -->

        </div>
</div>

</section>

</div>