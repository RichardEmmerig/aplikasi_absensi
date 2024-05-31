<?php
if ($_SESSION["abs-status"] != "1") {
    header("Location: index.php");
} else {
?>

    <div class="px-5 mt-3">

        <?php
        // Panggil halaman Quotes
        require_once "components/quote_block.php";
        ?>

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

                    <h3>Configurasi Status Akun</h3>
                    <span><i>Hanya Untuk Admin</i></span>

                    <hr>

                    <div class="row" style="display: block;">
                        <table id="table_status_akun" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
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