<html>

<meta http-equiv="cache-control" content="max-age=0">
<meta http-equiv="cache-control" content="no-cache">
<meta http-equiv="expires" content="-1">
<meta http-equiv="expires" content="Tue, 01 Jan 1980 11:00:00 GMT">
<meta http-equiv="pragma" content="no-cache">




        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">




        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
        <link href="css/font-awesome.min.css"
        rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css"
        rel="stylesheet" type="text/css">


<?php

/*$village = "imagesVillagesBattles/$v.jpg";
$txt = "imagesVillagesBattles/$v.txt";

*/

include('inc_var_crud_draw.php');


$v = $_GET['village']; 
// echo "<br><br><br><br>".$v;
$village = $path_folder_save."/".$_GET['village'];
$comments = $path_folder_save."/".$_GET['txt'];
$window_WIDTH =   htmlspecialchars($_GET["X"]);
$window_HEIGHT =   htmlspecialchars($_GET["Y"]);

//$tmp = explode(".", $v);
//$txt = $tmp[0].".txt";
//$txtname = basename($txt);
//$comments = $path_folder_save."/".$txtname;





$myfile = fopen($comments, "r") or die("Unable to open file!");



$data = "";
while(! feof($myfile))
  {
  $tmp = fgets($myfile);
  $data = $data.$tmp;
  }


$tmp =explode(";", $data);
$title = $tmp[0];
$corpus = $tmp[1];
$sign = $tmp[2];

fclose($myfile);




?>

<head>

<style>

  
body {
    background-color: black;

    margin:0;
    padding:0;    
    width:100%;
    height:100%;
    overflow:hidden;
    font-family:Arial;
    
    /* 
    
    background: url(<?php echo $village; ?>) no-repeat center center fixed;  
    -webkit-background-size: cover; /* pour Chrome et Safari 
    -moz-background-size: cover; /* pour Firefox 
    -o-background-size: cover; /* pour Opera 
    background-size: cover; /* version standardisée   
    
*/

}
  
  



.btn_close {
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
}

.btn_close:hover {
  background: #3cb0fd;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}


.btn_delete {
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
}

.btn_delete:hover {
  background: #222;
  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
  text-decoration: none;
}




.footer_right {
    bottom: 0px;
    /*left: 0px;*/
    right: 0px;
    width:23%;
    height: 42px;
    padding:2px;  
    /*background-color: #222;*/
    background-color: none;
}

.backGDC{
    position:absolute;
    bottom:55px;
    left:10px;
    cursor: pointer;
    /*float:left;*/
    padding: 6px 10px;
    font-weight: bold;
    line-height: 18px;
    font-size: 14px;
    color: #eee;
    text-shadow: 0px -1px #000;
    border: solid 1px #111;
    border-radius: 4px;
    background-color: red;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666; 
}



.close{
    position:absolute;
    bottom:5px;
    left:140px;
    cursor: pointer;
    /*float:left;*/
    padding: 6px 10px;
    font-weight: bold;
    line-height: 18px;
    font-size: 14px;
    color: #eee;
    text-shadow: 0px -1px #000;
    border: solid 1px #111;
    border-radius: 4px;
    background-color: #2980b9;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666; 
}

.deleteBattle{
    position:absolute;
    bottom:5px;
    right:10px;
    cursor: pointer;
    /*float:left;*/
    padding: 6px 10px;
    font-weight: bold;
    line-height: 18px;
    font-size: 14px;
    color: #eee;
    text-shadow: 0px -1px #000;
    border: solid 1px #111;
    border-radius: 4px;
    background-color: red;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666; 
}

.hide_comments{
    position:absolute;
    bottom:5px;
    left:10px;
    cursor: pointer;
    /*float:left;*/
    padding: 6px 10px;
    font-weight: bold;
    line-height: 18px;
    font-size: 14px;
    color: #eee;
    text-shadow: 0px -1px #000;
    border: solid 1px #111;
    border-radius: 4px;
    background-color: black;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666; 
}

.commentsDiv {
    display:block;
    position: absolute;
    width:200px;
    opacity:0.9;
/*    top:0;
 bottom: 0;*/
    left: 10px;
    bottom:45px;
    background-color: grey;
 /*    width:170px;
   height:270px;
*/
}

</style>




<script type="text/javascript">


$(document).ready(function () {

	$("#close").click(function() {
		javascript:history.back();
		// window.close();
	});

	
	$("#deleteBattle").click(function() {
	  delete_battle();
	  setTimeout(function(){
		window.location.replace("../gdc.php?X=<?php echo $window_WIDTH;?>&Y=<?php echo $window_HEIGHT;?>");
	  }, 1000);
	  
	  
	  
	  
	});

	
	$("#hide_comments").click(function() {
	  $( ".commentsDiv" ).toggle();
	  $( ".deleteBattle" ).toggle();
	  $( ".close" ).toggle();	  
	});	
	
	
});	
	
	

function close_thisBattle()
{

  window.opener.location.reload();
  window.close();



}

function delete_battle()
{


/*      alert(ze_id);

      var id = ze_id;*/
      var r = confirm("Are you sure to Delete this Battle Strategy !?");
      if (r == true) {
        // document.getElementById("yesyoucan").style.display = "true";
          delete_battle_confirm();
          // close_thisBattle(ze_id);
          

          document.getElementById("commentsDiv").style.display = "none";

      }
}




function delete_battle_confirm(){

        var hr = new XMLHttpRequest();
        var url = "delete_battle.php";
        var vars = "id=<?php echo $v ; ?>";
        hr.open("POST", url, true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        hr.send(vars);
}


</script>


</head>


<body>

<div id="bgX">
		<img src="<?php echo $village; ?>">
</div>




<!--

<img src="<?php echo $village; ?>" class="superbg" />

<img src="<?php echo $village; ?>">-->


<div id="commentsDiv" name="commentsDiv" class="commentsDiv"  >



<input type="text" name="typeAttaque" style="width:200px;" id="typeAttaque" value="<?php echo $title ; ?>" disabled>



<textarea name="comment" id="comment" rows="10" style="width:200px;height:150px;" disabled><?php echo $corpus ; ?></textarea>   
<br>

<input type="text" name="auteurAttaque" id="auteurAttaque" style="width:200px;" value="<?php echo $sign ; ?>" disabled>







</div>
<!--
<div style="position:absolute;top:0px;"><a href="#" onclick="delete_battle();" class="btn_delete" href="">Delete this Battle</a></div>
<div style="position:absolute;top:110px;" id="btn_close" name="btn_close"><a href="#" onclick="close_thisBattle();" class="btn_close" href="">Close and go back to GDC</a></div>
-->

      <div class="footer_right">
      

	
		<a id="close" class="close">Close</a>	
  		<a id="deleteBattle" class="deleteBattle">Delete this battle</a>		
		<a id="hide_comments" class="hide_comments">Hide comments</a>	
		
      
      
 </div>



</body>
</html>
