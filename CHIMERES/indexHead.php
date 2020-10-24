<?php 
session_start(); 

if(isset($_SESSION['UserData']['Username'])){
  echo "<script>";
        echo "const LOGGED = true;";
  echo "</script>";
} else {
  echo "<script>";
      echo "const LOGGED = false;";
  echo "</script>";
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BOOK</title>

    <link rel="icon" href="img/favicons/favicon-16.svg" type="image/svg+xml" />

    <!--  JS -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/galleries.js"></script>

    <link rel="preload" href="js/navbar.js" as="script">

    <!--  CSS -->
    <link rel="preload" href="css/navbar.css" as="style">
    <link href="css/navbar.css" rel="stylesheet" type="text/css" />

    <link rel="preload" href="css/admin.css" as="style">
    <link href="css/admin.css" rel="stylesheet" type="text/css" />

    <link rel="preload" href="css/galleries.css" as="style">
    <link href="css/galleries.css" rel="stylesheet" type="text/css" />
  
</head>

<?php

    require_once 'fcts.php';
    $nameGallerie = "Emily BluntxxxAAAAAAA";
    $nameGallerie = basename(__DIR__) ;
    $dossier_images = 'img/galleries';
    $directories = listFolders_FirstLevel($dossier_images);
    $total_items = countDirectories_FirstLevel($dossier_images);

?>
