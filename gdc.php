<?php

include_once("inc_connect.php");

		
// $dbh = new PDO("mysql:host=".$host.";dbname=".$db,$user,$pass);		
$users=array();
$resultats=$dbh->query("SELECT * FROM users_zemelattitude WHERE actif='1' ORDER by hdv DESC ");
$resultats->setFetchMode(PDO::FETCH_OBJ);
while( $resultat = $resultats->fetch() ){
array_push($users,$resultat->name);
//echo 'Utilisateur : '.$resultat->name.'<br>';
}

$resultats->closeCursor();	

//print_r($users);
	
?>




<body>
<head>





        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <link href="css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css"
        rel="stylesheet" type="text/css">















<style>


.etoiles {
display: inline-block;
	/*	display: inline;*/
}

#buttonBackHome {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 20px;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
    width:250px; 
}

#buttonBackHome:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}


#drawBattleDiv {
    border-radius: 25px;
    background: #E0F2F7;
    padding: 2px;
    width: 200px;
    height: 15px;
}




#drawBattleDiv {
  background: #3498db;
  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
  background-image: -o-linear-gradient(top, #3498db, #2980b9);
  background-image: linear-gradient(to bottom, #3498db, #2980b9);
  -webkit-border-radius: 28;
  -moz-border-radius: 28;
  border-radius: 28px;
  font-family: Arial;
  color: #ffffff;
  font-size: 12px;
  font-weight: bold;
  /*padding: 10px 20px 10px 10px;*/
  text-decoration: none;
  width:250px;  
  vertical-align:middle;
  padding-bottom:10px;
}

#drawBattleDiv:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;

}



</style>


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>

<script>
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				var backToHome = "Refresh";
			}
			else{var backToHome = "Back to Home";}


$(document).ready(function () {  



        $('.loadMenu').click(function(event) {
          $("#content").load($(this).attr('href')); //load the data
          event.preventDefault(); // prevent the browser from following the link
        });

        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            // alert('toto');
            // gdc.php?X='+widthScreen+'&Y='+heightScreen+'
/*            var widthScreen = window.screen.width; 
            var heightScreen = window.screen.height;*/
            document.location.href = 'gdc.php?X='+widthScreen+'&Y='+heightScreen;
        }
});



$(document).ready(
    function(){

        $(window).scroll(function () {
            var docElement = $(document)[0].documentElement;
            var winElement = $(window)[0];
            // console.log(winElement.pageYOffset);
            // if ((docElement.scrollHeight - winElement.innerHeight) == winElement.pageYOffset) {
            if (winElement.pageYOffset<100) {
            	 // console.log('YES');
                $( "#TOP_navbarGDC" ).show();
            } else {
                // console.log('NO');
                $( "#TOP_navbarGDC" ).hide();
            }
        });



});


// check screen

//var w = window.innerWidth;
//var h = window.innerHeight;

//alert(w);



</script>

</head>


<body>



<?php

    require_once("inc_links.php");
    require_once("get_nvillages.php");


	include("calcul_etoiles.php");

	$n_etoiles_win_ennemy = getArray_etoiles_ennemyWin($ve_1,$ve_2,$ve_3,$ve_4,$ve_5,$ve_6,$ve_7,$ve_8,$ve_9,$ve_10,$ve_11,$ve_12,$ve_13,$ve_14,$ve_15,$ve_16,$ve_17,$ve_18,$ve_19,$ve_20);
	$n_etoiles_lost_team = getArray_etoiles_teamLost($vt_1,$vt_2,$vt_3,$vt_4,$vt_5,$vt_6,$vt_7,$vt_8,$vt_9,$vt_10,$vt_11,$vt_12,$vt_13,$vt_14,$vt_15,$vt_16,$vt_17,$vt_18,$vt_19,$vt_20);


	$screenWidth = htmlspecialchars($_GET["X"]);
	$screenWidthIMG = $screenWidth/0.75;
	$screenHeight = htmlspecialchars($_GET["Y"]);
	$screenHeightIMG = $screenHeight/0.75;
	$sizeIMGetoiles = "45";
	if(($screenWidth < 1025)) {$screenWidthIMG = $screenWidth*0.9;$screenHeightIMG = $screenHeight*0.9;$sizeIMGetoiles = "40";}


	$directoryBIG = DIRECTORY_BIG;
	$directoryLOW = DIRECTORY_LOW;
	$dirVillageAttaque = 'imagesVillagesBattles';

	$imagetypes = array("image/png", "image/jpg", "image/JPG", "image/jpeg", "image/gif");




function compImagestoJPG($dir)
{
	# to do better
	// comp to jpg
	foreach (glob($dir."*.png") as $filename) {
		$file = realpath($filename);
		$explode = explode(".", $file);
		$newImage = $explode[0].".JPG";
		$image = imagecreatefrompng($file);
		imagejpeg($image, $newImage, 70);
		imagedestroy($image);
		unlink($file);
	}

	foreach (glob($dir."*.PNG") as $filename) {
		$file = realpath($filename);
		$explode = explode(".", $file);
		$newImage = $explode[0].".JPG";
		$image = imagecreatefrompng($file);
		imagejpeg($image, $newImage, 70);
		imagedestroy($image);
		unlink($file);
	}

header('Refresh:0; url='.HOMEPATH);

}




function testTypeImage($dir,$directoryLOW){

		$files = array();
		$handler = opendir($dir); // open the cwd..also do an err check.
		while(false != ($file = readdir($handler))) {
		        if(($file != ".") and ($file != "..") and ($file != "index.php")) {
		        	if(is_file($dir.$file)){
		                // $files[] = $file; // put in array.
		                $tmp = explode(".", $file);
		                // echo $tmp;
		                @$ext = $tmp[1] ;
		                $files[] = $ext; // put in array.
		            }
		        }   
		}

		if (in_array("png", $files)) {
			compImagestoJPG($dir);
			compImagestoJPG($directoryLOW);
		}




}










 function getImages($dir,$directoryLOW,$dirVillageAttaque)
  {
    global $imagetypes;

    // array to hold return value
    $retval = array();

    // add trailing slash if missing
    if(substr($dir, -1) != "/") $dir .= "/";

    // full server path to directory
    $fulldir = $dir;

    $d = @dir($fulldir) or die("getImages: Failed opening directory $dir for reading");
    while(false !== ($entry = $d->read())) {
      // skip hidden files
      if($entry[0] == ".") continue;

      // check for image files
      // echo $entry;
      $f = escapeshellarg("$fulldir$entry");

      $mimetype = mime_content_type("$fulldir$entry");
      foreach($imagetypes as $valid_type) {

        if(preg_match("@^{$valid_type}@", $mimetype)) {
          $retval[] = array(
           'file' => "/$dir$entry",
           'size' => getimagesize("$fulldir$entry")
          );

          break;
        }
      }
    }
    $d->close();

    sort($retval);

    return $retval;
  }




//test compress image
testTypeImage($directoryBIG,$directoryLOW);

// fetch image details
$images = getImages($directoryBIG,$directoryLOW,$dirVillageAttaque);
$n_images = count($images);




// SCRIPTS JS

include("js/script_select_battles_restantes.js");


/*
echo "<script type='text/javascript'>";
echo "function goDraw(){";
echo "var e = document.getElementById('selectBattleLeft');";
echo "var v = e.options[e.selectedIndex].value;";
echo "	alert(v);";
echo "}";
echo "</script>";


// check screen


echo "<script type='text/javascript'>";
echo "var w_img_gdc=' ';";
echo "var w = window.innerWidth;";
echo "var h = window.innerHeight;";
// echo "alert(w);";

echo "if(w<1025){var w_img_gdc='800px';}";

echo "alert(w_img_gdc);";
echo "</script>";


*/



?>



















<nav name="TOP_navbarGDC" id="TOP_navbarGDC" class="navbar navbar-default navbar-fixed-top" style="background-color:#202020">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

      
       <script>
       
	  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	      document.write('<a class="navbar-brand" href="#" onClick="window.opener.location.reload();" style="color:white;font-family:arial;">');
	      document.write(backToHome);
	      document.write('</a>');
	  }
	  else{
	      document.write('<a class="navbar-brand" href="#" onClick="window.close();" style="color:white;font-family:arial;">');
	      document.write(backToHome);
	      document.write('</a>');
	  }
	
      
      </script>

      
    </div>

    <div name="navbarGDC" id="navbarGDC" style="margin: 0px; padding: 0px; position: absolute; left: 150px; top: 0px; width: 660px; height: 50px;z-index: 30000; background-color: #202020;display:block:"></div>



    
  </div><!-- /.container-fluid -->





</nav>






<br><br><br><br>


<!-- <br><br><br><br> -->














<font color=red>ONLY  CHROME BROWSER  FOR MOBILE !!!</font>
<br>


<?php




//LAYOUT


echo "Attaques possibles <i>(quick access)</i>&nbsp; & étoiles perdues : <br>";
for ($x = 0; $x <= $n_images-1; $x++) {
	$v=$x;
	$n_village = $x+1;
	$filename = "crud_draw/imagesVillagesBattles/".$v."_battles_restantes.txt";
	$n_battle = file_get_contents($filename, true);
	$n_etoiles_win = $n_etoiles_win_ennemy[$v];
	$n_etoiles_lost = $n_etoiles_lost_team[$v];
	$a=$x;	

	$directory = "crud_draw/imagesVillagesBattles/";
	$imagesJPG = glob($directory . $v."_*.JPG");

/*		$netoiles_lost = "";
		if($n_etoiles_lost==1){$netoiles_lost = "<font color=yellow>*</font>";}
		if($n_etoiles_lost==2){$netoiles_lost = "<font color=yellow>**</font>";}
		if($n_etoiles_lost==3){$netoiles_lost = "<font color=yellow>***</font>";}
		if($n_etoiles_lost==4){$netoiles_lost = "<font color=black>***</font>";}*/


	// if($n_battle!=0 and $n_etoiles_win!=3){
	if($n_battle!=0){

		$netoiles_win = "";
		$bg_td_victory="#D8D8D8";
		if($n_etoiles_win==1){$netoiles_win = "<font color=yellow>*</font>";}
		if($n_etoiles_win==2){$netoiles_win = "<font color=yellow>**</font>";}
		if($n_etoiles_win==3){$netoiles_win = "<font color=yellow>***</font>";$bg_td_victory="green";}
		if($n_etoiles_win==4){$netoiles_win = "<font color=black>***</font>";}

		if(count($imagesJPG)>0){
			echo "<div style='background-color:".$bg_td_victory.";display:inline-block;width:58px;'><table><tr><td><b><font size='2'><a href='#".$a."_anchor' onclick='hide_navbar();' style='text-decoration:none;color:#5882FA;'>&nbsp; ".$n_village." ".$netoiles_win."&nbsp;</a></font></b></div>";
			echo "</tr></td>";
			echo "<tr><td>";
			echo "<hr style='margin: 0;padding: 0;'>";
			echo "<font color=grey>";

			if ($n_etoiles_lost == 0){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:#B0C4DE;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 1){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";				
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 2){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 3){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 4){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}


/*			echo "</td></tr>";
			echo "</table></div>&nbsp;";*/
			//}








		}
		else{
			echo "<div style='background-color:".$bg_td_victory.";display:inline-block;width:60px;'><table><tr><td><b><font size='2'><a href='#".$a."_anchor'  onclick='hide_navbar();' style='text-decoration:none;color:#000;'>&nbsp; ".$n_village." ".$netoiles_win."&nbsp;</a></font></b></div>";
			echo "</tr></td>";
			echo "<tr><td>";
			echo "<hr style='margin: 0;padding: 0;'>";
			echo "<font color=grey>";

/*			//if ($n_etoiles_win_lost == 1){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:#B0C4DE;'>x</a>";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>x</a>";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>x</a>";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";*/

			if ($n_etoiles_lost == 0){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:#B0C4DE;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 1){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 2){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 3){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:yellow;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}

			if ($n_etoiles_lost == 4){
				$val_etoile = $v."_etoile_1_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")' style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_2_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_3_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:black;'>x</a>";
				$val_etoile = $v."_etoile_4_grise";
				echo "&nbsp;<a href='#'  onclick='clickEtoileLoose(\"$val_etoile\")'  style='text-decoration: none;color:#B0C4DE;'>0</a>";
				echo "</font>";
			}



/*			echo "</td></tr>";
			echo "</table></div>&nbsp;";*/
		}



			echo "</td></tr>";
			echo "</table></div>&nbsp;";


		if($n_village==10){echo "<br><br>";}


	}
} 





echo "<br>";






// display on page
$v = 0;
foreach($images as $img) {

		

		$va=$v;
		$anchor=$va."_anchor";

		$village=HOMEPATH.$img['file'];
		// echo $v;
		$n_etoiles_win = $n_etoiles_win_ennemy[$v];
		$tb_bgColor = "  style='background-color:#BDBDBD'";


		if ($v%2==0){

			$tb_bgColor = "  style='background-color:#D8D8D8'";

		} 

		$display_draw_battle= " ";

		//if ($screenWidth< 1025){
			//$screenWidthIMG = $screenWidthIMG/1.2;
			//$sizeIMG_W = $screenHeightIMG/1.2;
		//}		
		
		
		// $sizeIMG_W = " width='800px';";
		$sizeIMG_W = " width='".$screenWidthIMG."px;';";
		$sizeIMG_H = " width='".$screenHeightIMG."px;';";
		

		
		
		$display_battle_proposees = " ";
		$border = " border='1'";
		$display_user_battle1 = " ";



		// check if file exist
		$n_battle=2;
		$filename = "crud_draw/imagesVillagesBattles/".$v."_battles_restantes.txt";
		if (file_exists($filename)) {
		    // echo "Le fichier $filename existe.";
		    $n_battle = file_get_contents($filename, true);
		    // echo $n_battle;
		} else {
		    $fp = fopen($filename, 'w');
    		fwrite($fp, '2');
    		fclose($fp);
		}



		if ($n_battle == 0){
			$tb_bgColor = "  style='background-color:grey'";
			$sizeIMG_H = "  height='80px;';";
			$sizeIMG_W = $sizeIMG_W/2;
			// $sizeIMG_W = " width='".$screenWidthIMG."px';";
			 $display_draw_battle = " style='display:none;'";
			 $display_battle_proposees = " style='display:none;'";
			 $border = " border='0'";
		}

		// else {}

		elseif ($n_etoiles_win == 3){
			$tb_bgColor = "  style='background-color:#62FF74'";
			$sizeIMG_H = "  height='80px;';";
			$sizeIMG_W = $sizeIMG_W/2;
			// $sizeIMG_W = " width='".$screenWidthIMG."px';";
			 $display_draw_battle = " style='display:none;'";
			 $display_battle_proposees = " style='display:none;'";
			 $border = " border='0'";
		}

		if ($n_etoiles_win == 3 and $n_battle == 0){
			$tb_bgColor = "  style='background-color:#62FF74'";
			$sizeIMG_H = "  height='80px;';";
			$sizeIMG_W = $sizeIMG_W/2;
			// $sizeIMG_W = " width='".$screenWidthIMG."px';";
			 $display_draw_battle = " style='display:none;'";
			 $display_battle_proposees = " style='display:none;'";
			 $border = " border='0'";
		}

		if ($n_battle == 1){
			$display_user_battle1 = " style='display:none;'";
		}



		// echo "<br> ";




		echo "<table  id='$anchor' border='0' width='100%' width='".$screenHeightIMG."px'   ".$tb_bgColor.">";
		//echo "<table border='0' style='background-color:#62FF74'>";		
		echo "    <tr >";
		// echo "        <td ".$sizeIMG_W.">";
		echo "        <td width='1px;' valign='top'>";

		echo "<img src='$village'".$sizeIMG_H." ".$sizeIMG_W.">";

		echo " </td>";






		echo "        <td valign='top'>";






		// echo "<br> ";



		echo "<table $border width='100%' style='margin: 0;'>";
		echo "    <tr>";
		echo "        <td valign='top'>";

		echo "<div style='margin-left:0px; background-color:#ccc;'><a href='#top' onclick='show_navbar();' >Back to top of page</a></div>";





/*						echo "<div $display_draw_battle>";
						echo "<select id='selectBattleLeft$v' name ='selectBattleLeft$v' onchange=getNbattle_restante($v);>";
						if($n_battle==2){
							echo "  <option value='2' selected='selected'>2</option>";
							echo "  <option value='1'>1</option>";
							echo "  <option value='0'>0</option>";
						}
						if($n_battle==1){
							echo "  <option value='2'>2</option>";
							echo "  <option value='1'selected='selected'>1</option>";
							echo "  <option value='0'>0</option>";
						}
						if($n_battle==0){
							echo "  <option value='2'>2</option>";
							echo "  <option value='1'>1</option>";
							echo "  <option value='0'selected='selected'>0</option>";
						}
						echo "</select> ";
						echo "<font size=1>battle restante(s)</font>";
						//echo "&nbsp;/2 battles restantes ";
						echo "</div>";
*/

					echo "<br> ";

					$e_g="images/etoile_grise.png";
					$e_j="images/etoile_jaune.png";
					$e_n="images/etoile_noire.png";


echo "<table width='1px'><tr>";

					if ($n_etoiles_win == 4){
						$val_etoile = $v."_etoile_1_grise";
						echo "<td><div id='".$v."_etoile_1' name='".$v."_etoile_1' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_n' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";
						$val_etoile = $v."_etoile_2_grise";
						echo "<td><div id='".$v."_etoile_2' name='".$v."_etoile_2' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_n' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
						$val_etoile = $v."_etoile_3_grise";
						echo "<td><div id='".$v."_etoile_3' name='".$v."_etoile_3' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_n' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
					}


					if ($n_etoiles_win == 3){
						$val_etoile = $v."_etoile_1_jaune";
						echo "<td><div id='".$v."_etoile_1' name='".$v."_etoile_1' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_j' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";
						$val_etoile = $v."_etoile_2_jaune";						
						echo "<td><div id='".$v."_etoile_2' name='".$v."_etoile_2' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_j' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
						$val_etoile = $v."_etoile_3_jaune";
						echo "<td><div id='".$v."_etoile_3' name='".$v."_etoile_3' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_j' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
					}
					if ($n_etoiles_win == 2){
						$val_etoile = $v."_etoile_1_jaune";
						echo "<td><div id='".$v."_etoile_1' name='".$v."_etoile_1' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_j' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";
						$val_etoile = $v."_etoile_2_jaune";
						echo "<td><div id='".$v."_etoile_2' name='".$v."_etoile_2' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_j' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
						$val_etoile = $v."_etoile_3_noire";
						echo "<td><div id='".$v."_etoile_3' name='".$v."_etoile_3  class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_n' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
					}
					if ($n_etoiles_win == 1){
						$val_etoile = $v."_etoile_1_jaune";
						echo "<td><div id='".$v."_etoile_1' name='".$v."_etoile_1' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_j' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";
						$val_etoile = $v."_etoile_2_noire";
						echo "<td><div id='".$v."_etoile_2' name='".$v."_etoile_2' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_n' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";
						$val_etoile = $v."_etoile_3_noire";
						echo "<td><div id='".$v."_etoile_3' name='".$v."_etoile_3' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_n' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
					}
					if ($n_etoiles_win == 0){
						$val_etoile = $v."_etoile_1_grise";
						echo "<td><div id='".$v."_etoile_1' name='".$v."_etoile_1' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_g' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";
						$val_etoile = $v."_etoile_2_grise";
						echo "<td><div id='".$v."_etoile_2' name='".$v."_etoile_2' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_g' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
						$val_etoile = $v."_etoile_3_grise";
						echo "<td><div id='".$v."_etoile_3' name='".$v."_etoile_3' class='etoiles'><a href='#' onclick='clickEtoile(\"$val_etoile\")'><img src='$e_g' height='".$sizeIMGetoiles."' width='".$sizeIMGetoiles."'></a></div></td>";	
					}


$val_etoile = $v."_etoile_4_noire";
echo "<td>&nbsp;&nbsp;<a href='#' onclick='clickEtoile(\"$val_etoile\")'>0</a></td>";

// echo "<td>&nbsp;&nbsp;<a href='#' onclick='resetBattle('\"$val_etoile\")'>reset battle</a></td>";
/*echo "</tr></table>";*/

echo "</tr>";

if ($n_etoiles_win > 0){
	echo "<tr><td colspan=3>&nbsp;&nbsp;<a href='#' onclick='resetBattle(\"$val_etoile\")'>reset battle</a></td></tr>";
}

echo "</table>";




		echo "<div $display_draw_battle>";		

		echo "<br> ";
		echo "&nbsp;Attributions 1/2 (wip)";
		echo "<br> ";
						
						echo "<select $display_user_battle1>";
						$level_user=0;
						foreach ($users as $value) {
						    $selected = '';						
						    $level_user=$level_user+1;
						    if($level_user==$v+1){$selected = ' selected';}
						    echo "<option value='$level_user' $selected >$level_user $value </option>";
						}
						//echo "  <option value='user battle 1'>dadfredo (wip)</option>";
						//echo "  <option value='user0'>0</option>";
						//echo "  <option value='user1'>1</option>";
						//echo "  <option value='user2'>2</option>";
						//echo "    <option value='user3'>3</option>";
						
						echo "</select> ";



		echo "<br> ";

						echo "<select>";
						$level_user=0;
						foreach ($users as $value) {
						//$selected = '';						
						$level_user=$level_user+1;
						    // if($v==$level_user){$selected = ' selected';}
						    echo "<option value='$level_user' $selected >$level_user $value</option>";
						}
						//echo "  <option value='user battle 1'>dadfredo (wip)</option>";
						//echo "  <option value='user0'>0</option>";
						//echo "  <option value='user1'>1</option>";
						//echo "  <option value='user2'>2</option>";
						//echo "    <option value='user3'>3</option>";
						
						echo "</select> ";
		echo "<br> ";
		echo "</div>";
















		echo "        </td>";
		echo "    </tr>";
		echo "    <tr>";
		echo "        <td><br></td>";
		echo "    </tr>";
		echo "    <tr>";
		echo "        <td>";

/*		echo "<div id='drawBattleDiv' name='drawBattleDiv'>";
		echo "<a href='crud_draw/index.php?village=$village&N=$v' id='$village' >DRAW BATTLE</a>";
		echo "</div>";*/
		echo "        <div $display_draw_battle><a href='crud_draw/index.php?village=$village&N=$v&X=$screenWidth&Y=$screenHeight' id='$village' >PROPOSE BATTLE</a></div>";

		// echo "<div id='DIV_drawBattleDiv'  name='DIV_drawBattleDiv' style='position:relative;left:10px;top:0px;'>";
		// echo "<button id='drawBattleDiv' name='drawBattleDiv' style='padding-bottom:10px;' onclick='javascript:window.location.href(\"crud_draw/index.php?village=$v&N=$v\")'>DRAW BATTLE</button>";
		// echo "<button id='drawBattleDiv' name='drawBattleDiv' style='padding-bottom:10px;' onclick='goDraw($v)'>DRAW BATTLE</button>";



		// echo "</div>";


		echo"</td>";
		echo "    </tr>";

		echo "    <tr>";
		echo "        <td>";

		













		echo "    </tr>";








		echo "</table>";












		echo "</td>";
		echo "    </tr>";






echo "<tr style='vertical-align:middle !important;'>";
echo "<td style='background-color:#58ACFA;vertical-align:middle !important;'>";



echo "        <div $display_battle_proposees  style='vertical-align:middle !important;'>";

		$i = 0;
		$files = glob('crud_draw/'.$dirVillageAttaque.'/*.{jpg,JPG}', GLOB_BRACE);

		foreach($files as $file) {

			$filename = basename($file);

			$tmp = explode(".", $file);
			$txt = $tmp[0].".txt";
			$txtname = basename($txt);

			$tmp = explode("-", $txtname);
			$n = $tmp[0];

			if($n==$v){

				if($i%5==0 and $v!=0){echo "<br><br>";}

					if($i==0){
						$vn=$v+1;
						echo "<font color=white>VILLAGE ".$vn." : Attaques propos&eacute;es</font><br>";
					}

					echo "&nbsp;&nbsp;<a href='crud_draw/villageAttaque.php?village=".$filename."&txt=".$txtname."&X=".$screenWidth."&Y=".$screenHeight."' ><img src='".$file."' height='60' width='60'></a>";

				}

			$i++;

	}

		echo "        </div>";

echo "</td>";


echo "<tr><td colspan=2 style='background-color:black;'>end table</td></tr>";
echo "</table>";





		//echo "</table>";



		// echo "<br>";






		$v++;
}


?>





<script type="text/javascript">


	$('#divLoading').hide();


$('#navbarGDC').load('navbarGDC.php'); 


$(document).ready(function () {
    setInterval(function () {
        $("#navbarGDC").load('navbarGDC.php');
    }, 60000);


$.get( 
                  "admin/getName.php",
                  function(data) {
                    tmpN = data;
                    resN = tmpN.split(":");
                    resN = resN[1];
                    resN = resN.replace("\"", ""); 
                    resN = resN.replace("\"", ""); 
                    resN = resN.replace("}", ""); 
                    name = resN.replace("]", ""); 
                     // $('#clanName').val(name);
                     $('#clanName2').val(name);

                  }
               );


});


</script>



</body>