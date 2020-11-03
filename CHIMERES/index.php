<?php
require 'indexHead.php';
?>

<body>



  <div class="container">

    <?php
      require 'indexNavbar.php';
    ?>

    <div class="divTotal2">
      <b>Total</b> <span class="total2"></span> <?php echo $total_items; ?>
    </div>

    <div class="content">

      <?php
      include('galleries.php');
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