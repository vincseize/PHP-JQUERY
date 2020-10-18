<html>
<head>
  <title>GRID FLEX</title>
</head>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<?php

function is_dir_empty($dir) {
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      closedir($handle);
      return FALSE;
    }
  }
  closedir($handle);
  return TRUE;
}

  function listFolders_FirstLevel ($folder) {
    $folders = glob($folder . '/*' , GLOB_ONLYDIR);
    return $folders;
  }

  
  function listImages ($folder) {
      // $images[] = '';
      foreach(glob($folder.'/*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}',GLOB_BRACE) as $file){
        $images[] =  basename($file);
      }
    
    return $images;
  }

  function constructCardHomeFolder ($folder) {
    if (!is_dir_empty($folder)) {
      $images = listImages ($folder);
      $dirname = basename(dirname($folder."/".$images[0]) . PHP_EOL);
      echo "<li>";
        echo "<figure>";
          echo "<img src='".$folder."/".$images[0]."' alt=''>";
          echo "<figcaption>";
            echo "<p>".$dirname."</p>";
            echo "<p><a href='#'>Photo by </a></p>";
          echo "</figcaption>";
        echo "</figure>";
      echo "</li>";
    }
  }

  function gridFolder($dossier_images){
    if (!is_dir_empty($dossier_images)) {
      $images = listImages ($dossier_images);
      foreach($images as $img){
        echo "<li>";
        echo "<figure>";
          echo "<img src='".$dossier_images."/".$img."' alt=''>";
          echo "<figcaption>";
            echo "<p>".$img."</p>";
            echo "<p><a href='#'>Photo by </a></p>";
          echo "</figcaption>";
        echo "</figure>";
      echo "</li>";
      }
    }
  }

  function gridFolders($directories){
    foreach($directories as $folder){
      $card = constructCardHomeFolder($folder);
    }
  }

  $dossier_images = 'images_folder';
  $directories = listFolders_FirstLevel($dossier_images);

?>
<body>
<section class="gallery">
        <div class="container">
          <div class="toolbar">
            <div class="search-wrapper">
              <input id="searchField" type="search" placeholder="Search">
              <div class="counter">
                Total: <span></span>
              </div>
              <div id="CANCEL" class="counter">
                <a href="#"><span class="cancel" >CANCEL</span></a>
              </div>
            </div>
            <ul class="view-options">
              <li class="zoom">
                <input type="range" min="180" max="380" value="280">
              </li>
              <li class="show-grid active">
                <button disabled>
                  <img src="img/grid-view.svg" alt="grid view">  
                </button>
              </li>
              <li class="show-list">
                <button>
                  <img src="img/list-view.svg" alt="list view">  
                </button>
              </li>
            </ul>
          </div>
          <ol class="image-list grid-view">

<?php
  gridFolder($dossier_images);
  // gridFolders($directories);
?>

          </ol>


        </div>
      </section>
      
      <footer>
        <div class="container">
            <small>Footer</small>
          <!-- <small>Made with <span>❤</span> by <a href="http://georgemartsoukos.com/" target="_blank">George Martsoukos</a></small> -->
        </div>
      </footer>


      <script>
        window.onload = function() {
          var tf = document.getElementById('searchField');
          var onKeyChange = function textChange() {
            if (tf.value === "") {
              console.log('t');
              location.reload();
            }
          }
          tf.addEventListener('keyup', onKeyChange);
          tf.addEventListener('search', onKeyChange);
        }
      </script>
</body>
</html>