<!doctype html>


<?php 

include('inc_var_crud_draw.php');



$imgUnder =   htmlspecialchars($_GET["village"]);
$villageN =   htmlspecialchars($_GET["N"]);
$window_WIDTH =   htmlspecialchars($_GET["X"]);
$window_HEIGHT =   htmlspecialchars($_GET["Y"]);
$imgBattle =  $villageN.".png";

$attrib_unique_name= "_".$date; 


$size = getimagesize($imgUnder);
$X = $size[0];
$Y = $size[1];
$X2 = $X/2;
$Y2 = $Y/2;


$X_final = $X;
$Y_final = $Y;


// resize img Or Not



///////////// Canvas css

$canvas_record_panel_display = "none";

// $chooserWidgets_left = 500;
$chooserWidgets_left = $X+100;




?>


<html>
<head>
    <title>DRAW BATTLE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
    
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes"> <!--  for android -->
    <script src="lib/jquery/jquery-1.8.2.min.js"></script>
	
    <style type="text/css">
body {
    margin:0px;
    width:100%;
    height:100%;
    overflow:hidden;
    font-family:Arial;
    /* prevent text selection on ui */
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    /* prevent scrolling in windows phone */
    -ms-touch-action: none;
    /* prevent selection highlight */
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    
  /*  
    background-image:url(<?php echo $imgUnder;?>);
    background-size: <?php echo $window_WIDTH;?>px <?php echo $window_HEIGHT;?>px;
    background-position: 0px 0px;

    background-repeat: no-repeat;
    
    background-color: #222;   
    
    */
    
    margin: 0px;
    padding: 0px; 
    background-repeat: no-repeat;
    /*background-attachment: fixed;*/
    background-position: 0px 0px;    
    
    
}
        
.header, .footer_left{
    position: absolute;
    background-color: #222;
    text-align: center;
}
.header {
    top: 0px;
    left: 0px;
    right: 0px;
    height: 32px;
    padding:6px;
}

.clear_all {
    position: absolute;
    bottom: 50px;
    left: 0px;
    right: 0px;
    width:23%;
    height: 32px;
    padding:6px;
}

.header_right {
    top: 0px;
    position: absolute;
    right: 5px;

    height: 32px;
    padding:6px;
}

.footer {
    bottom: 0px;
    left: 0px;
    right: 0px;
    height: 42px;
    padding:2px;
    background-color: #222;
    position: absolute;
    opacity:0.7;
}
.footer_left {
    bottom: 0px;
    left: 0px;
    right: 0px;
    width:23%;
    height: 42px;
    padding:2px;  
    background-color: #222;
    display:block;
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
    display:block;
}
.title {
    position:absolute;
    left:100px;
    width: auto;
    line-height: 32px;
    font-size: 20px;
    font-weight: bold;
    color: #eee;
    text-shadow: 0px -1px #000;
    padding:0 60px;
}
.navbtn {
    cursor: pointer;
    float:left;
    padding: 6px 10px;
    font-weight: bold;
    line-height: 18px;
    font-size: 14px;
    color: #eee;
    text-shadow: 0px -1px #000;
    border: solid 1px #111;
    border-radius: 4px;
    background-color: #404040;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666;     
}
.navbtn-hover, .navbtn:active {
    color: #222;
    text-shadow: 0px 1px #aaa;
    background-color: #aaa;
    box-shadow: 0 0 1px 1px #444,inset 0 1px 0 0 #ccc;   
}

#content{
    position: absolute;
    /*top: 44px;*/
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    /*bottom: 46px;*/
    overflow:hidden;
    /*
    */    
    background-color:none;
    

}

#content_canvas_under_DES{
    position: absolute;
    top: 44px;
    left: 0px;
    right: 0px;
    bottom: 46px;
    overflow:hidden;
    width:<?php echo $window_WIDTH;?>;
    height:<?php echo $window_HEIGHT;?>;
     /*background-color:red;*/
}




#canvas{
    cursor:crosshair ;
    /*background-color:grey;*/
}

#canvas_under{
    /*width:100%;
    height:100%;*/
    width:924px;
    height:100%;
     /*background-color:green;*/
}


.palette-case {
    position:absolute;
    bottom:7px;
    left:160px;
    width:260px;
    margin:auto;
    text-align:center;
}
.palette-box {
    float:left;
    padding:2px 6px 2px 6px;
}
.palette {
    border:2px solid #777;
    height:22px;
    width:22px;
}
.red{
    background-color:#c22;
}
.blue{
    background-color:#22c;
}
.green{
    background-color:#2c2;
}
.white{
    background-color:#fff;
}
.black{
    background-color:#000;
    border:2px dashed #fff;
}



.hideTools{
    position:absolute;
    z-index: 999;
    bottom:5px;

}

.a_hideTools{
    position:absolute;
    bottom:0px;
    cursor: pointer;
    left:0px;
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
    display:block;
    width:50px;
}


.clearAll{
    position:absolute;
    bottom:5px;
    cursor: pointer;
    left:80px;
    /*float:left;*/
    padding: 6px 10px;
    font-weight: bold;
    line-height: 18px;
    font-size: 14px;
    color: #eee;
    text-shadow: 0px -1px #000;
    border: solid 1px #111;
    border-radius: 4px;
    background-color: #3cb0fd;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666; 
    display:block;
}

.save{
    position:absolute;
    bottom:5px;
    right:75px;
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
    background-color: green;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666; 
}

.showComments{

    position:absolute;
    bottom:5px;
    right:135px;
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




.backGDC{
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
    display:block;
}




.commentsDiv {
    z-index: 10000;
    display:none;
    position: absolute;
    width:200px;
    opacity:0.8;
/*    top:0;
 bottom: 0;*/
    right: 0px;
    top:0px;
    background-color: grey;
 /*    width:170px;
   height:270px;
*/
}


.save_inProgressDiv {
    z-index: 10001;
    display:none;
    position: absolute;
    width:200px;
/*    opacity:0.8;
    top:0;
 bottom: 0;*/
    right: 0px;
    top:0px;
    background-color: yellow;
    color: black;
 /*    width:170px;
   height:270px;
*/
}



    </style>
    
    
    
<script type="text/javascript">
	
	
var $window_width = $(window).width();
var $window_height = $(window).height();
//alert($window_width);
//alert($window_height);	
	
	
var ctx, color = "#000";	

$(document).ready(function () {





	// setup a new canvas for drawing wait for device init
    setTimeout(function(){
	   newCanvas();
    }, 1000);
		
	// reset palette selection (css) and select the clicked color for canvas strokeStyle
	$(".palette").click(function(){
		$(".palette").css("border-color", "#777");
		$(".palette").css("border-style", "solid");
		$(this).css("border-color", "#fff");
		$(this).css("border-style", "dashed");
		color = $(this).css("background-color");
		ctx.beginPath();
		ctx.strokeStyle = color;
	});
    
	// link the new button with newCanvas() function
	$("#new").click(function() {
		newCanvas();
	});
	
	$("#backGDC").click(function() {
		javascript:history.back();
		// window.close();
	});

	$("#save").click(function() {


      var r = confirm("Are you sure to Save this Battle Strategy !?");
      if (r == true) {


              saveCanvas();
              // javascript:history.back(); // prov solution
              // window.open('../gdc.php?X=<?php echo $window_WIDTH;?>&Y=<?php echo $window_HEIGHT;?>');
              window.location.replace("../gdc.php?X=<?php echo $window_WIDTH;?>&Y=<?php echo $window_HEIGHT;?>");
            

      }



	});

	$("#showComments").click(function() {
	  $( ".commentsDiv" ).toggle();
	});	
	
	$("#a_hideTools").click(function() {
	  $( ".footer" ).toggle();
	});	
	
	
    //function init() {
      // var touchzone = document.getElementById("canvas");
      // touchzone.addEventListener("touchstart", draw, false);
    //}	
	
	
	
});


function load_canvas_under_DES(){
	// Create canvas
	var ctx2 = document.getElementById('canvas_under').getContext('2d');
	var img = new Image();
	img.src = '<?php echo $imgUnder;?>';
	img.onload = function(){
	ctx2.drawImage(img, 0, 0);
	}
}


// function to setup a new canvas for drawing
function newCanvas(){




    // document.body.webkitRequestFullScreen;
    // window.scrollTo(0,1);
    // document.documentElement.requestFullscreen();	
	

	//define and resize canvas
	// var offset_Y = 90; // offset original
	var offset_Y = 0;
	//$("#content").height($(window).height()-offset_Y);
	// $("#content").width($(window).width()-offset_Y);
	// var canvas = '<canvas id="canvas" width="'+$(window).width()+'" height="'+($(window).height()-offset_Y)+'"></canvas>';
	
	
	$("#content").height($window_height);
	$("#content").width($window_width);	
	var canvas = '<canvas id="canvas" width="'+$window_width+'" height="'+$window_height+'"></canvas>';
	$("#content").html(canvas);
    
    // setup canvas
	ctx=document.getElementById("canvas").getContext("2d");
	// ctx.fillRect (event.touches[0].pageX, event.touches[0].pageY, 5, 5);
	ctx.strokeStyle = color;
	ctx.lineWidth = 5;	
	
	// setup to trigger drawing on mouse or touch
	$("#canvas").drawTouch();
	$("#canvas").drawPointer();
	$("#canvas").drawMouse();    

}

// prototype to	start drawing on touch using canvas moveTo and lineTo
$.fn.drawTouch = function() {
	//var offset_Y = 44; // offset original
	var offset_Y = 0;
	var start = function(e) {
        e = e.originalEvent;
		ctx.beginPath();
		x = e.changedTouches[0].pageX;
		y = e.changedTouches[0].pageY-offset_Y;
		ctx.moveTo(x,y);
	};
	var move = function(e) {
		e.preventDefault();
        e = e.originalEvent;
		x = e.changedTouches[0].pageX;
		y = e.changedTouches[0].pageY-offset_Y;
		ctx.lineTo(x,y);
		ctx.stroke();
	};
	$(this).on("touchstart", start);
	$(this).on("touchmove", move);	
}; 
    
// prototype to	start drawing on pointer(microsoft ie) using canvas moveTo and lineTo
$.fn.drawPointer = function() {
	// var offset_Y = 44; // offset original
	var offset_Y = 0;
	var start = function(e) {
        e = e.originalEvent;
		ctx.beginPath();
		x = e.pageX;
		y = e.pageY-offset_Y;
		ctx.moveTo(x,y);
	};
	var move = function(e) {
		e.preventDefault();
        e = e.originalEvent;
		x = e.pageX;
		y = e.pageY-offset_Y;
		ctx.lineTo(x,y);
		ctx.stroke();
    };
	$(this).on("MSPointerDown", start);
	$(this).on("MSPointerMove", move);
};        

// prototype to	start drawing on mouse using canvas moveTo and lineTo
$.fn.drawMouse = function() {
	// var offset_Y = 44; // offset original
	var offset_Y = 0;
	var clicked = 0;
	var start = function(e) {
		clicked = 1;
		ctx.beginPath();
		x = e.pageX;
		y = e.pageY-offset_Y;
		ctx.moveTo(x,y);
	};
	var move = function(e) {
		if(clicked){
			x = e.pageX;
			y = e.pageY-offset_Y;
			ctx.lineTo(x,y);
			ctx.stroke();
		}
	};
	var stop = function(e) {
		clicked = 0;
	};
	$(this).on("mousedown", start);
	$(this).on("mousemove", move);
	$(window).on("mouseup", stop);
};


function saveCanvas()
{


    $( ".footer" ).hide();
    $( ".save_inProgressDiv" ).show();


	var typeAttaque = document.getElementById("typeAttaque").value;
	var comment = document.getElementById("comment").value;
	var auteurAttaque = document.getElementById("auteurAttaque").value;

	/*$caracteres = array(
	' ' => 'a',
	'_' => 'a',
	'-' => 'a',
	'.' => 'a',
	'#' => 'a',
	'é' => 'a',



	'À' => 'a', 
	'Á' => 'a', 
	'Â' => 'a', 
	'Ä' => 'a', 
	'à' => 'a', 
	'á' => 'a', 
	'â' => 'a', 
	'ä' => 'a', 
	'@' => 'a',
	'È' => 'e', 
	'É' => 'e', 
	'Ê' => 'e', 
	'Ë' => 'e', 
	'è' => 'e', 
	'é' => 'e', 
	'ê' => 'e', 
	'ë' => 'e', '€' => 'e',
	'Ì' => 'i', 'Í' => 'i', 'Î' => 'i', 'Ï' => 'i', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
	'Ò' => 'o', 'Ó' => 'o', 'Ô' => 'o', 'Ö' => 'o', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'ö' => 'o',
	'Ù' => 'u', 'Ú' => 'u', 'Û' => 'u', 'Ü' => 'u', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'µ' => 'u',
	'Œ' => 'oe', 'œ' => 'oe',
	'$' => 's');*/


	if (auteurAttaque =='') {
	    auteurAttaque = "Anonymous";
	} else {
		// nettoyage des caracteres speciaux
		auteurAttaque = auteurAttaque.replace(' ', '');
		auteurAttaque = auteurAttaque.replace('_', '');
		auteurAttaque = auteurAttaque.replace('-', '');
		auteurAttaque = auteurAttaque.replace('.', '');
		auteurAttaque = auteurAttaque.replace('#', '');

		auteurAttaque = auteurAttaque.replace('é', '');
	} 

	if (typeAttaque =='') {
	    typeAttaque = "No attack Type";
	}

	if (comment =='') {
	    comment = "No comments";
	}










	var canvasData = canvas.toDataURL("image/png");
	// alert(canvasData);
	var ajax = new XMLHttpRequest();
	// ajax.open("POST",'saveCanvas.php?village=http://127.0.0.1/zemelattitude2/admin/upload/server/php/files/Screenshot_2015-06-25-21-27-08.JPG&N=3',false);
	ajax.open("POST",'saveCanvas.php?village=<?php echo $imgUnder;?>&N=<?php echo $villageN;?>&typeAttaque='+typeAttaque+'&comment='+comment+'&auteurAttaque='+auteurAttaque+'&date=<?php echo $date;?>',false);
	ajax.setRequestHeader('Content-Type', 'application/upload');
	ajax.send(canvasData );

	// closeCanvas();
	
	

	setTimeout(function(){ document.getElementById("typeAttaque").value="" }, 500);
	setTimeout(function(){ document.getElementById("comment").value="" }, 500);
	setTimeout(function(){ document.getElementById("auteurAttaque").value="" }, 500);


    



	// newCanvas();	

	

}




function fullScreen(){
//alert('toto');
// document.body.webkitRequestFullScreen;
window.scrollTo(0,1);
// document.documentElement.requestFullscreen();

}


//document.body.requestFullscreen();
// document.documentElement.requestFullscreen();





function hideAddressBar()
{
  if(!window.location.hash)
  {
      if(document.height < window.outerHeight)
      {
          document.body.style.height = (window.outerHeight + 50) + 'px';
      }

      setTimeout( function(){ window.scrollTo(0, 1); }, 50 );
  }
}

window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
window.addEventListener("orientationchange", hideAddressBar );

window.addEventListener("load", setTimeout( function(){ window.scrollTo(0, 1) }, 100));






</script>
	
	
</head>
<!--
<body style="background-image:url(<?php echo $imgUnder;?>);background-size: <?php echo $window_WIDTH;?>px <?php echo $window_HEIGHT;?>px;">

<body style="background-image:url(<?php echo $imgUnder;?>);">
-->
<script>

// document.write('<body style="background-image:url(<?php echo $imgUnder;?>);background-size: <?php echo '+window_width+';?>px <?php echo '+window_height+';?>px;">');
document.write('<body style="background-image:url(<?php echo $imgUnder;?>);background-size:'+$window_width+'px '+$window_height+'px;">');
//document.write('<body style="background-image:url(<?php echo $imgUnder;?>);background-size:100px 100px;">');

</script>
<div id="page">


<!--                           FORM COMMENTS                                      -->
<div id="commentsDiv" name="commentsDiv" class="commentsDiv">
<?php
include('form_comments.php');
?>
</div>       

    
    
<div id="content"><p style="text-align:center">Loading Canvas...</p></div>
    
		    
		    
		    
    
		    
		    
		    
		    
		<div id="hideTools" class="hideTools"><a id="a_hideTools" class="a_hideTools">Toggle</a></div>   
		    
		<!--                           TOOLZ BAR                          -->    
		<div id="footer" class="footer">
		      

				<a id="new" class="clearAll">Clear All</a>     
				
				
				
				<div class="palette-case">
					<div class="palette-box">
						<div class="palette white"></div>
					</div>	
					<div class="palette-box">
						<div class="palette red"></div>
					</div>
					<div class="palette-box">
						<div class="palette blue"></div>
					</div>
					<div class="palette-box">
						<div class="palette green"></div>
					</div>
					<div class="palette-box">
						<div class="palette black"></div>
					</div>		
					<div style="clear:both"></div>
				</div>		
				
				

				
				<a id="backGDC" class="backGDC">Close</a>
				<a id="showComments" class="showComments">Add Comments</a>	
				<a id="save" class="save">Save</a>
				






<!-- <div id="save_inProgressDiv" class="save_inProgressDiv">
    save in Progress, please ...
</div> -->





		      
		</div>   
    
</div>   
    

    
</body>
</html>
