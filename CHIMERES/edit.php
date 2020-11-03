<?php
  require 'indexHead.php';
?>

<?php 

  // if(isset($_POST['Submit'])){
  //     $logins = array('root' => 'aaa','username1' => 'password1','username2' => 'password2');
  //     $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
  //     $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
  //     if (isset($logins[$Username]) && $logins[$Username] == $Password){
  //         /* Success: Set session variables and redirect to Protected page  */
  //         $_SESSION['UserData']['Username']=$logins[$Username];
  //         header("location:index.php");
  //         exit;
  //     } else {
  //     /*Unsuccessful attempt: Set error message */
  //     $msg="<span style='color:red'>Invalid Login</span>";
  //     }
  // }

?>

<body>
    <div class="container">

        <?php
        require 'indexNavbar.php';
        ?>

        <?php if (isset($_SESSION['UserData']['Username'] )) {
          if (!isset($_GET['g'] )) {
          
          ?>
           
                <input class="BTlogout buttonForm" id="BTlogout" type="button" onclick="location.href='logout.php'" value="Logout"/>

        <?php } } ?>


        <div class="marginLoginEdit editDiv">
        <br><br>
          <span>

              <?php 


                  function rrmdir($dir) {
                    if (is_dir($dir)) {
                      $objects = scandir($dir);
                      foreach ($objects as $object) {
                        if ($object != "." && $object != "..") {
                          if (filetype($dir."/".$object) == "dir") 
                            rrmdir($dir."/".$object); 
                          else unlink   ($dir."/".$object);
                        }
                      }
                      reset($objects);
                      rmdir($dir);
                    }
                  }

                  function deleteFiles($files){
                      foreach ($files as $file) {
                        if (file_exists($file)) {
                            unlink($file);
                        } else {
                            // File not found.
                            echo "File not found > ".$file;
                        }
                      }
                  }

                  function deleteFolders($folders,$dg){
                    
                    foreach ($folders as $folder) {
                      $folder = 'img'.DIRECTORY_SEPARATOR.'galleries'.DIRECTORY_SEPARATOR.$dg;
                      
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
                          echo "<input type='button' id='BTEditGallery' value='CONFIRM New Name' classDES='backEdit'>";
                      }
                      if (isset($_GET['i']) && !isset($_GET['d']) && isset($_GET['i'])) {
                          $image = $_GET['i']; 
                          echo "EDIT image : ".$image;
                      }

                      if (isset($_GET['g']) && !isset($_GET['i']) && isset($_GET['d'])) {
                        // $gallery = $_GET['g']; 
                        $image = $_GET['d']; 
                        $imagePath = 'img'.DIRECTORY_SEPARATOR.'galleries'.DIRECTORY_SEPARATOR.$_GET['g'].DIRECTORY_SEPARATOR.$image;
                        array_push($files,$imagePath);
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



