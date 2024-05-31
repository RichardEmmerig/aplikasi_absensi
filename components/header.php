<?php
$jam = date("H");
?>

<div class="row card-body m-1" style="background-color: #d4f0fc">
    <div class="col-sm-2">
        <img src="assets/img/user.png" alt="foto" width="110px">
    </div>
    <div class="col-lg">
        <h2>
            <span class="font-weight-light small">
                <?php
                if ($jam < 12) echo "Selamat Pagi";
                else if ($jam < 16) echo "Selamat Siang";
                else echo "Selamat Malam";
                ?>
            </span>
            <br>
            <b id="nama_akun_header"><?php echo $_SESSION["abs-nama"]; ?></b>
        </h2>
        <?php
        if (isset($_GET["menu"]) and $_GET["menu"] != "profil_pegawai") {
            if ($_SESSION["abs-foto"] != "") {
                echo "<a href=\"\">Ganti foto profil</a>";
            } else {
                echo "Anda belum memasang foto profil, <b><a href=\"index.php?menu=profil_pegawai\">Pasang foto profil sekarang</a></b>";
            }
        }
        ?>
    </div>
</div>