<?php
if ($_SESSION["abs-status"] != "1") {
    header("Location: index.php");
} else {
?>

    <div class="thisContainer mt-3">

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

                    <div class="row" style="display: block;">
                        <table id="data_login_terbaru" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jam Masuk</th>
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