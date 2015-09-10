<?php

include_once("../inc_connect.php");

if(isset($_GET['id'])){

    $mame = $_GET['id'];
    // print $mame;
    $q = $dbh->prepare("SELECT * FROM users_zemelattitude WHERE name = :name");
    $q->bindValue(':name', 'Atomiz');
    $q->execute();
    
    if ($q->rowCount() > 0){

	$check = $q->fetch(PDO::FETCH_ASSOC);
	$row = $check['actif'];
	// do something
    }

    return $row;

}

?>