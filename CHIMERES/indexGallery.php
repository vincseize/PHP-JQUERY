<?php
require 'indexHead.php';
$dossier_gallery = $_GET['g'];
$totImg = totImg($dossier_images.DIRECTORY_SEPARATOR.$dossier_gallery);
?>

<body>








<!-- OVERLAY  -->
<!-- 
<style>
.overlay_gallery {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    min-width:100% !important;
    width:100% !important;
    height:100% !important;
    border:0px;
    background: #000;
    /*opacity: 0.8;*/
    /*filter: alpha(opacity=0);*/
    z-index: 20000;
}

/*#close_overlay_gallery {
    position: absolute;
    right: 16px;
    top: 16px;
    z-index: 20001;
}*/


#close_overlay_gallery {
/*  background: #3498db;*/
/*  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);*/
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #222;
  font-size: 16px;
  padding: 5px 5px 5px 5px;
  text-decoration: none;


    position: absolute;
    right: 6px;
    top: 6px;
  z-index: 20001;
}

#close_overlay_gallery:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}



#box_shadow:hover {
  cursor:pointer;
  border: solid 1px;
   border-color: #C44068;
}

.box_shadow_selected {
  /*cursor:pointer;*/
  border: solid 2px;
   border-color: #C44068;
}

</style> -->










<!-- <a href="#" id="close_overlay_gallery" class="close_overlay_gallery" style="display:none;">X</a>
<iframe id="overlay_gallery" class="overlay_gallery" src="" style="display:block;"  frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%">iframe</iframe>


 -->



























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



<script>

jQuery(document).ready(function(){

// const overlay_gallery = document.querySelector(".overlay_gallery");

//         let url = 'img/galleryPlayer/index.html';
//         // $('#overlay_gallery').load("pageToLoadTest.htm");
//         $("#overlay_gallery").attr("src", url);


//         window.onload = maxWindow();

// function maxWindow() {
//     window.moveTo(0, 0);

//     if (document.all) {
//         top.window.resizeTo(screen.availWidth, screen.availHeight);
//     }

//     else if (document.layers || document.getElementById) {
//         if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) {
//             top.window.outerHeight = screen.availHeight;
//             top.window.outerWidth = screen.availWidth;
//         }
//     }
// }

// function calcHeight(iframeElement){
//     // $("#overlay_gallery").attr("src", url);
//     var the_height=  iframeElement.contentWindow.document.body.scrollHeight;
//     iframeElement.height=  the_height;
// }


});

</script>



 
</html>