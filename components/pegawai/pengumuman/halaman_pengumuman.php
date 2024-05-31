<?php
if ($_SESSION["abs-status"] != "3") {
    header("Location: index.php");
} else {
?>
    <div class="px-5 mt-3">

        <div class="row mb-2">
            <!-- HEADER - ABSEN -->
            <div class="col-lg-7">
                <?php
                require_once "components/header.php";
                ?>
            </div>
            <!-- Quotes -->
            <div class="col-lg-5">
                <?php
                include_once "components/quotes.php";
                ?>
            </div>
        </div>

        <div class="card-body m-1 mb-4" style="background-color: #d4f0fc">
            <div class="row">
                <div class="col">
                    <h5>All Pengumuman</h5>
                </div>
            </div>
            <div class="row">
                <div class="col mt-2 mb-2">
                    <table id="table_pengumuman" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr style="background-color: #d4f0fc">
                                <th scope="col">No</th>
                                <th scope="col">Nama Pengumuman</th>
                                <th scope="col">Waktu/Tanggal</th>
                                <th scope="col">Isi Pengumuman</th>
                                <th scope="col">Untuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = "SELECT * FROM t_pengumuman";
                            $proses = mysqli_query($conn, $sql);
                            $rowcount = mysqli_num_rows($proses);
                            if ($rowcount != 0) {
                                while ($fetching = mysqli_fetch_array($proses)) {
                                    $isi_pengumuman = $fetching['isi_pengumuman'];
                                    $output_isi_pengumuman = str_replace('<br>', ' ', $isi_pengumuman);
                                    $clean_isi_pengumuman = strip_tags($output_isi_pengumuman);
                                    $limited_isi_pengumuman = substr($clean_isi_pengumuman, 0, 40) . '...';
                            ?>
                                    <tr id="<?php echo $fetching['id_pengumuman'] ?>" onclick="rowClicked('<?php echo $fetching['id_pengumuman'] ?>')">
                                        <td scope="row"><?php echo $no; ?></td>
                                        <td scope="row"><?php echo $fetching['nama_pengumuman']; ?></td>
                                        <td scope="row"><?php echo $fetching['waktu_tgl_pengumuman']; ?></td>
                                        <td scope="row"><?php echo $limited_isi_pengumuman; ?></td>
                                        <td scope="row"><?php echo $fetching['target']; ?></td>
                                    </tr><?php
                                        }
                                    }
                                            ?>
                        </tbody>
                        <script>
                            function rowClicked(row) {
                                console.log('Row clicked:', row);
                                // Perform any other action here, such as navigating to a new page
                            }
                        </script>
                    </table>
                </div>
            </div>
        </div>

    </div>
<?php
}
?>