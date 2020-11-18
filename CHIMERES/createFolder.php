<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'ini.php';
require "fcts.php";

// new gallery
if ( !empty($_GET['folder']) )
{
    $folder = $_GET['folder'];
    // mkdir('img/galleries/'.$folder, 0755);

    if (file_exists($_SESSION["PATH_GALLERIES"].DIRECTORY_SEPARATOR.$folder)) { 
        echo "Gallery Already Exist";
        exit;
    }

    if (!file_exists($_SESSION["PATH_GALLERIES"].DIRECTORY_SEPARATOR.$folder)) { 
        mkdir($_SESSION["PATH_GALLERIES"]. DIRECTORY_SEPARATOR .$folder, 0755);
        create_defaultImgGallery($folder);
        echo "Gallery Created";
        exit();
    }
}

// rename gallery
if ( !empty($_GET['oldFolderName']) && !empty($_GET['u']))
{
    $folder = $_SESSION["PATH_GALLERIES"].DIRECTORY_SEPARATOR.$_GET['oldFolderName'];
    $newname = $_SESSION["PATH_GALLERIES"].DIRECTORY_SEPARATOR.$_GET['u'];
    rename($folder,$newname);
    // mkdir('img/galleries/'.$folder, 0755);
    echo "Gallery Updated";
    exit();
}

?>