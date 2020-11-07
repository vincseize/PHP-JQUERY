<?php

$TUMBNAILS_COMPRESSION = 90;
$TUMBNAILS_WIDTH = 480;

$PATH_GALLERIES = "img" . DIRECTORY_SEPARATOR . "galleries";
$ICON_DEFAULT_GALLERY = "___default_icon.jpg";
$ICON_GALLERY = "___icon.jpg";
$THUMBNAILS_FOLDER = "thumbnails";

$ARRAY_AUTH_FORMATS = "jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF";


function compare_imgs($img1,$img2,$result_images){
  
  $md5image1 = md5(file_get_contents($img1));
  $md5image2 = md5(file_get_contents($img2));
  if ($md5image1 == $md5image2) {
    // echo "equal";
    array_push($result_images, $img1);
  } else { 
    // echo "no equal";
  }
  return $result_images;
}


function checkFirst_iconGallery($gallery){

    global $PATH_GALLERIES;
    // global $THUMBNAILS_FOLDER;
    global $ARRAY_AUTH_FORMATS;
    global $ICON_DEFAULT_GALLERY;
    global $ICON_GALLERY;
    // $gallery = "zoob3";
    // $gallery = "juliette";

    $dir = $PATH_GALLERIES. DIRECTORY_SEPARATOR . $gallery;
    // $dirThumbnails = $PATH_GALLERIES. DIRECTORY_SEPARATOR . $gallery. DIRECTORY_SEPARATOR . $THUMBNAILS_FOLDER;
    // print_r($dirThumbnails);
    $images = glob($dir . DIRECTORY_SEPARATOR ."*.{".$ARRAY_AUTH_FORMATS."}", GLOB_BRACE);
    $result_images = array();
    foreach ($images as $img) {
      if(basename($img)!=$ICON_GALLERY && basename($img)!=$ICON_DEFAULT_GALLERY){
        // print $img;
        // print "<br>";
        $img2 = $dir . DIRECTORY_SEPARATOR . $ICON_DEFAULT_GALLERY ;
        $result_images = compare_imgs($img,$img2,$result_images);
        // print "<br>";
      }
    }
    // print_r($result_images);
    if (empty($result_images)) {
      // print_r($result_images);
      // print "<br>";
      $listImages = listImages($dir,false);
      $listImages = array_diff($listImages, array($ICON_DEFAULT_GALLERY, $ICON_GALLERY));
      // print_r($listImages);
      if(sizeof($listImages)==1){
        $iconToDo = reset($listImages);
        // print_r($listImages);
        // create thumbnail
        // create_thumbnail($dir,$iconToDo);
        create_IconGallery($gallery,$iconToDo);
        createThumbnails($dir,$listImages);
        // print_r($dir);

        // $new = $dirThumbnails . DIRECTORY_SEPARATOR . $iconToDo;
        // $old = $dirThumbnails . DIRECTORY_SEPARATOR . $ICON_GALLERY;
        // copy($new, $old);
        // $old = $dirThumbnails . DIRECTORY_SEPARATOR . $ICON_DEFAULT_GALLERY;
        // copy($new, $old);

        // $new = $dir . DIRECTORY_SEPARATOR . $iconToDo;
        // $old = $dir . DIRECTORY_SEPARATOR . $ICON_GALLERY;
        // copy($new, $old);
        // $old = $dir . DIRECTORY_SEPARATOR . $ICON_DEFAULT_GALLERY;
        // copy($new, $old);

        changeIconThumbnails($gallery,$iconToDo);

      }
    }

    // exit;
}

function changeIconThumbnails($gallery,$iconToDo){

  global $PATH_GALLERIES;
  global $THUMBNAILS_FOLDER;
  // global $ARRAY_AUTH_FORMATS;
  global $ICON_DEFAULT_GALLERY;
  global $ICON_GALLERY;


  $dir = $PATH_GALLERIES. DIRECTORY_SEPARATOR . $gallery;
  $dirThumbnails = $PATH_GALLERIES. DIRECTORY_SEPARATOR . $gallery. DIRECTORY_SEPARATOR . $THUMBNAILS_FOLDER;

  $new = $dirThumbnails . DIRECTORY_SEPARATOR . $iconToDo;
  $old = $dirThumbnails . DIRECTORY_SEPARATOR . $ICON_GALLERY;
  // copy($new, $old);
  makeThumb($new, $old);
  $old = $dirThumbnails . DIRECTORY_SEPARATOR . $ICON_DEFAULT_GALLERY;
  copy($new, $old);
  // makeThumb($new, $old);

  // resampled

  $new = $dir . DIRECTORY_SEPARATOR . $iconToDo;
  $old = $dir . DIRECTORY_SEPARATOR . $ICON_GALLERY;
  // copy($new, $old);
  makeThumb($new, $old);
  $old = $dir . DIRECTORY_SEPARATOR . $ICON_DEFAULT_GALLERY;
  // copy($new, $old);
  makeThumb($new, $old);

}

function rrmdir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir.DIRECTORY_SEPARATOR.$object) == "dir") 
          rrmdir($dir.DIRECTORY_SEPARATOR.$object); 
        else unlink   ($dir.DIRECTORY_SEPARATOR.$object);
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
      global $ARRAY_AUTH_FORMATS;

      $images = array();
      foreach(glob($folder.DIRECTORY_SEPARATOR.'*.{'.$ARRAY_AUTH_FORMATS.'}',GLOB_BRACE) as $file){
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

    // create thumbnails 
    createThumbnails($folder,$images);

    // foreach($images as $img){
    //   // echo $img;
    //   create_thumbnail($folder,$img);
    //   // create_thumbnail($folder,basename($file));
    //   // echo $img.$folder;
    // }

    return $images;
  }

  function createThumbnails($folder,$images){
    foreach($images as $img){
      // echo $img;
      create_thumbnail($folder,$img);
      // create_thumbnail($folder,basename($file));
      // echo $img.$folder;
    }
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

    global $THUMBNAILS_FOLDER;

    if (is_dir_empty($folder)) {
      $dirname = basename($folder);
      create_defaultImgGallery($dirname);

    }

    if (!is_dir_empty($folder)) {

      $folder = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $folder);
      $folderThumbnails = $folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER;

      $images = listImages($folder,true);
      $imagesIconGallery = $folder.DIRECTORY_SEPARATOR.$images[0];
      $imagesIconGalleryThumbnail = $folderThumbnails.DIRECTORY_SEPARATOR.$images[0];
      if(file_exists($imagesIconGalleryThumbnail)){
        $imagesIconGallery = $imagesIconGalleryThumbnail;
      }

      $dirname = basename(dirname($folder.DIRECTORY_SEPARATOR.$images[0]) . PHP_EOL);

      $dossierName = getDossierName($dirname);
      
      $infos = readInfos($folder,$dossierName);

      
    
      echo "<li>";


      echo "<div style='position:relative;'>";
          echo "<figure>";

          if (isset($_SESSION['UserData']['Username'] )) {
              echo "<img id='iconEditG' class='iconEdit iconEditG' src='img/icon_edit.png' data-gallery='".$dossierName."' >";
              // echo " width='500' height='500'" ;
              // echo " >";
              echo "<button id='iconDeleteG' class='iconDelete iconDeleteG' data-gallery='".$dirname."'><b>X</b></button>";
          }

                echo "<img id='imgFolder'";
                // echo "class='imgFolder' src='".$folder.DIRECTORY_SEPARATOR.$images[0]."' ";
                echo "class='imgFolder' src='".$imagesIconGallery."?nocache=".time()."' ";
                // echo "alt='".$images[0]."' ";
                echo "alt='".$imagesIconGallery."' ";
                // echo "onclick='imgFolder(\"$dossierName\");'>";
                echo "onclick='imgFolder(\"$dossierName\");' ";

                echo " width='500' height='500'" ;
                echo " >";


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
        $url_player = "http://127.0.0.1/CHIMERES/img/galleryPlayer/g=".$dirname;

        echo "<li>";

        echo "<div style='position:relative;'>";
            echo "<figure>";
if (isset($_SESSION['UserData']['Username']) && $img!=$ICON_DEFAULT_GALLERY && $img!=$ICON_GALLERY) {
    echo "<img id='iconEditI' class='iconEdit iconEditI' data-gallery='".$dirname."' data-image='".$img."' src='img/icon_edit.png'>";
    echo "<button id='iconDeleteI' class='iconDelete iconDeleteI' data-gallery='".$dirname."' data-image='".$img."'><b>X</b></button>";
}
$styleBorder = " ";
$styleCaption = " ";
$noCache = "";
if ($img==$ICON_DEFAULT_GALLERY || $img==$ICON_GALLERY) {
  $imgName = "Gallery Icon";
  $styleBorder =" style='border:2px solid black;'";
  $styleCaption = " style='color:white;background-color:black;'";
  $noCache = "?nocache=".time();
}

              echo "<img class='imgGridGallery' src='".$dossier_images.DIRECTORY_SEPARATOR.$img.$noCache."' alt='' ".$styleBorder." ";
              echo " data-gallery='".$dirname."' ";
              echo " data-image='".$imgName."' ";
              echo " >";
              echo "<figcaption class='figcaption' ".$styleCaption.">";
                echo "<p class='figcaptionM'  ".$styleCaption.">".$imgName."</p>";
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
    global $THUMBNAILS_FOLDER;
    foreach($directories as $folder){
      if (!file_exists($folder.DIRECTORY_SEPARATOR.$ICON_DEFAULT_GALLERY)) {   
        $dirname = basename($folder);
        create_defaultImgGallery($dirname);
      }

      if (!file_exists($folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER)) {
        mkdir($folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER, 0755, true);
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
    global $ARRAY_AUTH_FORMATS;

    $imagecount = count(glob($folder.DIRECTORY_SEPARATOR.'*.{'.$ARRAY_AUTH_FORMATS.'}',GLOB_BRACE));

    // create icon gallery default
    $dirname = basename($folder);
    $arrayImages = array();
    if(!in_array($ICON_GALLERY,$arrayImages) && $imagecount>1){
      $arrayImages = listImages($folder,false);
      create_IconGallery($dirname,$arrayImages[0]);
    }

    if(!in_array($ICON_DEFAULT_GALLERY,$arrayImages) && $imagecount>1){
      $arrayImages = listImages($folder,false);
      create_IconGallery($dirname,$arrayImages[0]);
    }

    
    // count IMGs
    $arrayImages = array();
    foreach (glob($folder.DIRECTORY_SEPARATOR.'*.{'.$ARRAY_AUTH_FORMATS.'}', GLOB_BRACE) as $filename) { 
        if (!strstr($filename, $ICON_DEFAULT_GALLERY) && !strstr($filename, $ICON_GALLERY)) {
          array_push($arrayImages,$filename);
        }
    }

    $imagecount = count($arrayImages);

    return $imagecount;
  }

  function create_thumbnail($folder,$img){
    global $THUMBNAILS_FOLDER;
    // global $PATH_GALLERIES;

    $img_path = $folder.DIRECTORY_SEPARATOR.$img;
    $thumbnail_img_path = $folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER.DIRECTORY_SEPARATOR.$img;
    // $thumb_width = 100;

    // $thumbnails_folder = $folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER;
    // for debug
    // rrmdir($thumbnails_folder);
    // mkdir($thumbnails_folder, 0755);
    // exit;

    // echo $img_path;
    // exit;


    if(!file_exists($thumbnail_img_path)){
      // echo $thumbnail_img_path;
      // exit;
      makeThumb($img_path, $thumbnail_img_path);
    }
  
  }














    // ------------------------------------------





    function makeThumb($src, $dest) {

      global $TUMBNAILS_WIDTH;

      $thumb_width = $TUMBNAILS_WIDTH;

      $what = getimagesize($src);
      $mime = $what['mime'];

      /* read the source image */

      switch(strtolower($mime))
      {
          case 'image/png':
                  $source_image = imagecreatefrompng($src);
              break;
          case 'image/jpeg':
                  $source_image = imagecreatefromjpeg($src);
              break;
          case 'image/gif':
                $source_image = imagecreatefromgif($src);
              break;
          case 'image/bmp':
            $source_image = imagecreatefrombmp($src);
              break;
          // default: die();
      }

      $width = imagesx($source_image);
      $height = imagesy($source_image);
      $thumb_height = floor($height * ($thumb_width / $width));

      /* create a new, "virtual" image */
      $virtual_image = imagecreatetruecolor($thumb_width, $thumb_height);
      // $virtual_image = imagecreatetruecolor($thumb_width, $thumb_height);
    
      /* copy source image at a resized size */
      imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
    
      /* create the physical thumbnail image to its destination */

      switch(strtolower($mime))
      {
          case 'image/png':
                  imagepng($virtual_image, $dest);
              break;
          case 'image/jpeg':
                  imagejpeg($virtual_image, $dest);
              break;
          case 'image/gif':
                imagegif($virtual_image, $dest);
              break;
          case 'image/bmp':
                imagebmp($virtual_image, $dest);
              break;
          // default: die();
      }

      /* liberate memory */
      imagedestroy($virtual_image);
      // exit;
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

  function create_defaultImgGallery($folder){
    // echo "create_defaultImgGallery";
    // exit;
    
    global $PATH_GALLERIES;
    global $ICON_DEFAULT_GALLERY;
    global $ICON_GALLERY;
    global $THUMBNAILS_FOLDER;
    global $THUMBNAILS_COMPRESSION;

    $folder = $PATH_GALLERIES.DIRECTORY_SEPARATOR.$folder;
    $folder_thumbnails = $folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER;

    $img = imagecreatetruecolor(640, 480);
    $bg = imagecolorallocate ( $img, 255, 255, 255 );

    // $color = imagecolorallocate($img, 0, 0, 0);
    // $border = 3;
    // // drawBorder($img,$color, $border);
    // imagefilledrectangle($newimage,0,0,$img_adj_width, $img_adj_height,$border_color);

    imagefilledrectangle($img,0,0,640,480,$bg);

    imagejpeg($img,$folder.DIRECTORY_SEPARATOR.$ICON_DEFAULT_GALLERY,$THUMBNAILS_COMPRESSION);
    sleep(1);
    // imagedestroy($img); // Libération de la mémoire

    imagejpeg($img,$folder.DIRECTORY_SEPARATOR.$ICON_GALLERY,$THUMBNAILS_COMPRESSION);
    sleep(1);
    // imagedestroy($img);

    // sample comp
    // imagejpeg($img,"myimg.jpg",100);

    if (!file_exists($folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER)) {
      mkdir($folder.DIRECTORY_SEPARATOR.$THUMBNAILS_FOLDER, 0755, true);
      sleep(1);
      create_thumbnail($folder,$ICON_DEFAULT_GALLERY);
      sleep(1);
      create_thumbnail($folder,$ICON_GALLERY);
      sleep(1);
    }
  }

  ?>

  <script>

// $(document).ready(function(){

//     const imgGridGallery = document.querySelector(".imgGridGallery");
//     try {
//       imgGridGallery.addEventListener("click", function() {
//         let dirname = 'test';
//         let url_player = "http://127.0.0.1/CHIMERES/img/galleryPlayer/g="+dirname;
//         console.log('imgGridGallery');
//       }, false);
//     } catch (error) {
//         console.error(error);
//     }


//   });

  </script>