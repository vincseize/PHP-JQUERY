<?php
require 'indexHead.php';
// $_SESSION["GALLERY_CHOSEN"] = $_GET['g'];
$dossier_gallery = $_GET['g'];
$totImg = totImg($dossier_images.DIRECTORY_SEPARATOR.$dossier_gallery);

// echo $_SESSION["GALLERY_CHOSEN"];
// exit;

// $dossier_gallery = $_GET['g'];

?>

<body>

    <div class="container">

        <?php
        require 'indexNavbar.php';
        ?>

        <div class="divTotal2">
            <b>GALLERY : <?php echo $dossier_gallery; ?> | Total</b> <span class="total2"></span> <?php echo $totImg; ?>
        </div>

        <div class="content">

            <?php
            include('gallery.php');
            ?>

            <!-- <footer class="footerHome">footerHome</footer> -->
        </div>
    </div>

    <?php if ($total_items > 1 ) { ;?>
        <button onclick="topFunction()" id="scrollTopButton" class="scrollTopButton" title="Go to top">Top</button>
    <?php } ?>


</body>

<script type="text/javascript" src="js/navbar.js"></script>
 
</html>