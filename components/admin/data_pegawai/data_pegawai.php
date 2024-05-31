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

                <!-- MODAL TAMBAH PEGAWAI BARU -->
                <?php

                if (isset($_GET['id_pegawai'])) {
                ?>

                    <div class="d-flex flex-row">
                        <?php
                        $sql = "SELECT * FROM t_pegawai, t_divisi WHERE t_pegawai.id_pegawai = '" . $_GET['id_pegawai'] . "' AND t_pegawai.divisi = t_divisi.id_divisi;";
                        $proses = mysqli_query($conn, $sql);
                        while ($row_panggil = mysqli_fetch_assoc($proses)) {
                            $getNamaLengkap = $row_panggil['nama_lengkap'];
                        ?>
                            <div>
                                <div class="col"><span>Nama Lengkap</span></div>
                                <div class="col"><span>Alamat</span></div>
                                <div class="col"><span>Alamat Domisili</span></div>
                                <div class="col"><span>No WhatsApp</span></div>
                                <div class="col"><span>Tanggal Lahir</span></div>
                                <div class="col"><span>jenis_kelamin</span></div>
                                <div class="col"><span>Status Pekerja</span></div>
                                <div class="col"><span>Divisi</span></div>
                            </div>
                            <div>
                                <div class="col"><span>: <?php echo $row_panggil['nama_lengkap'] ?></span></div>
                                <div class="col"><span>: <?php echo $row_panggil['alamat_ktp'] ?></span></div>
                                <div class="col"><span>: <?php echo $row_panggil['alamat_domisili'] ?></span></div>
                                <div class="col"><span>: <?php echo $row_panggil['no_wa'] ?></span></div>
                                <div class="col"><span>: <?php echo $row_panggil['tgl_lahir'] ?></span></div>
                                <div class="col"><span>: <?php echo $row_panggil['jenis_kelamin'] ?></span></div>
                                <div class="col"><span>: <?php echo $row_panggil['status_pekerja'] ?></span></div>
                                <div class="col"><span>: <?php echo $row_panggil['divisi'] ?></span></div>
                            </div>
                            <div class="ml-auto">
                                <img src="assets/img/user.png" alt="foto" width="px">
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="d-flex flex-row">

                    </div>
                    <div class="row">
                        <div class="col mt-3 text-center">
                            <h3>Berikut data kehadiran <span id="placehoder_nama_pegawai"><?php echo $getNamaLengkap; ?></span></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div id="calendar" style="pointer-events: none; opacity: 0.4;"></div>
                            <hr>
                            <div class="mt-4 px-4">
                                <p><span class="text-warning">Kuning</span> : Belum absen pulang</p>
                                <p><span class="text-primary">Biru</span> : Sudah Absen</p>
                            </div>
                        </div>

                        <div class="col-lg">
                            <input type="text" id="id_pegawai" value="<?php echo $_GET["id_pegawai"]; ?>" hidden>
                            <table id="table_data_absensi_perorang" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
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

                    </div>



                <?php
                } else {

                ?>

                    <div class="modal fade" id="modal_pegawai" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pegawai Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <input id="daFormdirect" name="daFormdirect" type="text" value="proses_simpan" style="display: none;">
                                        <input id="daId" name="daId" type="text" style="display: none;">
                                        <div class=" form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class='far fa-address-card'></i></span>
                                            </div>
                                            <input id="daNama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" type="text" required>
                                        </div>
                                        <div class=" form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class='fas fa-home'></i></span>
                                            </div>
                                            <input id="daAlamat_ktp" name="alamat_ktp" class="form-control" placeholder="Alamat KTP" type="text">
                                        </div>
                                        <div class=" form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class='fas fa-map-marker-alt'></i></span>
                                            </div>
                                            <input id="daAlamat_domisili" name="alamat_domisili" class="form-control" placeholder="Alamat Saat Ini" type="text">
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                            </div>
                                            <input id="daNo_wa" name="no_wa" class="form-control" placeholder="No Telp / WA" type="number" onchange="changeValueUsername(this.value)" required>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                                            </div>
                                            <input id="daTgl_lahir" name="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" type="date">
                                        </div>
                                        <div class="form-group input-group border rounded px-3 py-3">
                                            <span class="mr-3">Jenis Kelamin : </span>
                                            <div class=" form-check mr-3">
                                                <input id="daJK1" class="form-check-input" type="radio" name="daJK" id="exampleRadios1" value="option1">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Laki laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input id="daJK2" class="form-check-input" type="radio" name="daJK" id="exampleRadios1" value="option1">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Perempuan
                                                </label>
                                            </div>
                                        </div>
                                        <?php
                                        $sql = "SELECT * FROM t_divisi";
                                        $rs_fetch_divisi = mysqli_query($conn, $sql);
                                        ?>
                                        <div class="form-group input-group">
                                            <div class="col-lg-12">
                                                <h6>Divisi</h6>
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                            </div>
                                            <select class="form-control" id="select2_posisi_pegawai" name="select2_posisi_pegawai">
                                                <!-- id_jb_pgw -->
                                                <?php
                                                while ($dataDivisi = mysqli_fetch_array($rs_fetch_divisi)) {
                                                    echo "<option value=" . $dataDivisi['id_divisi'] . ">" . $dataDivisi['divisi'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class='far fa-list-alt'></i></span>
                                            </div>
                                            <select id="daStatus_pekerja" name="status_pekerja" class="form-control">
                                                <option>Tetap</option>
                                                <option>Kontrak</option>
                                                <option>Magang</option>
                                                <option>Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="col-lg-12">
                                                <h6>Status Akun</h6>
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class='far fa-list-alt'></i></span>
                                            </div>
                                            <select id="daStatus_pekerja" name="status_pekerja" class="form-control">
                                                <option value="4">User/Pegawai</option>
                                                <option value="3">PGA</option>
                                                <option value="2">IT</option>
                                                <option value-"1">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="col-lg-12">
                                                <h6>Status Pekerja</h6>
                                            </div>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                            </div>
                                            <input id="daUsername" name="username" class="form-control" placeholder="Username" type="text" readonly>
                                        </div>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                            </div>
                                            <input id="daPassword" name="password" class="form-control" placeholder="smi168" value="smi168" type=" password" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="button" id="btn_save_pegawai" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON MODAL PEGAWAI BARU -->
                    <div class="mb-3" id="btn_tambah_pengguna">
                        <button type="button" class="btn text-white" id="btn_user_baru" data-toggle="modal" data-target="#modal_pegawai" style="background-color: var(--secondary-color);">Tambah Pengguna Baru</button>
                    </div>

                    <!-- TABLE DATA PEGAWAI -->
                    <table id="table_data_pegawai" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Level Akun</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">No Whatsapp</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                    </table>

                <?php
                }
                ?>

                <!-- ====================================================== SEKSI BERISINYA ===== -->

            </div>
        </div>

    </section>

</div>