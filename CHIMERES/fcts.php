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
    $folders = glob($folder . DIRECTORY_SEPARATOR .'*' , GLOB_ONLYDIR);
    return $folders;
  }

  function listImages ($folder) {
      // $images[] = '';
      foreach(glob($folder.DIRECTORY_SEPARATOR.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}',GLOB_BRACE) as $file){
        $images[] =  basename($file);
      }
    
    return $images;
  }

  function constructCardHomeFolder ($folder) {
    if (!is_dir_empty($folder)) {

      $folder = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $folder);

      $images = listImages ($folder);
      $dirname = basename(dirname($folder.DIRECTORY_SEPARATOR.$images[0]) . PHP_EOL);

      $dPath = preg_split("/\//", $dirname);
      $dossierName = strval(end($dPath));
      $dossierName = str_replace(PHP_EOL, '', $dossierName);

      $infos = readInfos($folder,$dossierName);
    
      echo "<li>";


      echo "<div style='position:relative;'>";
          echo "<figure>";

          if (isset($_SESSION['UserData']['Username'] )) {
              echo "<img id='iconEditG' class='iconEdit iconEditG' src='img/icon_edit.png' data-gallery='".$dossierName."'>";
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
    if (!is_dir_empty($dossier_images)) {
      $images = listImages ($dossier_images);
      foreach($images as $img){
        echo "<li>";

        echo "<div style='position:relative;'>";
            echo "<figure>";
if (isset($_SESSION['UserData']['Username'] )) {
              echo "<img id='iconEditI' class='iconEdit iconEditI' data-gallery='".$dossier_images."' data-image='".$img."' src='img/icon_edit.png'>";
}
              echo "<img src='".$dossier_images.DIRECTORY_SEPARATOR.$img."' alt=''>";
              echo "<figcaption class='figcaption'>";
                echo "<p class='figcaptionM'>".$img."</p>";
                // echo "<p><a href='#'>Photo by </a></p>";
              echo "</figcaption>";
            echo "</figure>";
        echo "</div>";
      echo "</li>";
      }
    }
  }

  function gridFolders($directories){
    foreach($directories as $folder){
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
    $imagecount = count(glob($folder.DIRECTORY_SEPARATOR.'*.{jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF}',GLOB_BRACE));
    return $imagecount;
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

  ?>