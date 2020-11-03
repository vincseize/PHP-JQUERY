<?php
// $NEW_IMAGICK = new Imagick();
// $GLOBALS["NEW_IMAGICK"] = new Imagick();

$PATH_GALLERIES = "img" . DIRECTORY_SEPARATOR . "galleries";
$ICON_DEFAULT_GALLERY = "___default_icon.jpg";
$ICON_GALLERY = "___icon.jpg";

// function commpressIMAGICK($src) 
// {
//   $img = new Imagick();
//   // $img = $GLOBALS["NEW_IMAGICK"];
//   $img->readImage($src);
//   $img->setImageCompression(Imagick::COMPRESSION_JPEG);
//   $img->setImageCompressionQuality(90);
//   $img->stripImage();
//   $img->writeImage($dest); 
//   $img->clean();
// }

function compressGD($src, $dest , $quality) 
{

// //usage
// $compressed = compressGD('boy.jpg', 'destination.jpg', 50);
// //usage jpg to png and preserve transparency
// imagepng($image, 'destination.png', 5);

	$info = getimagesize($src);
	if ($info['mime'] == 'image/jpeg') 
	{
		$image = imagecreatefromjpeg($src);
	}
	elseif ($info['mime'] == 'image/gif') 
	{
		$image = imagecreatefromgif($src);
	}
	elseif ($info['mime'] == 'image/png') 
	{
		$image = imagecreatefrompng($src);
	}
	else
	{
		die('Unknown image file format');
	}
	imagejpeg($image, $dest, $quality);
	return $dest;
}

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

  function listFolders_FirstLevel($folder) {
    $folders = glob($folder . DIRECTORY_SEPARATOR .'*' , GLOB_ONLYDIR);
    return $folders;
  }

  function listImages($folder,$withDefaultIcon,$by="alphabetical") {
      global $ICON_GALLERY;
      global $ICON_DEFAULT_GALLERY;
      $images = array();
      foreach(glob($folder.DIRECTORY_SEPARATOR.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}',GLOB_BRACE) as $file){
        if($withDefaultIcon==true){
          $images[] =  basename($file);
        }
        if($withDefaultIcon==false){
          if(basename($file)!=$ICON_DEFAULT_GALLERY){
            $images[] =  basename($file);
          }
        }
      }

    //order images
    $images = orderImages($by,$images);

    return $images;
  }

  function orderImages($by,$images){
    global $ICON_GALLERY;
    global $ICON_DEFAULT_GALLERY;
    
    
    // print_r($images);
    // echo "<br>";
    if($by="alphabetical"){
      unset($images[array_search($ICON_GALLERY, $images)]);
      array_unshift($images, $ICON_GALLERY);
    }

    
    // print_r($images);
    // exit;

    return $images;
  }

  function getDossierName ($dirname) {
    // $dirname = basename(dirname($folder.DIRECTORY_SEPARATOR.$images[0]) . PHP_EOL);

    $dPath = preg_split("/\//", $dirname);
    $dossierName = strval(end($dPath));
    $dossierName = str_replace(PHP_EOL, '', $dossierName);
    return $dossierName;
  }

  function constructCardHomeFolder ($folder) {
    // echo basename($folder);
    // exit;
    // // "img/galleries/".$folder."/icon.jpg"
    // // $folder = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $folder);
    
    // // echo basename(($folder.DIRECTORY_SEPARATOR) . PHP_EOL);
    // echo $dirname;
    // exit;


    if (is_dir_empty($folder)) {
      $dirname = basename($folder);
      createBlankImage($dirname);
      // echo $dirname;
      // exit;
    }

    if (!is_dir_empty($folder)) {

      $folder = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $folder);

      $images = listImages($folder,true);

      $dirname = basename(dirname($folder.DIRECTORY_SEPARATOR.$images[0]) . PHP_EOL);

      // $dPath = preg_split("/\//", $dirname);
      // $dossierName = strval(end($dPath));
      // $dossierName = str_replace(PHP_EOL, '', $dossierName);

      $dossierName = getDossierName($dirname);
      
      $infos = readInfos($folder,$dossierName);
    
      echo "<li>";


      echo "<div style='position:relative;'>";
          echo "<figure>";

          if (isset($_SESSION['UserData']['Username'] )) {
              echo "<img id='iconEditG' class='iconEdit iconEditG' src='img/icon_edit.png' data-gallery='".$dossierName."'>";
              echo "<button id='iconDeleteG' class='iconDelete iconDeleteG' data-gallery='".$dirname."'><b>X</b></button>";
          }


                echo "<img id='imgFolder' ";
                echo "class='imgFolder' src='".$folder.DIRECTORY_SEPARATOR.$images[0]."' ";
                echo "alt='".$images[0]."' ";
                echo "onclick='imgFolder(\"$dossierName\");'>";
                echo "<figcaption class='figcaption'>";
                    echo "<p class='figcaptionP'>";
                    echo $infos;
                    echo "</p>";
                    // echo "<p><a href='#'>Photo by </a></p>";
              echo "</figcaption>";
          echo "</figure>";

        echo "</div>";

      echo "</li>";
    }
  }

  function gridFolder($dossier_images){
    // $images = array();
    global $ICON_DEFAULT_GALLERY;
    global $ICON_GALLERY;



    if (!is_dir_empty($dossier_images)) {
      $images = listImages ($dossier_images,false);
      


      foreach($images as $img){
        $imgName = $img;
        $dirname = basename(dirname($dossier_images.DIRECTORY_SEPARATOR.$img) . PHP_EOL);

        echo "<li>";

        echo "<div style='position:relative;'>";
            echo "<figure>";
if (isset($_SESSION['UserData']['Username']) && $img!=$ICON_DEFAULT_GALLERY && $img!=$ICON_GALLERY) {
    echo "<img id='iconEditI' class='iconEdit iconEditI' data-gallery='".$dirname."' data-image='".$img."' src='img/icon_edit.png'>";
    echo "<button id='iconDeleteI' class='iconDelete iconDeleteI' data-gallery='".$dirname."' data-image='".$img."'><b>X</b></button>";
}
if ($img==$ICON_DEFAULT_GALLERY || $img==$ICON_GALLERY) {
  $imgName = "Gallery Icon";
}

              echo "<img src='".$dossier_images.DIRECTORY_SEPARATOR.$img."' alt=''>";
              echo "<figcaption class='figcaption'>";
                echo "<p class='figcaptionM'>".$imgName."</p>";
                // echo "<p><a href='#'>Photo by </a></p>";
              echo "</figcaption>";
            echo "</figure>";
        echo "</div>";
      echo "</li>";
      }
    }

  }

  function gridFolders($directories){
    global $ICON_DEFAULT_GALLERY;
    foreach($directories as $folder){
      if (!file_exists($folder.DIRECTORY_SEPARATOR.$ICON_DEFAULT_GALLERY)) {   
        $dirname = basename($folder);
        createBlankImage($dirname);
        // echo $folder;
        // echo "<br>";
        // echo $dirname;
        // echo "<br>";
        // echo basename($folder);
        // exit;
      }
      $card = constructCardHomeFolder($folder);
    }
  }

  function countDirectories_FirstLevel($folder){
    $total_items = 0;
    if (!is_dir_empty($folder)) {
        $total_items = count( glob($folder.DIRECTORY_SEPARATOR."*", GLOB_ONLYDIR) );
    }
    return $total_items;
  }

  function totImg($folder){
    global $ICON_GALLERY;
    global $ICON_DEFAULT_GALLERY;
    $imagecount = count(glob($folder.DIRECTORY_SEPARATOR.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}',GLOB_BRACE));
    
    $dirname = basename($folder);
    $arrayImages = array();
    if(!in_array($ICON_GALLERY,$arrayImages) && $imagecount>1){
      $arrayImages = listImages($folder,false);
        create_IconGallery($dirname,$arrayImages[0]);
    }
    
    /////////////////////////////////////////

    $arrayImages = array();
    foreach (glob($folder.DIRECTORY_SEPARATOR.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}', GLOB_BRACE) as $filename) { 
        if (!strstr($filename, $ICON_DEFAULT_GALLERY) && !strstr($filename, $ICON_GALLERY)) {
          array_push($arrayImages,$filename);
        }
    }

    $imagecount = count($arrayImages);

    return $imagecount;
  }

  function create_IconGallery($folder,$default_icon){
    global $PATH_GALLERIES;
    global $ICON_GALLERY;

    $folder_path = $PATH_GALLERIES . DIRECTORY_SEPARATOR . $folder;
    $new = $folder_path . DIRECTORY_SEPARATOR . $default_icon;
    $old = $folder_path . DIRECTORY_SEPARATOR . $ICON_GALLERY;
    // echo $new;
    // echo "<br>";
    // echo $old;
    copy($new, $old);
  }

  function readInfos($folder,$dossierName){
    
    $infos = "";
    $totImg = totImg($folder);
    
    // $infos = $dossierName . "<font color=white> | " . $totImg . "</font>";
    
    $totImg = "<span class='totImgSpan'>" . $totImg . "</span>";
    $infos .= $totImg.$dossierName;
    // $infos = $dossierName.$totImg;
    $infosTxt = $folder.DIRECTORY_SEPARATOR."infos.txt";
    if (file_exists($infosTxt)) { 
        $myfile = fopen($infosTxt, "r"); // or die("Unable to open file!");
        // $infos = fread($myfile,filesize($infosTxt));
        // $infos = "";
        while(! feof($myfile))
        {
            $infos .= "<p class='figcaptionP'>" .fgets($myfile). "</p>";
        }
        fclose($myfile);
    } 
    // $infos .= $infos.$totImg;
    return $infos;
  }

  function createBlankImage($folder){
    
    global $PATH_GALLERIES;
    global $ICON_DEFAULT_GALLERY;
    // echo "<br>";
    // echo $PATH_GALLERIES;
    // echo "<br>";
    // echo $folder;
    // echo "<br>";
    // echo $PATH_GALLERIES . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $ICON_DEFAULT_GALLERY;
    // exit;
    $img = imagecreatetruecolor(640, 480);
    $bg = imagecolorallocate ( $img, 255, 255, 255 );
    imagefilledrectangle($img,0,0,640,480,$bg);
    imagejpeg($img,$PATH_GALLERIES.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$ICON_DEFAULT_GALLERY,100);
    // imagejpeg($img,"myimg.jpg",100);
    sleep(1);
    // Libération de la mémoire
    imagedestroy($img);
  }

  ?>