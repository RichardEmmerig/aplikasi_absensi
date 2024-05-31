<?php
if ($_SESSION["abs-status"] != "1") {
    header("Location: index.php");
} else {
?>

    <div class="px-5 mt-3">

        <?php
        // Panggil header
        require_once "components/admin/sub-navbar-admin.php";
        ?>

        <section>
            <?php
            // Panggil header
            require_once "components/admin/sub-navbar-admin.php";
            ?>
            <div class="col-12 mb-4 card">
                <div class="card-body" style="width:100%;">

                    <!-- ====================================================== SEKSI BERISINYA ===== -->

                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="daId" id="daId">
                            <input class="form-control" type="text" name="daIsiQuotes" id="daIsiQuotes" placeholder="Isi Quotes" style="width: 100%;">
                        </div>
                        <div class="col">
                            <input class="btn btn-success" type="submit" id="btn_save_quotes" value="Simpan">
                            <input class="btn btn-primary" type="submit" id="btn_edit_save_quotes" value="Edit">
                        </div>
                    </div>

                    <hr>

                    <div class="row" style="display: block;">
                        <table id="table_data_quotes" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Isi Quotes</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = "SELECT * FROM t_quotes";
                                $proses = mysqli_query($conn, $sql);
                                $rowcount = mysqli_num_rows($proses);
                                if ($rowcount != 0) {
                                    while ($fetching = mysqli_fetch_array($proses)) { ?>
                                        <tr>
                                            <td scope="row"><?php echo $no; ?></td>
                                            <td scope="row"><?php echo $fetching['isi_quotes']; ?></td>
                                            <td scope="row">
                                                <button type="button" data-id="<?php echo $fetching['id_quotes']; ?>" data-isi_quotes="<?php echo $fetching['isi_quotes']; ?>" class="btn btn-primary btn_edit_quotes">Edit</button>
                                                <button type="button" data-id="<?php echo $fetching['id_quotes']; ?>" class="btn btn-danger btn_del_quotes">Delete</button>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td scope="row">Data Quotes Kosong</td>
                                        <td scope="row">Data Quotes Kosong</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ====================================================== SEKSI BERISINYA ===== -->

                </div>
            </div>

        </section>

    </div>
<?php
}
?>