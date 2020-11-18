<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ------------------------------ YOUR VAR

// $_SESSION["NAME_GALLERY"] = "Emily BluntxxxAAAAAAA";
$_SESSION["NAME_GALLERY"] = basename(__DIR__) ;
$_SESSION["TITLE_SITE"] = "BOOK ".$_SESSION["NAME_GALLERY"] ;

// ------------------------------ DONT TOUCH

$_SESSION["ROOT_URL"] = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
$_SESSION["ROOT_FOLDER"] = basename(dirname(__FILE__));
$_SESSION["ROOT_URL_IMG"] = $_SESSION["ROOT_URL"] . '/' . $_SESSION["ROOT_FOLDER"];

$_SESSION["THUMBNAILS_COMPRESSION"] = 90;
$_SESSION["THUMBNAILS_WIDTH"] = 480;
$_SESSION["PATH_GALLERIES"] = "img" . DIRECTORY_SEPARATOR . "galleries";
$_SESSION["ICON_DEFAULT_GALLERY"] = "___default_icon.jpg";
$_SESSION["ICON_GALLERY"] = "___icon.jpg";
$_SESSION["THUMBNAILS_FOLDER"] = "thumbnails";
$_SESSION["ARRAY_AUTH_FORMATS"] = "jpg,JPG,jpeg,JPEG,png,PNG,gif,GIF";
$_SESSION["g"] = false;
if (isset($_GET['g'] )) {
    $_SESSION["g"] = $_GET['g'];
}
if (isset($_POST['Username'])) {
    $_SESSION['signin'] = $_POST['Username'];
}
$_SESSION["GALLERY_PATH"] = 'img/galleries/'.$_SESSION["g"];
$_SESSION["SERVER_PATH"] = 'server/php/files';
$_SESSION["SERVER_FILES_UPLOAD"] = $_SESSION["SERVER_PATH"].'/'.$_SESSION["g"].'_'.$_SESSION["signin"];
$_SESSION["PATH_FILES_UPLOAD"] = "BlueImp/".$_SESSION["SERVER_PATH"];

// ------------------------------

$dir_files_upload = $_SESSION["PATH_FILES_UPLOAD"];
// if(!chmod($dir_files_upload,0777))
// {
//     echo "Unable to chmod $dir_files_upload";
// }

if(isset($_SESSION['UserData']['Username'])){
    echo "<script>";
          echo "const LOGGED = true;";
    echo "</script>";
  } else {
    echo "<script>";
        echo "const LOGGED = false;";
    echo "</script>";
}

$dir_writable = substr(sprintf('%o', fileperms($dir_files_upload)), -4) == "0777" ? "true" : "false";
if($dir_writable=="false"){
    chmod_r($dir_files_upload);
}

function chmod_r($path) {
    $dir = new DirectoryIterator($path);
    foreach ($dir as $item) {
        chmod($item->getPathname(), 0777);
        if ($item->isDir() && !$item->isDot()) {
            chmod_r($item->getPathname());
        }
    }
}

// echo $_SESSION['signin'];
// exit;
