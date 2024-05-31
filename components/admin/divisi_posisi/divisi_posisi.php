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
                <div class="row card-body">
                    <div class="col-2"><!-- BAGIAN SHORTCUT BUTTON -->
                        <div class="col">
                            <div class="row my-2"><a class="btn" id="btn_conf_divisi" style="cursor:pointer;">Konfigurasi Divisi</a></div>
                            <div class="row my-2"><a class="btn" id="btn_conf_posisi" style="cursor:pointer;">Konfigurasi Posisi</a></div>
                        </div>
                    </div>

                    <div class="col card"><!-- BAGIAN SHORTCUT BUTTON -->
                        <div id="sect-divisi">
                            <?php
                            // Panggil divisi
                            require_once "components/admin/divisi/divisi.php";
                            ?>
                        </div>
                        <div id="sect-posisi">
                            <?php
                            // Panggil divisi
                            require_once "components/admin/posisi/posisi.php";
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ====================================================== SEKSI BERISINYA ===== -->

        </section>

    </div>
<?php
}
?>