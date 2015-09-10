<?php 



if(isset($_POST['typeAttaque'])){

	$typeAttaque = $_POST['typeAttaque'];
	$comment = $_POST['comment'];
	$auteurAttaque = $_POST['auteurAttaque'];
	$nVillage = $_POST['nVillage'];


	$date = date('Y/m/d H:i:s');
	$date = str_replace("/","",$date);
	$date = str_replace(":","",$date);
	$date = str_replace(" ","",$date);


	$file = $nVillage."_".$auteurAttaque."_".$date;

	$fp = fopen("imagesVillagesBattles/$file.txt", 'w');
	fwrite($fp, '$data');

	fclose($fp);

}


?>