<?php

// require_once("inc_links.php");


if(isset($_GET['data'])){

    $data=$_GET['data'];

    $tmp=explode(";",$data);
    $tmp=$tmp[0];
    $tmp=explode("=",$tmp);
    $village=$tmp[1];

    $tmp=explode(";",$data);
    $tmp=$tmp[1];
    $tmp=explode("=",$tmp);
    $n=$tmp[1];





    $fp = fopen("crud_draw/imagesVillagesBattles/".$village."_battles_restantes.txt", 'w');
    fwrite($fp, $n);
    fclose($fp);




/*    $fp = fopen("crud_draw/imagesVillagesBattles/toto.txt", 'w');
    fwrite($fp, $data);
    fclose($fp);*/







}

    










?>