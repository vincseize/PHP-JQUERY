	<?php












if(isset($_GET['data'])){





/*	$file = "etoiles.txt";
	$myfile = fopen($file, "w");
	fwrite($myfile, $n);
	fclose($myfile);*/

    $data=$_GET['data']; // e.g: 0_etoile_1_grise
    $tmp=explode("=",$data);
	$tmp2=$tmp[1];
    $tmp3=explode("_",$tmp2);

/**/




/*




*/







    $zevillage=$tmp3[0];
    $village=$tmp3[0]+1;
    $netoile=$tmp3[2];
    $couleur=$tmp3[3];













	$file = "getArray_etoiles_ennemyWin.php";
	$file_tmp = "getArray_etoiles_ennemyWin_tmp.php";


$reading = fopen($file, 'r');
$writing = fopen($file_tmp, 'w');

$replaced = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line,'ve_'.$village.' =')) {
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






/*  $file = "XXXXXX.txt";
  $myfile = fopen($file, "w");
  fwrite($myfile, $zevillage.','.$village.','.$netoile.','.$couleur);
  fclose($myfile);*/




	
	//  Battle
    $n=1;
    $fp = fopen("crud_draw/imagesVillagesBattles/".$zevillage."_battles_restantes.txt", 'w');
    fwrite($fp, $n);
    fclose($fp);






}

?>