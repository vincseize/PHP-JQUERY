<?php


if(isset($_GET['data'])){

    $data=$_GET['data'];
    $tmp=explode("=",$data);
    $n=$tmp[1];

	$file = "n_battles_team_used.txt";
	$myfile = fopen($file, "w");
	fwrite($myfile, $n);
	fclose($myfile);

}

?>