<?php

// include_once("../inc_connect.php");		

function __autoload($className){
	include_once("models/$className.php");	


}


// server infos
$host = $_SERVER['HTTP_HOST'];
// echo $host;

if($host=='127.0.0.1'){
	$host = '127.0.0.1';
	$dbname='lesinvisible';	
	$user='root';
	// $passwd='aa161169';
	$passwd='';
}

if(	$host=='localhost'){
	$host = 'localhost';
	$dbname='lesinvisible'; 
	$user='root';
	$passwd='';
}

if ($host=='www.vincseize.net'){
	$host = 'db569638194.db.1and1.com';
	$dbname='db569638194'; 
	$user='dbo569638194';
	//$passwd='zz161169';
	$passwd='lesinvisible';
}

if ($host=='vincseize.net'){
	$host = 'db569638194.db.1and1.com';
	$dbname='db569638194'; 
	$user='dbo569638194';
	//$passwd='zz161169';
	$passwd='lesinvisible';
}


// $users=new User("127.0.0.1","root","","lesinvisible");
// $users=new User(__HOST,__USER,__PASSWD,__DBNAME);
$users=new User($host,$user,$passwd,$dbname);

if(!isset($_POST['action'])) {
	print json_encode(0);
	return;
}

switch($_POST['action']) {
	case 'get_users':
		print $users->getUsers();		
	break;
	
	case 'add_user':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->add($user);		
	break;
	
	case 'delete_user':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->delete($user);		
	break;
	
	case 'update_field_data':
		$user = new stdClass;
		$user = json_decode($_POST['user']);
		print $users->updateValue($user);				
	break;
}

exit();