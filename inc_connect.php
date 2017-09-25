<?php

//set timezone
date_default_timezone_set('Europe/London');


// server infos
$host = $_SERVER['HTTP_HOST'];
// echo $host;

if($host=='127.0.0.1'){
	$host = '127.0.0.1';
	$dbname='lesinvisible';	
	$user='root';
	$passwd='';
}

if(	$host=='localhost'){
	$host = 'localhost';
	$dbname='lesinvisible'; 
	$user='root';
	$passwd='';
}

if ($host=='www.vincseize16.net'){
	$host = 'db56963819416.db.1and1.com';
	$dbname='db56963819416'; 
	$user='dbo56963819416';
	$passwd='lesinvisible';
}

if ($host=='vincseize.net'){
	$host = 'db569638194616.db.1and1.com';
	$dbname='db56963819416'; 
	$user='dbo56963819416';
	$passwd='lesinvisible';
}

// $con=mysqli_connect("db56963819416.db.1and1.com","dbo56963819416","lesinvisible","db56963819416");

// root admin webapp password
$rootadmin = 'root';
$rootpwd ='lesinvisible';

############## DONT TOUCH #############################################

define('__HOST',$host);
define('__USER',$user);
define('__PASSWD',$passwd);
define('__DBNAME',$dbname);
define('__ROOTADMIN',$rootadmin);
define('__ROOTPWD',$rootpwd);





################  DB HOST CONNECT #####################################

try{
$dbh = new PDO("mysql:host=".__HOST.";dbname=".__DBNAME, __USER, __PASSWD);
}
catch(Exception $e){
	// En cas d'erreur, on affiche un message et on arr�te tout
        die('Erreur : '.$e->getMessage());
}



?>
