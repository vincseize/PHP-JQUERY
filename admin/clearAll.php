<?php

include_once("../inc_connect.php");

@unlink('clanName.txt');
@unlink('EndDate.txt');


$txt = '0;0;0;0;0000-00-00 00:00:00';

$myfile = fopen("timeLeft.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);


$files = glob('upload/server/php/files/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
$files = glob('upload/server/php/files/thumbnail/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}

$files = glob('../crud_draw/imagesVillagesBattles/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}


// clear etoiles/battles
unlink('../getArray_etoiles_ennemyWin.php');
$file = '../getArray_etoiles_ennemyWin.php';
// Ouvre un fichier pour lire un contenu existant
$current = file_get_contents($file);

$current .= "<?php\n";
$current .= "\n";
$current .= "\$ve_1 = 0;\n"; // for 0 to 20 ( nBattles Max )
$current .= "\$ve_2 = 0;\n";
$current .= "\$ve_3 = 0;\n";
$current .= "\$ve_4 = 0;\n";
$current .= "\$ve_5 = 0;\n";
$current .= "\$ve_6 = 0;\n";
$current .= "\$ve_7 = 0;\n";
$current .= "\$ve_8 = 0;\n";
$current .= "\$ve_9 = 0;\n";
$current .= "\$ve_10 = 0;\n";
$current .= "\$ve_11 = 0;\n";
$current .= "\$ve_12 = 0;\n";
$current .= "\$ve_13 = 0;\n";
$current .= "\$ve_14 = 0;\n";
$current .= "\$ve_15 = 0;\n";
$current .= "\$ve_16 = 0;\n";
$current .= "\$ve_17 = 0;\n";
$current .= "\$ve_18 = 0;\n";
$current .= "\$ve_19 = 0;\n";
$current .= "\$ve_20 = 0;\n";
$current .= "\n";
/*$current .= "\$n_battles_team_used = 0;\n";
$current .= "\n";*/
$current .= "?>\n";

// Écrit le résultat dans le fichier
file_put_contents($file, $current);


unlink('../getArray_etoiles_teamLost.php');
$file = '../getArray_etoiles_teamLost.php';
// Ouvre un fichier pour lire un contenu existant
$current = file_get_contents($file);

$current .= "<?php\n";
$current .= "\n";
$current .= "\$vt_1 = 0;\n";  // for 0 to 20 ( nBattles Max )
$current .= "\$vt_2 = 0;\n";
$current .= "\$vt_3 = 0;\n";
$current .= "\$vt_4 = 0;\n";
$current .= "\$vt_5 = 0;\n";
$current .= "\$vt_6 = 0;\n";
$current .= "\$vt_7 = 0;\n";
$current .= "\$vt_8 = 0;\n";
$current .= "\$vt_9 = 0;\n";
$current .= "\$vt_10 = 0;\n";
$current .= "\$vt_11 = 0;\n";
$current .= "\$vt_12 = 0;\n";
$current .= "\$vt_13 = 0;\n";
$current .= "\$vt_14 = 0;\n";
$current .= "\$vt_15 = 0;\n";
$current .= "\$vt_16 = 0;\n";
$current .= "\$vt_17 = 0;\n";
$current .= "\$vt_18 = 0;\n";
$current .= "\$vt_19 = 0;\n";
$current .= "\$vt_20 = 0;\n";
$current .= "\n";
/*$current .= "\$n_battles_ennemy_used = 0;\n";
$current .= "\n";*/
$current .= "?>\n";

// Écrit le résultat dans le fichier
file_put_contents($file, $current);


// clear N Battles

/*for 0 to 20 ( nBattles Max )
   $fp = fopen("crud_draw/imagesVillagesBattles/".$village."_battles_restantes.txt", 'w');
    fwrite($fp, $n);
    fclose($fp);*/
    

    $fp = fopen("../n_battles_ennemy_used.txt", 'w');
    fwrite($fp, 0);
    fclose($fp);
    
    
    $fp = fopen("../n_battles_team_used.txt", 'w');
    fwrite($fp, 0);
    fclose($fp);

 // clear user actif
    $checked=0;
    $sql = "UPDATE users SET actif=?";
    $q = $dbh->prepare($sql);
    $q->execute(array($checked));
    
?>

