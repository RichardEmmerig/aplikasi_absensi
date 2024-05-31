<?php
if (isset($_SESSION['abs-id'])) {
    switch ($_SESSION['abs-status']) {
            // GOD Entering The Arena
        case '1':
            header("Location: index.php?menu=dashboard");
            break;

            // HRD Only
        case '2':
            header("Location: index.php?menu=dashboard");
            break;

            // Karyawan Only
        case '3':
            header("Location: index.php?menu=pegawai");
            break;

            // TIM IT
        case '4':
            header("Location: index.php?menu=pegawai");
            break;

        default:
            // none
    }
}

$ket = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $sql = "SELECT * FROM t_pegawai WHERE username = '" . $_POST["username"] . "' and password = '" . $_POST["password"] . "'";
    $proses = mysqli_query($conn, $sql);

    if ($proses) {
        $fetching = mysqli_fetch_array($proses);
        $_SESSION["abs-id"] = $fetching["id_pegawai"]; // ID Akun
        $_SESSION["abs-username"] = $fetching["username"]; // Username Akun
        $_SESSION["abs-nama"] = $fetching["nama_lengkap"]; // Nama Akun
        $_SESSION["abs-status"] = $fetching["status"]; // Status Akun / Pegawai / Admin
        $_SESSION["abs-foto"] = $fetching["foto"]; // Status Akun / Pegawai / Admin

        header("Location: index.php"); // Send back to INDEX
    } else {
        $ket = "Username atau Password anda salah.";
    }
    echo $ket;
} else {
?>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="wrap-login">
                    <img class="img" src="assets/images/login_cover.jpg" alt="smi-front" style="width: 300px; margin: auto;">
                    <div class=" login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="text-center w-100">
                                <h3 class="mb-4">Welcome to<br>Aplikasi Absensi<br>Richard Emmerig</h3>
                            </div>
                        </div>
                        <form action="" class="signin-form" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Masukan Username atau No HP">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="index.php?menu=lupapassword">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>