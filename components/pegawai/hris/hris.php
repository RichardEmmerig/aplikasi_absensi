<?php
if ($_SESSION["abs-status"] != "3") {
    header("Location: index.php");
} else {
?>
    <div class="px-5 mt-3">

        <section>
            <?php
            // Panggil header
            require_once "components/under-cons.php";
            ?>
        </section>

    </div>
<?php
}
?>