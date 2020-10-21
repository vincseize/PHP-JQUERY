<?php
require 'indexHead.php';
$dossier_gallery = $_GET['g'];
$totImg = totImg($dossier_images.DIRECTORY_SEPARATOR.$dossier_gallery);
?>

<body>
    <div class="container">

        <?php
        require 'indexNavbar.php';
        ?>

        <div class="divTotal2">
            <b><?php echo $dossier_gallery; ?> | Total</b> <span class="total2"></span> <?php echo $totImg; ?>
        </div>

        <div class="content">

            <?php
            include('gallery.php');
            ?>

            <!-- <footer class="footerHome">footerHome</footer> -->
        </div>
    </div>

    <button onclick="topFunction()" id="scrollTopButton" class="scrollTopButton" title="Go to top">Top</button>

</body>

<script type="text/javascript" src="js/navbar.js"></script>
 
</html>