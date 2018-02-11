<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Card Uploader</title>
  
	  
	<!--   <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'> -->
	<!-- 	<link rel='stylesheet' href='css/font-awesome.min.css'>-->
	<link rel="stylesheet" href="css/style_Kcard.css"> 



    <!-- Bootstrap core CSS -->
<!--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/jquery.dm-uploader.min.css" rel="stylesheet">
    <link href="css/styles.dm-uploader.css" rel="stylesheet">


<!-- https://github.com/danielm/uploader -->





  
</head>

<body>

  <div class="row_Kcard">



  															
										
<style>
.dm-uploader{
	width: var(--Kcard_img-width);
	height: var(--Kcard_img-height);
	z-index: z-index: var(--Kcard_layers-zIndex);
	position: absolute;
	top:0px;
	border:none;
}
.dm-uploader.active{
	background-color: blue;
	opacity:0.5;
}
.dm-uploader-button{
	width: var(--Kcard_dmUploader-width);
	height: var(--Kcard_dmUploader-height);
	z-index: var(--Kcard_layers-zIndex);
	top: calc(var(--Kcard_img-height) - var(--Kcard_dmUploader-height));
/*	opacity:0.5;*/
	font-weight: bold;
	border: 0px;
	border-radius: 0px;
	display: none;
}

.text-success{color:white}




@import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);

@import url(http://weloveiconfonts.com/api/?family=fontawesome);





[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

*, *:before, *:after {
  box-sizing: border-box;
}

body {
	background: #ccc;
	margin: 0;
	font-size: 16px;
	font-weight: 400;
	color: #F3F3F3;
  -webkit-font-smoothing: antialiased;
}

nav {
  width: 100%;
  min-width: 600px;
  overflow: hidden;
}
 
ul {
  display: flex;
	padding: 0;
	margin: 0;
	list-style-type: none;
}
 
.flex {
	flex: 1;
/*	max-width:50px;*/

width: 100%;

	background: #1A1A1A;
	padding: 1em;
  border-right: 1px solid #222;
	text-align: center;
	transition: all .2s;

		  margin:0px;
	  padding: 0px;

}
 
	.flex:hover {
		background: #1E6B47;
		cursor: pointer;

  }
 
.fixed {
	display: inline-flex;
	background: #1E6B47;
	padding: 1em;
	transition: all .3s;
}
 
	.fixed:hover { 
/*    width: 30%;*/
width: 100%;
  }
 
.fontawesome-search input {
	flex: 1;
	background: transparent;
	height: 100%;
	margin-left: 13px;
	border: 0;
/*	font-family: 'Montserrat', sans-serif;*/
	font-family: 'FontAwesome';
	font-size: 1em;
	color: #F3F3F3;
	outline: none;


text-indent: 30px;

}

 
	.nav-nav-menu-bin-search input:focus {
		border: 0;
	  outline: none;
  }
 
.fontawesome-search {
  text-indent: .3em;
  width: 55px;
}

	.nav-menu-bin-button {
	  width: 100%;
	  height:100%;
	  margin:0;
	  padding: 0px;
	  background-color: black;
  }

.navdiv {
  width: 100%;
  background: red;
  resizeXXX: horizontal;
  overflow: auto;
}


.search {
  position: relative;
  color: #aaa;
  font-size: 16px;
}

.search input {
  width: 250px;
  height: 32px;

  background: #fcfcfc;
  border: 1px solid #aaa;
  border-radius: 5px;
  box-shadow: 0 0 3px #ccc, 0 10px 15px #ebebeb inset;
}





.container-4{
  overflow: hidden;
  width: 300px;
  vertical-align: middle;
  white-space: nowrap;
}

.container-4 input#search{
		font-family: 'FontAwesome';
  width: 300px;
  height: 50px;
  background: #2b303b;
  border: none;
  font-size: 10pt;
  float: left;
  color: #fff;
  padding-left: 15px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
}

.container-4 input#search::-webkit-input-placeholder {
   color: #65737e;
}
 
.container-4 input#search:-moz-placeholder { /* Firefox 18- */
   color: #65737e;  
}
 
.container-4 input#search::-moz-placeholder {  /* Firefox 19+ */
   color: #65737e;  
}
 
.container-4 input#search:-ms-input-placeholder {  
   color: #65737e;  
}

.container-4 button.icon{
  -webkit-border-top-right-radius: 5px;
  -webkit-border-bottom-right-radius: 5px;
  -moz-border-radius-topright: 5px;
  -moz-border-radius-bottomright: 5px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
 
  border: none;
  background: #232833;
  height: 50px;
  width: 50px;
  color: #4f5b66;
  opacity: 0;
  font-size: 10pt;
 
  -webkit-transition: all .55s ease;
  -moz-transition: all .55s ease;
  -ms-transition: all .55s ease;
  -o-transition: all .55s ease;
  transition: all .55s ease;
}

.container-4:hover button.icon, .container-4:active button.icon, .container-4:focus button.icon{
  outline: none;
  opacity: 1;
  margin-left: -50px;
}
 
.container-4:hover button.icon:hover{
  background: white;
}



</style>	



<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="box">
  <div class="container-4">
    <input type="search" id="search" placeholder="&#61447; Search..." />
    <button class="icon"><i class="fa fa-search"></i></button>
  </div>
</div>


<!-- <div class="navdiv"> -->
<nav class="navdiv">
  <ul>

    <li class="fixed fontawesome-search">
    	<span class="fa fa-search"></span>
      <input class="nav-nav-menu-bin-search" type="text" placeholder="&#61447; Search">




    </li>

    <li class="flex"><button class="nav-menu-bin-button">Item 1</button></li>
    <li class="flex">Item 2</li>
    <li class="flex">Item 3</li>
    <li class="flex">Item 4</li>
    <li class="flex">Item 5</li>
<!--     <li class="fixed fontawesome-search">
      <input class="nav-nav-menu-bin-search" type="text" placeholder="Search">
    </li> -->
  </ul>
</nav>
<!-- </div> -->


<br><br>



		<div ID_wrapper_Kcard="wrapper_Kcard" class="wrapper_Kcard">

					<!-- /* overlayed */ -->
					<div class="Kcard_stick"><span>stick</span></div>
					<div class="Kcard_label"><span><br>label</span></div>
<!-- 					<div id="Kcard_menu" class="Kcard_menu">
					        <span>MENU</span>
					</div> -->

					<!-- /* vertically ordered */ -->
					<div class="Kcard_header">
					        <span>HEADER</span>
					</div>

					<div class="Kcard_img">



 						<!-- uploader -->
<!-- 						<div id="drag-and-drop-zone" class="dm-uploader">
							<div id="ID_dm-uploader-button" class="btn btn-primary dm-uploader-button">
							    <span>Upload file(s)</span>
							    <input type="file" title='Click to Upload file(s)' />
							</div>
						</div> -->
						<!-- /uploader -->


					</div>


						<!-- file list -->   
<!-- 			          <div style="margin:0px;padding:0px; ">
			            <ul class="list-unstyled p-2 d-flex flex-column col" id="files" style="margin:0px;padding:0px; ">
			            </ul>
			          </div> -->
						<!-- /file list -->






					<div class="Kcard_content">       
					    <input bt="ID_dm-uploader-button" id="Kcard_openMenu" class="Kcard_openMenu_input" type="checkbox">
 					    <label for="Kcard_openMenu"  class="Kcard_openMenu_label" title="more">...</label>
												<!--
													<div id="Kcard_menu" class="Kcard_menu">
														<span>MENU</span>
													</div> 
												-->


						<span class="Kcard_content-title">CONTENT title</span>
						<p class="Kcard_content-content">CONTENT Content</p>
					</div>

					<div class="Kcard_footer">
					        <span>FOOTER</span>
					</div>
					<!-- /* end vertically ordered */ -->

		</div>


</div>
  																








<main role="main" class="container">



      <div class="row">
        <div class="col-md-6 col-sm-12">
          

          <!-- uploader -->
          <!-- Our markup, the important part here! -->
         <div id="drag-and-drop-zone" class="dm-uploader p-5">
            <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

            <div class="btn btn-primary btn-block mb-5">
                <span>Open the file Browser</span>
                <input type="file" title='Click to add Files' />
            </div>
          </div> 
          <!-- /uploader -->


        </div>

<!-- file list -->   
        <div class="col-md-6 col-sm-12">
          <div class="card h-100">
            <div class="card-header">
              File List
            </div>

            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
              <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
          </div>
        </div>
      </div>
<!-- /file list -->

<!--       <div class="alert alert-info" role="alert">
        More setup demos on: <a href="https://danielmg.org/demo/java-script/uploader/basic">https://danielmg.org/demo/java-script/uploader/basic</a>
      </div> -->

      <div class="row">
        <div class="col-12">
           <div class="card h-100">
            <div class="card-header">
              Debug Messages
            </div>

            <ul class="list-group list-group-flush" id="debug">
              <li class="list-group-item text-muted empty">Loading plugin....</li>
            </ul>
          </div>
        </div>
      </div> <!-- /debug -->

    </main> <!-- /container -->



<!--     <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> -->
    <script src="js/jquery-3.2.1.min.js""></script>
<!--     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
 -->
    <script src="/js/bootstrap.min.js"></script>

    <script src="js/jquery.dm-uploader.min.js"></script>
    <script src="js/Kcard_uploader-ui.js"></script>
    <script src="js/Kcard_uploader-config.js"></script>

    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>



















<script type="text/javascript">

	$("#Kcard_openMenu").click(function(){
		var id_bt = $(this).attr('bt');
		// var id_bt = "ID_dm-uploader-button";
/*		console.log(id_bt);*/
	    // $("#ID_dm-uploader-button").toggle();
	    $("#"+id_bt).toggle();
	});

</script>










</body>

</html>
