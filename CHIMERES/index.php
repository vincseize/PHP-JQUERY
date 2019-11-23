<head>
  <title>PHP</title>
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

  function constructCard ($folder) {
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

  $dossier_images = 'images_folder';
  $directories = listFolders_FirstLevel($dossier_images);
?>

<section class="gallery">
        <div class="container">
          <div class="toolbar">
            <div class="search-wrapper">
              <input type="search" placeholder="Search">
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
  foreach($directories as $folder){
    $card = constructCard($folder);
  }
?>



<!-- 
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature1.jpg" alt="">
                <figcaption>
                  <p>green leafed trees</p>
                  <p>Photo by <a href="https://unsplash.com/@redcharlie" target="_blank">redcharlie</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature2.jpg" alt="">
                <figcaption>
                  <p>landscape photography of brown mountain</p>
                  <p>Photo by <a href="https://unsplash.com/@wilstewart3" target="_blank">Wil Stewart</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature3.jpg" alt="">
                <figcaption>
                  <p>blue starry night</p>
                  <p>Photo by <a href="https://unsplash.com/@ignitedit" target="_blank">Mark Basarab</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature4.jpg" alt="">
                <figcaption>
                  <p>aerial island and beaches</p>
                  <p>Photo by <a href="https://unsplash.com/@phiestyphung" target="_blank">Amanda Phung</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature5.jpg" alt="">
                <figcaption>
                  <p>forest pathway</p>
                  <p>Photo by <a href="https://unsplash.com/@elke_karin" target="_blank">Elke Karin Lugert</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature6.jpg" alt="">
                <figcaption>
                  <p>photo of two black, white, and orange koi fish</p>
                  <p>Photo by <a href="https://unsplash.com/@s_sagano" target="_blank">Sora Sagano</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature7.jpg" alt="">
                <figcaption>
                  <p>landscape photo of brown mountain</p>
                  <p>Photo by <a href="https://unsplash.com/@darrylbrian" target="_blank">Darryl Brian</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature8.jpg" alt="">
                <figcaption>
                  <p>moon illustration</p>
                  <p>Photo by <a href="https://unsplash.com/@metatzon297" target="_blank">Shin Roran</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature9.jpg" alt="">
                <figcaption>
                  <p>bird's eye view of body of water</p>
                  <p>Photo by <a href="https://unsplash.com/@timmossholder" target="_blank">Tim Mossholder</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature10.jpg" alt="">
                <figcaption>
                  <p>high-angle photography of rural area</p>
                  <p>Photo by <a href="https://unsplash.com/@stlobe" target="_blank">Steven Wong</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature11.jpg" alt="">
                <figcaption>
                  <p>silhoutte of mountains during sunset</p>
                  <p>Photo by <a href="https://unsplash.com/@von_co" target="_blank">Ivana Cajina</a></p>
                </figcaption>
              </figure>
            </li>
            <li>
              <figure>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash_nature12.jpg" alt="">
                <figcaption>
                  <p>bird's-eye view of mountain rang</p>
                  <p>Photo by <a href="https://unsplash.com/@leni_eleni" target="_blank">Elena Prokofyeva</a></p>
                </figcaption>
              </figure>
            </li>


            -->

          </ol>



        </div>
      </section>
      
      <footer>
        <div class="container">
            <small>Footer</small>
          <!-- <small>Made with <span>❤</span> by <a href="http://georgemartsoukos.com/" target="_blank">George Martsoukos</a></small> -->
        </div>
      </footer>