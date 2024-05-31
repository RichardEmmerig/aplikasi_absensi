<div class="row card-body m-1" style="background-color: #d4f0fc">
    <?php
    $sql = "SELECT * FROM `t_quotes` ORDER BY RAND() LIMIT 1;";
    $proses = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($proses);
    if ($rowcount != 0) {
        while ($fetching = mysqli_fetch_array($proses)) {
            echo ' " ' . $fetching["isi_quotes"] . ' " ';
        }
    } else {
        echo "Tidak Ada Quotes Untuk Hari Ini :(";
    }
    ?>
</div>