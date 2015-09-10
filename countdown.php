
<?php

include('admin/getTimeleft.php');

include("getArray_etoiles_ennemyWin.php");
include("getArray_etoiles_teamLost.php");
include("get_nvillages.php");

include("js/script_select_battles_restantes.js");


include("calcul_etoiles.php");



$resT = explode(":",$countDate);
$resT = $resT[1];

$resT = str_replace("}","",$resT);
$resT = str_replace("]","",$resT);
$resT = str_replace("\"","",$resT);



$date = explode(";",$resT);

$day = $date[0];
$hour = $date[1];
$min = $date[2];
$sec = $date[3];

$dateRecup =  $date[4];
 
$resT = explode(";",$countDate);
$resT =  $resT[4];

$resT = str_replace("}","",$resT);
$resT = str_replace("]","",$resT);
$resT = str_replace("\"","",$resT);

$dateRecup=$resT;



$resT = explode(" ",$dateRecup);


$resT = $resT[0];
$resT = explode("-",$resT);




$CTthisYear=$resT[0];
$CTthisMonth=$resT[1];
$CTthisDay=$resT[2];



$resT = explode(" ",$dateRecup);


$resT = $resT[1];
$resT = explode(":",$resT);

$CTthisHour=$resT[0];
$CTthisMinute=$resT[1];
$CTthisSecond=$resT[2];


// n_battles_ennemy_used
$file = "n_battles_ennemy_used.txt";
if (file_exists($file)) {
    $n_battles_ennemy_used = file_get_contents($file);
}
else {
    $myfile = fopen($file, "w") or die("Unable to open file!");
    fwrite($myfile, 0);
    fclose($myfile);
    $n_battles_ennemy_used = file_get_contents($file);
}
// n_battles_team_used
$file = "n_battles_team_used.txt";
if (file_exists($file)) {
    $n_battles_team_used = file_get_contents($file);
}
else {
    $myfile = fopen($file, "w") or die("Unable to open file!");
    fwrite($myfile, 0);
    fclose($myfile);
    $n_battles_team_used = file_get_contents($file);
}

countdown($CTthisYear,$CTthisMonth,$CTthisDay,$CTthisHour,$CTthisMinute,$tot_battles,$n_team_victory,$n_ennemy_victory,$n_battles_team_used,$n_battles_ennemy_used);

function countdown($year, $month, $day, $hour, $minute,$tot_battles,$n_team_victory,$n_ennemy_victory,$n_battles_team_used,$n_battles_ennemy_used)
{
  // make a unix timestamp for the given date
  $the_countdown_date = mktime($hour, $minute, 0, $month, $day, $year, -1);

  // get current unix timestamp
  $today = time();

  $difference = $the_countdown_date - $today;
  if ($difference < 0) $difference = 0;

  $days_left = floor($difference/60/60/24);
  $hours_left = floor(($difference - $days_left*60*60*24)/60/60);
  $minutes_left = floor(($difference - $days_left*60*60*24 - $hours_left*60*60)/60);

  //echo "<br>";
  $color_gdc = "yellow";
  if ($days_left==0){
  $color_gdc = "#BCF5A9";
  }
  if ($days_left==0 and $hours_left==0){
  $color_gdc = "#FF0000";
  }

  	if ($days_left==0 and $hours_left==0 and $minutes_left==0){


    echo "<font color=grey>NO BATTLE IS RUNNING</font>";

	}
	else {





      echo "BATTLE AGAINST : ";
      echo "<input type='text' id='clanName2' name='clanName2' size='25' style=background-color:#202020;color:yellow;border:none;'>&nbsp;&nbsp;";
      echo "<br>";
      echo "<font color=".$color_gdc." >".$days_left." day ".$hours_left." hour(s) ".$minutes_left." minute(s)</font>";

    if ($days_left==0){

      echo "&nbsp;|&nbsp;";
      echo "<font color=".$color_gdc." >";


      // echo "us";
      echo TITLE_SITE;
      echo "&nbsp;";









      $colorwin="white";
      if($n_team_victory<$n_ennemy_victory){$colorwin="#FF8000";}
       // echo "[";  
       echo "<font size=4 color=$colorwin>";
      echo $n_team_victory;
      echo "</font>";
      echo "&nbsp;"; 
       // echo "]"; 

      echo "&nbsp;";
      echo "(";
      // echo $n_battles_team_used; 



      echo "<select id='select_n_battles_team_used' name='select_n_battles_team_used' style='background-color:#202020;' onchange=n_battles_team_used();>";
      // $selected =" ";


      
     for ($x = 0; $x <= $tot_battles; $x++) {
          
          // if(int($x)==int($n_battles_team_used)){
          if($x==$n_battles_team_used){
            $selected ="SELECTED";
          }
          else{
            $selected ="";            
          }


          echo "<option value='".$x."' ".$selected.">".$x."</option>";
      } 
  

      // echo "<option value='".$x."' ".$selected.">".$x."</option>";

      echo "</select> ";
















      echo "/";
      echo $tot_battles;
      echo ")";

      echo "&nbsp;";
      echo "/";
      echo "&nbsp;";
      echo "ennemy";
      echo "&nbsp;";




      $colorwin="white";
      if($n_ennemy_victory<$n_team_victory){$colorwin="red";}
       // echo "[";    
       echo "<font size=4 color=$colorwin>"; 
        echo $n_ennemy_victory;
/*       echo "]"; */
      echo "</font>";
      echo "&nbsp;"; 



      echo "&nbsp;";
      echo "(";
      // echo $n_battles_ennemy_used;  





      echo "<select id='select_n_battles_ennemy_used' name='select_n_battles_ennemy_used' style='background-color:#202020;' onchange=n_battles_ennemy_used();>";
      // $selected =" ";
 // onchange=getNbattle_restante($v);











     for ($x = 0; $x <= $tot_battles; $x++) {
          
          // if(int($x)==int($n_battles_team_used)){
          if($x==$n_battles_ennemy_used){
            $selected ="SELECTED";
          }
          else{
            $selected ="";            
          }


          echo "<option value='".$x."' ".$selected.">".$x."</option>";
      } 
  

      // echo "<option value='".$x."' ".$selected.">".$x."</option>";

      echo "</select> ";










      echo "/";
      echo $tot_battles;
      echo ")";

      echo "</font>";

    }



  }
}
?>


<script>

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

</script>