<?php 
include_once('config.php');

if(isset($_REQUEST['delId']) && $_REQUEST['delId']!=""){
	if(isset($_REQUEST['table']) && $_REQUEST['table']!=""){
		$db->delete($_REQUEST['table'],array('id'=>$_REQUEST['delId']));
		// $url to do better
		header('location: browse-users.php?msg=rds');
		exit;
	}
}


?>