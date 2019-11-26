<?php

    $servers = array(
        '127.0.0.1',
        '::1'
    );

    $dbname = "booking";

    if(in_array($_SERVER['REMOTE_ADDR'], $servers)){
        // ----- local
        $servername = "localhost";
        $username = "root";
        $password = "";
    }

    else{
        // ----- distant
        $servername = "www.lapinscretins.com";
        // $servername = "53.212.24.34";
        $username = "lapin";
        $password = "cretin";    
    }

?>
