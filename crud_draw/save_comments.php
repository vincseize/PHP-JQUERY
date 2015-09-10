<?php 


// include('inc_var_crud_draw.php');


/*if(isset($_POST['typeAttaque'])){

	$typeAttaque = $_POST['typeAttaque'];
	$comment = $_POST['comment'];
	$auteurAttaque = $_POST['auteurAttaque'];
	$nVillage = $_POST['nVillage'];


	$file = $nVillage."_".$auteurAttaque."_".$date;

	$data = $typeAttaque.";".$comment.";".$auteurAttaque;


	$fp = fopen("imagesVillagesBattles/".$file."txt", 'w');
	//$fp = fopen($path_folder_save."/".$file.".txt", 'w');
	fwrite($fp, $data);

	fclose($fp);

}
*/



	$fp = fopen("imagesVillagesBattles/file.txt", 'w');
	fwrite($fp, 'data');

	fclose($fp);










?>