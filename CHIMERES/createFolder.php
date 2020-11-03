<?php

require "fcts.php";

// new gallery
if ( !empty($_GET['folder']) )
{
    $folder = $_GET['folder'];
    // mkdir('img/galleries/'.$folder, 0755);

    if (file_exists($PATH_GALLERIES.DIRECTORY_SEPARATOR.$folder)) { 
        echo "Gallery Already Exist";
        exit;
    }

    if (!file_exists($PATH_GALLERIES.DIRECTORY_SEPARATOR.$folder)) { 
        mkdir($PATH_GALLERIES. DIRECTORY_SEPARATOR .$folder, 0755);
        createBlankImage($folder);
        echo "Gallery Created";
        exit();
    }
}

// rename gallery
if ( !empty($_GET['oldFolderName']) && !empty($_GET['u']))
{
    $folder = $PATH_GALLERIES.DIRECTORY_SEPARATOR.$_GET['oldFolderName'];
    $newname = $PATH_GALLERIES.DIRECTORY_SEPARATOR.$_GET['u'];
    rename($folder,$newname);
    // mkdir('img/galleries/'.$folder, 0755);
    echo "Gallery Updated";
    exit();
}

?>