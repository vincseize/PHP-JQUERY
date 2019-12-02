<?php 
include_once('config.php');

if(isset($_REQUEST['delIds']) && $_REQUEST['delIds']!=""){
	if(isset($_REQUEST['table']) && $_REQUEST['table']!=""){
		$location = '../'.$_REQUEST['table'].'/'.$_REQUEST['table'].'.php';
		$delIds = explode(",", $_REQUEST['delIds']);

		foreach($delIds as $id){
			$db->delete($_REQUEST['table'],array('id'=>$id));
		}

		// $url to do better to retur error or not
		header('location:'.$location.'?msg=rds$delIds=todo');

		// if($update){
		// 	header('location:'.$location.'?msg=rus&page=0');
		// 	exit;
		// }else{
		// 	header('location:'.$location.'?msg=rnu&page=0');
		// 	exit;
		// }
	}
}


?>