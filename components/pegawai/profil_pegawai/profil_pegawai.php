<?php
if (isset($_POST["btn_edit_profil"])) {
    $username = $_POST["username"];
    $nama_lengkap = $_POST["nama_lengkap"];
    $no_wa = $_POST["no_wa"];
    $nama_status = $_POST["nama_status"];
    $alamat_ktp = $_POST["alamat_ktp"];
    $alamat_domisili = $_POST["alamat_domisili"];
    $tgl_lahir = $_POST["tgl_lahir"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $select_jabatan = $_POST["select_jabatan"];
    $select_divisi = $_POST["select_divisi"];
    $status_pekerja = $_POST["status_pekerja"];
    $sql = "UPDATE t_pegawai SET username='" . $username . "', nama_lengkap = '" . $nama_lengkap . "', and no_wa='" . $no_wa . "', status='" . $nama_status . "', alamat_ktp='" . $alamat_ktp . "', alamat_domisili='" . $alamat_domisili . "', tgl_lahir='" . $tgl_lahir . "', jenis_kelamin='" . $jenis_kelamin . "', id_jabatan='" . $select_jabatan . "', divisi='" . $select_divisi . "', status_pekerja='" . $status_pekerja . "' ";
    $proses = mysqli_query($conn, $sql);
    if ($proses) {
        echo "berhasil update";
    } else {
        echo "gagal update";
    }
} else {
?>
    <style>
        #overlay_informasi {
            visibility: hidden;
            background-color: cyan;
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 10;
        }
    </style>

    <div class="px-5 mt-3">

        <div id="overlay_informasi" class="px-3 py-2">
            [informasi]
        </div>

        <?php
        // Panggil header
        require_once "components/header.php";
        ?>

        <div class="row mb-2">
            <div class="row card-body m-1" style="background-color: #d4f0fc">
                <div class="col-lg-12">
                    <h4>Info Profil</h4>
                </div>
                <?php
                $sql = "SELECT *, DATE_FORMAT(t_pegawai.tgl_lahir, '%d-%m-%Y') AS tanggal_lahir FROM t_pegawai, t_divisi, t_hirarki_akun WHERE t_pegawai.divisi = t_divisi.id_divisi AND t_hirarki_akun.id_hirarki_akun = t_pegawai.status AND id_pegawai = '" . $_SESSION["abs-id"] . "' ";
                $proses = mysqli_query($conn, $sql);

                if ($proses) {
                    while ($fetching = mysqli_fetch_array($proses)) { ?>
                        <div class="col-sm-4">Username</div>
                        <div class="col-sm-6"><b><?php echo $fetching["username"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Nama Lengkap</div>
                        <div class="col-sm-6"><b><?php echo $fetching["nama_lengkap"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">No WhatsApp</div>
                        <div class="col-sm-6"><b><?php echo $fetching["no_wa"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Status Akun</div>
                        <div class="col-sm-6"><b><?php echo $fetching["nama_status"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Alamat</div>
                        <div class="col-sm-6"><b><?php echo $fetching["alamat_ktp"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Alamat Domisili</div>
                        <div class="col-sm-6"><b><?php echo $fetching["alamat_domisili"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Tanggal Lahir</div>
                        <div class="col-sm-6"><b><?php echo $fetching["tanggal_lahir"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Jenis Kelamin</div>
                        <div class="col-sm-6"><b><?php echo $fetching["jenis_kelamin"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Divisi</div>
                        <div class="col-sm-6"><b><?php echo $fetching["divisi"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-sm-4">Status Pekerja</div>
                        <div class="col-sm-6"><b><?php echo $fetching["status_pekerja"]; ?></b></div>
                        <!-- --- -->
                        <div class="col-lg-12 mt-3">
                            <button id="btn_form_edit_profil" class="btn btn-secondary" data-toggle="modal" data-target="#form_profil">Edit informasi profil</button>
                        </div>
                <?php
                    }
                } else {
                    echo "GAGAL FETCH USER";
                }
                ?>
            </div>
        </div>
        <div class="col-lg-6">
            <h4>Info Tim</h4>
            <div class=" row">
                <div class="col">
                    <div class="col">Pimpinan</div>
                    <div class="col">[nama_pimpinan]</div>
                </div>
                <div class="col">
                    <div class="col">Rekan Kerja</div>
                    <div class="col">[rekan_kerja]</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PROFIL -->
    <form methon="POST">
        <div class="modal" id="form_profil" tabindex="-1" role="dialog" aria-labelledby="form_profil" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Informasi Profil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <?php
                        $sql = "SELECT * FROM t_pegawai, t_divisi, t_hirarki_akun WHERE t_pegawai.divisi = t_divisi.id_divisi AND t_hirarki_akun.id_hirarki_akun = t_pegawai.status AND id_pegawai = '" . $_SESSION["abs-id"] . "' ";

                        if ($proses) {
                            while ($fetching = mysqli_fetch_array($proses)) { ?>
                                <div class="row py-1">
                                    <input class="form-control" id="id_pegawai" name="id_pegawai" type="text" value="<?php echo $fetching["id_pegawai"]; ?>" disabled hidden>
                                    <div class="col">Username</div>
                                    <div class="col"><input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?php echo $fetching["username"]; ?>" disabled></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Nama Lengkap</div>
                                    <div class="col"><input class="form-control" id="nama_lengkap" name="nama_lengkap" type="text" placeholder="Nama Lengkap" value="<?php echo $fetching["nama_lengkap"]; ?>"></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">No WhatsApp</div>
                                    <div class="col"><input class="form-control" id="id_wa" name="no_wa" type="text" placeholder="No WhatsApp" value="<?php echo $fetching["no_wa"]; ?>" disabled></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Status Akun</div>
                                    <div class="col"><input class="form-control" id="nama_status" name="nama_status" type="text" placeholder="Status Akun" value="<?php echo $fetching["nama_status"]; ?>" disabled></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Alamat</div>
                                    <div class="col"><input class="form-control" id="alamat" name="alamat" type="text" placeholder="Alamat" value="<?php echo $fetching["alamat_ktp"]; ?>"></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Alamat Domisili</div>
                                    <div class="col"><input class="form-control" id="alamat_domisili" name="alamat_domisili" type="text" placeholder="Alamat Domisili" value="<?php echo $fetching["alamat_domisili"]; ?>"></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Tanggal Lahir</div>
                                    <div class="col"><input class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir" type="date" value="<?php echo $fetching["tgl_lahir"]; ?>"></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Jenis Kelamin</div>
                                    <div class="col">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" id="jenis_kelamin1" name="jenis_kelamin" type="radio" <?php echo ($fetching["jenis_kelamin"] == "Laki laki") ? 'checked' : ''; ?>>Laki-laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" id="jenis_kelamin2" name="jenis_kelamin" type="radio" <?php echo ($fetching["jenis_kelamin"] == "Perempuan") ? 'checked' : ''; ?>>Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Divisi</div>
                                    <div class="col">
                                        <i id="i-divisi-jabatan">pilih jabatan terlebih dahulu</i>
                                        <select class="select2_divisi_profil" id="select_divisi" name="select_divisi" style="width: 100% !important;" disabled>
                                            <option value="0">Tidak ada divisi</option>
                                            <?php
                                            $sql_divisi = "SELECT * FROM t_divisi WHERE id_jabatan = '" . $fetching["id_jabatan"] . "' ";
                                            echo $sql;
                                            $proses_divisi = mysqli_query($conn, $sql_divisi);
                                            $rowcount = mysqli_num_rows($proses);
                                            if ($rowcount > 0) {
                                                while ($fetching_divisi = mysqli_fetch_array($proses_divisi)) {
                                                    if ($fetching["divisi"] == $fetching_divisi['divisi']) { ?>
                                                        <option value="<?php echo $fetching_divisi['id_divisi']; ?>" selected><?php echo $fetching_divisi['divisi']; ?></option>
                                                    <?php
                                                    } else { ?>
                                                        <option value="<?php echo $fetching_divisi['id_divisi']; ?>"><?php echo $fetching_divisi['divisi']; ?></option>
                                                <?php
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <div class="col">
                                                    Tidak ada Data Jabatan Akun
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">Status Pekerja</div>
                                    <div class="col">
                                        <select class="form-control" id="status_pekerja" name="status_pekerja" disabled>
                                            <option <?php echo ($fetching["status_pekerja"] == "Tetap") ? 'selected' : ''; ?>>Tetap</option>
                                            <option <?php echo ($fetching["status_pekerja"] == "Kontrak") ? 'selected' : ''; ?>>Kontrak</option>
                                            <option <?php echo ($fetching["status_pekerja"] == "Magang") ? 'selected' : ''; ?>>Magang</option>
                                            <option <?php echo ($fetching["status_pekerja"] == "Tidak Aktif") ? 'selected' : ''; ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="btn_edit_profil" type="button" class="btn btn-success">Edit Profil</button>
                    </div>
            <?php
                            }
                        }
            ?>
                </div>
            </div>
        </div>
    </form>

    </div>
<?php
}
?>