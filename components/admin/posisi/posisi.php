<?php
if ($_SESSION["abs-status"] != "1") {
    header("Location: index.php");
} else {
?>

    <div class="px-5 mt-3">

        <?php
        // Panggil header
        require_once "components/header.php";
        ?>

        <section>
            <?php
            // Panggil header
            require_once "components/admin/sub-navbar-admin.php";
            ?>
            <div class="col mb-4 card">
                <div class="card-body">

                    <h4 class="mb-2">Berikut Data Table <b>Posisi</b></h4>
                    <div class="modal fade" id="modal_posisi" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title">Tambah Posisi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <input id="daFormdirect" name="daFormdirect" type="text" value="proses_simpan" style="display: none;">
                                        <input id="daId" name="daId" type="text" style="display: none;">
                                        <div class=" form-group input-group">
                                            <select class="form-control" id="select2_posisi" name="select2_posisi" style="width: 100% !important;" required>
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
                                                } else {
                                                    ?>
                                                    <div class="col">
                                                        Tidak ada Data Jabatan
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class=" form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class='far fa-address-card'></i></span>
                                            </div>
                                            <input id="daNama_posisi" name="Nama Posisi" class="form-control" placeholder="Nama Posisi" type="text" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="button" id="btn_save_posisi" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- BUTTON MODAL PEGAWAI BARU -->
                    <div class="mb-3" id="btn_tambah_pengguna">
                        <button type="button" class="btn text-white" id="btn_posisi_baru" data-toggle="modal" data-target="#modal_posisi" style="background-color: var(--secondary-color);">Tambah Posisi</button>
                    </div>

                    <!-- TABLE DATA PEGAWAI -->
                    <table id="table_data_posisi" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = "SELECT * FROM t_posisi, t_divisi WHERE t_posisi.id_divisi = t_divisi.id_divisi";
                            $proses = mysqli_query($conn, $sql);
                            $rowcount = mysqli_num_rows($proses);
                            if ($rowcount != 0) {
                                while ($fetching = mysqli_fetch_array($proses)) { ?>
                                    <tr>
                                        <td scope="row"><?php echo $no; ?></td>
                                        <td scope="row"><?php echo $fetching['divisi']; ?></td>
                                        <td scope="row"><?php echo $fetching['posisi']; ?></td>
                                        <td scope="row">
                                            <button type="button" data-id="<?php echo $fetching['id_posisi']; ?>" class="btn btn-primary my-2 btn_edit_posisi">Edit</button>
                                            <button type="button" data-id="<?php echo $fetching['id_posisi']; ?>" class="btn btn-danger my-2 btn_delete_posisi">Delete</button>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td>Data Kosong</td>
                                    <td>Data Kosong</td>
                                    <td>Data Kosong</td>
                                    <td>Data Kosong</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- ====================================================== SEKSI BERISINYA ===== -->

                </div>
            </div>


            <!-- ====================================================== SEKSI BERISINYA ===== -->

        </section>

    </div>
<?php
}
?>