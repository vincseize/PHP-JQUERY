<?php
// Start the session
session_start();
require_once('../inc/inc.php');
require_once('../inc/define.php');
require_once('../inc/fcts.php');
?>
<?php
	// define('PATH_STG', '/'.$_SESSION["NAME_FOLDER_APP"].'/_storygraph'); // todo better
	require_once('../inc/fcts.php');
?>
<?php



//$files = getCasesThumb("../**/*.jpg");
// $files = getCasesThumb("../**/thumbs/case_*_bg.*");
// print_r($files);
?>
<style>
	:root {
	  --st-color-dark-black:#171714;

	  --st-color-grey1:#222;
	  --st-color-grey2:#333;
	  --st-color-grey3:#444;
	  --st-color-grey4:#575757;
	  --st-color-grey5:#858484;
	  --st-color-grey6:#B7B6B6;

	  --st-color-blue1:#3cb0fd;
	  --st-color-blue2:#3cb0fd;
	  --st-color-blue3:#069;
	  --st-color-blue6:#0D3246;

	  --st-main-bg-color: var(--color-dark-black);
	}

	html,body {
	  height: 100%;
	  margin:0;
	  padding:0;
	  background-color: var(--st-color-grey2);
	}
</style>
<script>
	var w = (window.innerWidth/100)*15;
	console.log(w);
</script>


	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/cytoscape.min.js"></script>
	<script src="js/dagre.min.js"></script>
	<script src="js/cytoscape-dagre.js"></script>
	<!-- <link rel="stylesheet" href="<php echo $_SESSION["PATH_STG_WWW"];?>/css/storygraph.css"  type="text/css"> -->
	<link rel="stylesheet" href="css/storygraph.css"  type="text/css">


<style>
.container_menuSTG_DZS {

    display : flex;
	width:calc(100%-16px);
	min-width:calc(100%-16px);

    border: 1px solid black;
    background: red;
    padding: 0px;
    margin: 0px;
    flex: 1;

	position: absolute;
	top:0px;
	/*width: calc(15% + 32px);*/

	z-index: 8889;
}

.btn_menuSTG_DES {
	width:100%;
	min-width: 25%;
}


div.container_menuSTG {
		position: absolute;
		top:0px;
    width: 100%;
    display: table;
}

div.cell_menuSTG {
    /*border:1px solid red;*/
    display: table-cell;
}

/*#text {
    width:1%;
    white-space:nowrap;
}*/

.btn_menuSTG{
       width:100%;
	   	background-color: var(--st-color-grey1);
	   	border: 1px solid #444;
}

.btn_menuSTG:hover{
	   	background-color: var(--color-blue3);
}





</style>




<div id="parent" class="menuLeft_ST" >








    <div class="child">


<!-- <button id="buttonTEST">TEST</button> -->



				<div class="container_menuSTG">
				    <div class="cell_menuSTG">
				        <!-- <button id="fit" class="btn_menuSTG" title="Show All"><i class="fa fa-eye"></i></button> -->
						<button id="fit" class="btn_menuSTG" title="Show All"><i class="fa fa-arrows-alt"></i></button>
				    </div>
				    <div class="cell_menuSTG">
				        <button id="deleteNodes" class="btn_menuSTG" title="Delete Selected"><i class="fa fa-trash-o"></i></button>
				    </div>
				    <div class="cell_menuSTG">
				        <button id="save" class="btn_menuSTG" title="Save"><i class="fa fa-save"></i></button>
				    </div>
				    <div class="cell_menuSTG">
				        <button id="clear" class="btn_menuSTG" title="Clear Graph"><i class="fa fa-eraser"></i></button>
				    </div>
<!-- 				    <div class="cell_menuSTG">
				        <button id="todo_ST" class="btn_menuSTG" title="Todo"><i class="fa fa-bell-o"></i></button>
				    </div> -->
				    <div class="cell_menuSTG">
				        <button id="help_ST" class="btn_menuSTG" title="Help"><i class="fa fa-question-circle"></i></button>
				    </div>
				</div>


					<span id="nbNodes"></span><br><br> <!-- // infos save delete etc -->


<!--

									<div id="menuTop_STG" style="display:none">





																<div class="menuTop_left_ST" style="padding:0px;margin:0px;">
																	<button id="fit" class="bt_Storygraph">Show All</button>
																	<select id="layoutCh" class="layoutCh">
																		<option value="dagre" selected>Dagre</option>
																		<option value="breadthfirst">Breadthfirst</option>
																		<option value="grid">Grid</option>
																		<option value="cose">Cose</option>
																		<option value="circle">Circle</option>
																		<option value="concentric">Concentric</option>
																		<option value="random">Random</option>
																	</select>

																	<button id="redraw" class="bt_Storygraph">Re Draw</button>

																	<button class="disabled bt_Storygraph" title="Delete Selected" id="deleteNodes">Delete selected<i class="fa fa-close"></i></button>
																</div>


																<div class="menuTop_Right_ST">
																	<span id="nbNodes"></span><br>
																	<button id="load" class="bt_Storygraph">Charger</button>
																	<button id="save" class="bt_Storygraph">Save</button>
																	<button id="emptyLS" class="bt_Storygraph">Cancel</button>
																	<button id="clear" class="bt_Storygraph">Clear Graph</button>
																</div>



									</div>
 -->



    </div>




<!-- <br>   // to do better -->








    <!-- <div class="child">&nbsp;<hr /></div> -->

<!-- <br>   // to do better -->

    <div class="child">

							<!-- <div class="nodeModel caseM" data-type="case">Asset</div> -->
							<div class="nodeModel sequenceM" data-type="sequence">Sequence</div>
							<div class="nodeModel caseM"  data-type="case">Case</div>
							
    </div>

    <div class="child">&nbsp;<hr /></div>

<!-- 	<div class="child debug">&nbsp;<hr />
		<iframe id="iframe_todo" class="iframe_todo">todo</iframe>
    </div> -->

    <div class="child">



		<div>
					<!-- <button id="help_ST" class="help_ST">Help</button> -->



					<div id="menuLeft_ST_memo" class="menuLeft_ST_memo">



<?php 

include('../_help/index.php')
 ?>


<!-- 
						<p>Drag and Drop element on screen</p>


						<ul>
							<b>Zoom</b> : <li>Molette souris</li>
							<b>Pano</b> : <li>Click+drag sur le fond</li>
							<b>Sélection</b> :
								<li>Box-select -> SHIFT + click + drag</li>
								<li>Multiple -> SHIFT + click sur les nodes</li>
							<b>Menu contextuel</b> :
								<li>Clic-droit sur node -> actions du node</li>
								<li>Clic-droit sur fond -> actions génériques</li>
							<b>Connexions Manuelles</b> :
								<li>Sélectionner des nodes (avec SHIFT+clic ou le box-select), puis
								CRTL+click sur un node pour les connecter à ce dernier.</li>
								<li><b>Directions autorisées :</b></li>
								<li>&nbsp;&nbsp;&nbsp; -> Asset vers Asset(s)</li>
								<li>&nbsp;&nbsp;&nbsp; -> Asset vers Sequence(s)</li>
								<li>&nbsp;&nbsp;&nbsp; -> Sequence vers Sequence(s)</li>
							<b>Mémoire :</b>
								<li>
									Bouton "Charger" : charge un graphe depuis la mémoire
									du navigateur si présente, sinon charge depuis un fichier json sur le serveur.
								</li>
								<li>Bouton "Mémoriser" : mémorise le graphe courant dans la mémoire du navigateur.</li>
								<li>Bouton "Oublier" : Vide la mémoire du navigateur</li>
						</ul> -->
					</div>
				</div>
		</div>


    </div>



</div>








	<div class="container_storygraph" id="container" height="100%" style="padding:0px;margin:0px;top:0px;height:100%;"></div>

	<div id="contextMenu">
		<div class="ctxNodeTitle overNode"></div>
		<div class="ctxMenuEntry nodeAction" id="renameNode">Rename</div>
		<div class="ctxMenuEntry nodeAction disabled">Isoler</div>
		<div class="ctxMenuEntry nodeAction disabled">Select child(s)</div>
		<div class="ctxMenuEntry nodeAction" id="deleteNode">Delete</div>
<!-- 		<div class="ctxMenuEntry nodeAction ">Disconnect</div> -->
		<hr  />
<!-- 		<div class="ctxMenuEntry" id="fitM">Show all</div> -->
		<div class="ctxMenuEntry nodeAction" id="addToSequence">Add Selected to Sequence</div>
		<hr />
<!-- 		<div class="ctxMenuEntry addNode" data-type="case">Add case</div>
		<div class="ctxMenuEntry addNode" data-type="sequence">Add sequence</div> -->

		<!-- <div class="ctxMenuEntry addNode" data-type="shot">Ajouter un shot</div> -->

		<!-- <hr /> -->
		<div class="ctxMenuEntry" id="clearM">Clear graph</div>
	</div>

	<script src="/<?php echo $_SESSION["NAME_FOLDER_APP"];?>/_storygraph/js/storygraph.js">
		
		// var cy0 = cy;
		// console.log(cy0);
		// document.write(cy0);
	</script>


<script>





$(document).ready(function(){

    url = "todo/index.html";
    // $('#iframe_todo').load(url);
    $("#iframe_todo").attr("src", url);
 
    $('#todo_ST').on("click", function(){
    	$("#iframe_todo").css('z-index', '9999999');
    	$("#close-pg").css('z-index', '9999999');
    	$('#close-pg').fadeIn('slow');
    	console.log('todo');
    });   

	$('#help_ST').on("click", function(){
		$('#menuLeft_ST_memo').toggle();
	});

    $('#bt_param').on("click", function(){
    	console.log('param click from graph.php');
        $("#iframe_todo").css('z-index', '0');
        closePG_gr();
    });


	function closePG_gr(){
		$('#close-pg').hide();
		$('#header').fadeIn("fast");
		$('#footer').fadeIn("fast");

		$('#wrapper-pg').hide();
		$('#wrapper').show();
		$('#bottom').empty('');

		$('#left').hide();
		//$('#bottom').load('_storygraph/graph.php');

		$('#right_pane').empty('');
		//$('#right_pane').load('assets_bin.php');
		//$('#right_pane').load('sequences_bin.php');
	}





	// // Bouton FIT
	// $('#fit,fitM').click(function(){
	// 	cy.fit();
	// 	console.log('show all clicked');
	// });




	//var ele = cy.getElementById( '1' );
	// cy.$('#15').css({"backgroundColor": "red", "color": "red"});




	function stg_bg_Nodes_BGimg(id=false){
		// var project = '<?php echo $_SESSION["PROJECT"];?>';
		var project = '1_aufildeleau';
		
				$.ajax({
			       //url: "/<?php echo $_SESSION["NAME_FOLDER_APP"];?>/cases_get_bg.php",
			       url: "cases_get_bg.php",
			       type : 'GET',
			       // data: { variable: 'value' }, 
			       dataType : 'json', // On désire recevoir du HTML
			       success : 	function(data, statut){
						       		// console.log('--- success ---');
						       		// console.log(data);
						       		// console.log('-----------');
									for (var i in data) {
						                // console.log(i);
						                // console.log(data[i]);
						                if(id!=false){ i=id;}
						                var bg_img = data[i];
						                
						                // console.log(project);
						                var url = '__projects/'+project+'/cases/case_'+i+'/thumbs/'+bg_img;
						                cy.$('#'+i).css({"background-image": url, "background-fit": "cover"});
						                // cy.$('#15').css({"backgroundColor": "red", "color": "red"});
									}
					},

				   error : 		function(resultat, statut, erreur){
							   		console.log('----- error ------');
									console.log(resultat);
									console.log(statut);
									console.log(erreur);
									console.log('-----------');
				   },

				   complete : 	function(resultat, statut){
									// console.log('complete');
				   }

				});
		
	}    	

	stg_bg_Nodes_BGimg();


});

// When all loaded
$(window).load(function() {
	// $( '#fit,fitM').click (); // todo better

});


</script>

