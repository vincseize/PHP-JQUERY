<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['UserData']['Username']))
{
    $url_redirection = $_SESSION["ROOT_URL"].'/'.$_SESSION["ROOT_FOLDER"];
    $_SESSION['UserData']['Username']=$logins[$Username];
    header("location:".$url_redirection."/index.php");
    // header("location:index.php");
    exit;
}

?>