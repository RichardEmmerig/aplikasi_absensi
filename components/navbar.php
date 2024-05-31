<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white">
        <a class="navbar-brand" href="index.php">Absensi App SMI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item dropdown notification">
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                    <!-- BAGIAN NOTIFIKASI BOX -->
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
                            <div class="notification-title"> Notifikasi</div>
                            <div class="notification-list">
                                <div class="list-group">
                                    <?php
                                    $sql_notifikasi = "SELECT * FROM t_notifikasi ORDER BY waktu_tgl_notifikasi DESC;";
                                    $proses = mysqli_query($conn, $sql_notifikasi);
                                    if ($proses) {
                                        $rowcount = mysqli_num_rows($proses);
                                        if ($rowcount > 0) {
                                            $current_time = date('H:i:s'); // Current TIME pake php
                                            while ($fetching = mysqli_fetch_array($proses)) {
                                                $waktu_tgl_notifikasi = $fetching['waktu_tgl_notifikasi']; // Comot dari DB
                                                $setDateTime = new DateTime($waktu_tgl_notifikasi); // New Format using PHP
                                                $oldTime = $setDateTime->format('H:i:s'); // Ambil TIME Only dalam String
                                                $datetime1 = DateTime::createFromFormat('H:i:s', $current_time); // Format to Datetime php
                                                $datetime2 = DateTime::createFromFormat('H:i:s', $oldTime); // Format to Datetime php
                                                $time_diff = $datetime1->diff($datetime2); // Subtract Datetime
                                    ?>
                                                <a href="#" class="list-group-item list-group-item-action">
                                                    <div class="notification-info">
                                                        <div class="notification-list-user-img"><img src="https://img.icons8.com/ios-filled/512/delete-user-male.png" alt="" class="user-avatar-md"></div>
                                                        <div class="notification-list-user-block">Anda <span class="notification-list-user-name"><?php echo $fetching['isi_notifikasi']; ?></span>
                                                            <div class="notification-date">
                                                                <?php
                                                                // echo $time_diff->format('%H:%I:%S');
                                                                if ($time_diff->format('%H') == 00 && $time_diff->format('%I') == 00) {
                                                                    echo $time_diff->format('%S') . " Detik yang lalu";
                                                                } elseif ($time_diff->format('%H') == 00) {
                                                                    echo $time_diff->format('%I:%S') . " Menit yang lalu";
                                                                } else {
                                                                    echo $time_diff->format('%H:%I:%S') . " yang lalu";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <a href="" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="" alt="" class=""></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Tidak Ada Notifikasi</span>
                                                    </div>
                                                </div>
                                            </a>
                                    <?php
                                        }
                                    } else {
                                        echo "Notifikasi GAGAL : " . $sql_notifikasi;
                                    }
                                    ?>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="list-footer"> <a href="#">Lihat Semua Notifikasi</a></div>
                        </li>
                    </ul>
                </li>
                <!-- HAMBURGER MENU -->
                <?php
                if ($_SESSION['abs-status'] == 1) {
                ?>
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="index.php?menu=dashboard"><i class="fas fa-home mr-2"></i>Dashboard</a>
                            <a class="dropdown-item" href="index.php?menu=data_pegawai"><i class="fas fa-users mr-2"></i>Data Pegawai</a>
                            <a class="dropdown-item" href="index.php?menu=cetak_absen"><i class="fas fa-database mr-2"></i>Data Absensi</a>
                            <a class="dropdown-item" href="index.php?menu=divisi"><i class="fas fa-sitemap mr-2"></i>Jabatan dan Divisi</a>
                            <a class="dropdown-item" href="index.php?menu=pengumuman"><i class="fas fa-bullhorn mr-2"></i>Pengumuman</a>
                            <a class="dropdown-item" href="index.php?menu=quotes"><i class="fas fa-cog mr-2"></i>Pengaturan Website</a>
                            <!-- <div class="conntection-footer"><a href="#">More</a></div> -->
                        </div>
                    </li>
                <?php
                } else if ($_SESSION['abs-status'] == 3) {
                ?>
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                            <a class="dropdown-item" href="index.php?menu=pegawai"><i class="fas fa-home mr-2"></i>Dashboard Pegawai</a>
                            <a class="dropdown-item" href="index.php?menu=absensi"><i class="fas fa-user mr-2"></i>Absen</a>
                            <a class="dropdown-item" href="index.php?menu=agenda"><i class="fas fa-calendar mr-2"></i>Agenda</a>
                            <a class="dropdown-item" href="index.php?menu=halaman_pengumuman"><i class="fas fa-bullhorn mr-2"></i>Pengumuman</a>
                            <a class="dropdown-item" href="index.php?menu=hris"><i class="fas fa-id-card mr-2"></i>HRIS</a>
                            <!-- <div class="conntection-footer"><a href="#">More</a></div> -->
                        </div>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="https://img.icons8.com/dusk/100/000000/user-female-circle.png" alt="" class="user-avatar-md rounded-circle"></a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink3">
                        <!-- <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name"><?php echo $_SESSION["abs-nama"]; ?></h5>
                        </div> -->
                        <a class="dropdown-item" href="index.php?menu=profil_pegawai"><i class="fas fa-user mr-2"></i>Profil</a>
                        <a class="dropdown-item" href="index.php?menu=pengaturan_pegawai"><i class="fas fa-cog mr-2"></i>Pengaturan</a>
                        <a class="dropdown-item" href="index.php?menu=logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>