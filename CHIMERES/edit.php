<?php

  require 'indexHead.php';
  require 'session.php';


  // if(!isset($_SESSION['UserData']['Username']))
  // {
  //     $_SESSION['UserData']['Username']=$logins[$Username];
  //     header("location:index.php");
  //     exit;
  // }

?>


<body>
    <div class="container">

        <?php
        require 'indexNavbar.php';
        ?>

        <?php 
        if (isset($_SESSION['UserData']['Username'] )) {
          if (isset($_GET['g'] )) {
              $_SESSION["g"] = $_GET['g'];
          }
        }
//               echo $_SESSION["g"];
// exit;
          ?>


           
                <input class="BTlogout buttonForm" id="BTlogout" type="button" onclick="location.href='logout.php'" value="Logout"/>

      


        <div class="marginLoginEdit editDiv">
        <br><br>
          <span>

              <?php 

                  function deleteFolders($folders,$dg){
                    // global $_SESSION["PATH_GALLERIES"];

                    foreach ($folders as $folder) {
                      // $folder = 'img'.DIRECTORY_SEPARATOR.'galleries'.DIRECTORY_SEPARATOR.$dg;
                      $folder = $_SESSION["PATH_GALLERIES"].DIRECTORY_SEPARATOR.$dg;
                      
                      if (file_exists($folder)) {
                        $dirname = basename($folder);
                          rrmdir($folder);
                          // echo "<b>Gallery DELETED</b> > ".$dirname;
                          $msg = "Gallery DELETED > ".$dirname;
                      } else {
                          // folder not found.
                          // echo "folder not found > ".$folder;
                          $msg = "folder not found > ".$folder;
                      }
                    }
                    echo ("<script LANGUAGE='JavaScript'>
                    window.alert('".$msg."');
                    window.location.href='index.php';
                    </script>");
                }

                  if ($fileName == "edit.php"){

                      $files = [];

                      $gallery = $_GET['g']; 
                      $url = "indexGallery.php?g=".$gallery;
                      // echo "<b>GALLERY</b> | ".$gallery."<br><br>";
                      echo "<br><br>";
                      
                      if (isset($_GET['dg'])) {
                        $gallery = $_GET['g']; 
                        // echo $gallery;
                        $galleries = array();
                        array_push($galleries,$gallery);
                        deleteFolders($galleries,$gallery);
                        exit;
                      }


                      if (isset($_GET['g']) && !isset($_GET['d']) && !isset($_GET['i']) && !isset($_GET['add'])) {

                          $url = "index.php";
                          echo "EDIT gallery : ";
                          echo "<div>";
                          echo "<input type='text' id='oldGalleryName' name='oldGalleryName' ";
                          
                          echo "  value='".$gallery."' style='display:none'>";
                          echo "<br>";
                          echo "<input type='text' id='newGalleryName' name='newGalleryName' required ";
                          echo " minlength='1' maxlength='32' size='24' value='".$gallery."'>";
                          echo "</div>";
                          echo "<input type='button' id='BTEditGallery' value='CONFIRM New Name'>";
                      }
                      if (isset($_GET['i']) && !isset($_GET['d']) && isset($_GET['i'])) {
                          $gallery = $_GET['g']; 
                          $image = $_GET['i']; 
                          $img = $_SESSION["PATH_GALLERIES"] . DIRECTORY_SEPARATOR . $gallery . DIRECTORY_SEPARATOR .$image;
                          $icon = $_SESSION["PATH_GALLERIES"] . DIRECTORY_SEPARATOR . $gallery . DIRECTORY_SEPARATOR . $_SESSION["ICON_GALLERY"];
                          $styleBorder = "";

                          $result_images = array();
                          $result_images = compare_imgs($img,$icon,$result_images);
                          if (!empty($result_images)) {
                            $styleBorder = "border:2px solid black;";
                          }
                          // print_r($result_images);

                          echo "<b>EDIT image :</b><br>".$image;
                          echo "<br><br>";

                          echo "<div>";

                            echo "<img id='imgFolder' ";
                            echo "class='imgFolder' src='".$img."?nocache=".time()."' ";
                            echo "alt='".$image."' ";         
                            echo " style='max-height:45vh;".$styleBorder."'" ;
                            echo " >";
                            if (empty($result_images)) {
                              $urlOK = "edit.php?g=".$gallery."&i=".$image."&icon=1";
                              echo "<input type='button' id='BTIconGalleryChoose' value='CHOOSE AS GALLERY ICON' ";
                              echo "onclick=\"location.href='".$urlOK."'\"";
                              echo " class='BTIconGalleryChoose'" ;
                              echo " >";
                            }
                          echo "</div>";

                          echo "<br>";
                      }

                      if (isset($_GET['icon'])) {
                        $urlOK = "edit.php?g=".$gallery."&i=".$image;
                        $msg = "ICON MODIFIED";
                        $gallery = $_GET['g']; 
                        $image = $_GET['i']; 
                        changeIconThumbnails($gallery,$image);
                        echo ("<script LANGUAGE='JavaScript'>
                        window.alert('".$msg."');
                        window.location.href='".$urlOK."';
                        </script>");

                      } 


                      if (isset($_GET['g']) && !isset($_GET['i']) && isset($_GET['d'])) {
                        $files = [];
                        $gallery = $_GET['g']; 
                        $image = $_GET['d']; 
                        // $imagePath = 'img'.DIRECTORY_SEPARATOR.'galleries'.DIRECTORY_SEPARATOR.$_GET['g'].DIRECTORY_SEPARATOR.$image;
                        $imagePath = $_SESSION["PATH_GALLERIES"] . DIRECTORY_SEPARATOR.$gallery.DIRECTORY_SEPARATOR.$image;
                        $imagePathThumb = $_SESSION["PATH_GALLERIES"] . DIRECTORY_SEPARATOR.$gallery.DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$image;
                        
                        array_push($files,$imagePath,$imagePathThumb);

                        // print_r($files);
                        deleteFiles($files);
                        echo "DELETED OK | ".$image." "; 
                      }
                      
                      if (isset($_GET['g']) && isset($_GET['add'])) {
                        $url = "index.php";
                        require 'addGalleryForm.php';
                      } 




                      echo "<br><br>";
                      echo "<input type='button' id='backEdit' value='BACK' onclick=\"location.href='".$url."'\" class='backEdit'>";

                  }
              ?>

          <span>
        </div>



    </div>



</body>

<script type="text/javascript" src="js/navbar.js"></script>

</html>



