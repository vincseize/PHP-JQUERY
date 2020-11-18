<?php 
session_start(); 

require 'ini.php';


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta http-equiv="Pragma" content="no-cache"> -->

    <title><?php echo $_SESSION["TITLE_SITE"];?></title>

    <link rel="icon" href="img/favicons/favicon-16.svg" type="image/svg+xml" />

    <!--  JS -->
    <link rel="preload" href="js/jquery.min.js" as="script">
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <link rel="preload" href="js/galleries.js" as="script">
    <script type="text/javascript" src="js/galleries.js"></script>

    <link rel="preload" href="js/modernizr.js" as="script">
    <script type="text/javascript" src="js/modernizr.js"></script>
    
    <link rel="preload" href="js/navbar.js" as="script">

    <!--  CSS -->
    <link rel="preload" href="css/navbar.css" as="style">
    <link href="css/navbar.css" rel="stylesheet" type="text/css" />

    <link rel="preload" href="css/admin.css" as="style">
    <link href="css/admin.css" rel="stylesheet" type="text/css" />

    <link rel="preload" href="css/galleries.css" as="style">
    <link href="css/galleries.css" rel="stylesheet" type="text/css" />

    <link rel="manifest" href="manifest.json" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="application-name" content="BOOKx" />
    <meta name="apple-mobile-web-app-title" content="BOOKx" />
    <meta name="msapplication-starturl" content="index.php" />
  
</head>

<?php

    require_once 'fcts.php';
    // $nameGallerie = "Emily BluntxxxAAAAAAA";
    // $nameGallerie = basename(__DIR__) ;
    $dossier_images = 'img/galleries';
    $directories = listFolders_FirstLevel($dossier_images);
    $total_items = countDirectories_FirstLevel($dossier_images);

?>
