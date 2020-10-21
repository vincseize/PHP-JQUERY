<?php 
session_start(); 

if(isset($_SESSION['UserData']['Username'])){
  echo "<script>";
  echo "const LOGGED = 'True';";
  echo "</script>";
} else {
  echo "<script>";
  echo "const LOGGED = 'False';";
  echo "</script>";
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicons/favicon-16.svg" type="image/svg+xml" />

    <!--  JS -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/galleries.js"></script>

    <link rel="preload" href="js/navbar.js" as="script">

    <!--  CSS -->
    <link rel="preload" href="css/navbar.css" as="style">
    <link href="css/navbar.css" rel="stylesheet" type="text/css" />

    <link href="css/galleries.css" rel="stylesheet" type="text/css" />



    <style>

        /* .scrollTopButton {
          display: none;
          position: fixed;
          opacity: 0.5;
          bottom: 15px;
          right: 10px;
          z-index: 999;
          font-size: 0.8em;
          border: none;
          outline: none;
          background-color: red;
          color: white;
          cursor: pointer;
          padding: 15px;
          border-radius: 4px;
        }

        .scrollTopButton:hover {
          background-color: #555;
        } */

</style>



    <title>BOOK</title>
  
</head>

<?php

    require_once 'fcts.php';
    $nameGallerie = "Emily BluntxxxAAAAAAA";
    $nameGallerie = basename(__DIR__) ;
    $dossier_images = 'img/galleries';
    $directories = listFolders_FirstLevel($dossier_images);
    $total_items = countDirectories_FirstLevel($dossier_images);

?>
