	<?php


if(isset($_GET['data'])){


/*	$file = "etoiles.txt";
	$myfile = fopen($file, "w");
	fwrite($myfile, $n);
	fclose($myfile);*/

    $data=$_GET['data']; // e.g:  etoiles=0_etoile_3_grise

    $tmp=explode("=",$data);
    $etoile=$tmp[1];





    $tmp=explode("_",$etoile);
    $village=$tmp[0]+1;
    // $village=int($tmp[0])+1;
    // $village=5;
    $netoile=0;
    $couleur='grise';




/*
  $file = "XXXXXX.txt";
  $myfile = fopen($file, "w");
  fwrite($myfile, $village);
  fclose($myfile);



*/







	$file = "getArray_etoiles_ennemyWin.php";
	$file_tmp = "getArray_etoiles_ennemyWin_tmp.php";


$reading = fopen($file, 'r');
$writing = fopen($file_tmp, 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  $string = 've_'.$village.' =';
  if (stristr($line,$string)) {
    $line = "\$ve_$village = $netoile;\n";
    $replaced = true;
  }
  fputs($writing, $line);
}


fclose($reading); 
fclose($writing);
// might as well not overwrite the file if we didn't replace anything
if ($replaced) 
{
  rename($file_tmp, $file);
} else {
  unlink($file_tmp);
}






	// reset Battle
	$n=2;
    $village=$tmp[0];
    $fp = fopen("crud_draw/imagesVillagesBattles/".$village."_battles_restantes.txt", 'w');
    fwrite($fp, $n);
    fclose($fp);








}

?>