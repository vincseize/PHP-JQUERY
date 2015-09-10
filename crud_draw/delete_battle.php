<?php


/*if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
{*/


	// $fp = fopen ($path_to_delete."/".$id."_zaaaaaaaaaa.txt",'w');
	// fclose ($fp);


if(isset($_POST['id'])){

	$path_to_delete = 'imagesVillagesBattles';
	$id = $_POST['id'];
	$tmp = explode(".", $id);
	$name = $tmp[0];
	$comments = $path_to_delete."/".$name.".txt";
	$img = $path_to_delete."/".$name.".JPG";

    	unlink($comments);
    	unlink($img);

/*
	$fp = fopen ($path_to_delete."/".$id."_zaaaaaaaaaa.txt",'w');
	fclose ($fp);
*/

}
?>