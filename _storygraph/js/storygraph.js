
// Cytoscape Init starts
var cy = cytoscape({

	container: $('#container'),
	wheelSensitivity: 0.2,
	zoom: 1.5,

	elements: [],

	style: [
		{
			selector: 'node',
			style: {
				'shape': 'rectangle',
				'width': '50',
				'height': '50',
				'padding-left': '10px', 'padding-right': '10px',
				'padding-top': '10px', 'padding-bottom': '10px',
				'background-color': '#DDD',
				'border-color': '#999',
				'border-width': '2px',
				'font-size': '11px',
				'color': '#333',
				'text-outline-color': '#DDD',
				'text-outline-width': '3px',
				'content': 'data(name)',
				'text-valign': 'center',
				'min-zoomed-font-size': '10px'
			}
		},

		// {
		// 	selector: 'node.cases',
		// 	style: {
		// 		'background-image': 'url(__projects/1_aufildeleau/cases/case_1/case_1_bg.jpg)',
		// 		'background-fit': 'cover'
		// 	}
		// },

		// {
		// 	selector: "node[id='11']",
		// 	style: {
		// 		    // $src_img = $path_assets."/".$asset."_".$number."/".$asset."_".$number."_bg.jpg";
		// 		    // $bg_img = $src_img."?". filemtime($path_assets."/".$asset."_".$number."/".$asset."_".$number."_bg.jpg");
		// 		'background-image': 'url(__projects/1_aufildeleau/cases/case_11/thumbs/case_11_bg.jpg)',
		// 		//'background-image': 'https://farm4.staticflickr.com/3063/2751740612_af11fb090b_b.jpg',
		// 		'background-fit': 'cover'
		// 		// 'border-width': 10,
  //       		// 'border-color': 'green'
		// 	}


		// },



		{
			selector: 'node.scenes',
			style: {
				'shape': 'rectangle',
				'width': 'label',
				'height': 'label',
				'background-color': '#585858',
				// 'background-image': 'url(../upload/_medias/cases/vignette.jpg)',

				'border-color': '#FFF',
				'color': '#fff',
				'text-outline-color': '#585858'
			}
		},
		{
			selector: 'node.master',
			style: {
				'background-color': '#000',
				'text-outline-color': '#000'
			}
		},
		{
			selector: 'node.scenes:selected',
			style: {
				// 'background-color': '#FA0'
			}
		},
		{
			selector: 'node.cases',
			style: {
				'shape': 'rectangle'
			}
		},
		{
			selector: 'node.cases:selected',
			style: {
				// 'background-color': '#BD0'
			}
		},
		{
			selector: 'node.sequences',
			style: {
				//'shape': 'hexagon'
				//'shape': 'ellipse'
				'shape': 'roundrectangle'
			}
		},
		{
			selector: 'node.sequences:selected',
			style: {
				// 'background-color': '#0AF'
			}
		},




{
    selector: '.sequences',
    style: {
        "width": '250px',
        "height": '120px',
		"border-radius": "4px"
    }
},




		{
			selector: 'node.highlight',
			style: {
				'background-color': '#FC0',
				'color': '#111',
				'border-color': '#FFF',
				'border-width': '2px',
				'text-outline-color': '#FC0'
			}
		},
		{
			selector: 'node.conxlight',
			style: {
				'color': '#000',
				'border-color': '#3F0',
				'border-width': '4px'
			}
		},
		{
			selector: 'node:selected',
			style: {
				'background-color': '#06C',
				'color': '#111',
				'border-color': '#FFF',
				'border-width': '2px',
				'text-outline-color': '#06C'
			}
		},
		{
			selector: 'edge',
			style: {
				'width': 1,
				// 'curve-style': 'unbundled-bezier',
				'curve-style': 'bezier',
				'mid-target-arrow-shape': 'none',
				'mid-target-arrow-fill': 'filled',
				'target-arrow-shape': 'triangle',
				'target-arrow-fill': 'filled'
			}
		},
		{
			selector: 'edge.scenesLine',
			style: {
				// 'line-color': '#A50',
				// 'mid-target-arrow-color': '#B60',
				// 'target-arrow-color': '#B60'
			}
		},
		{
			selector: 'edge.casesLine',
			style: {
				// 'line-color': '#680',
				// 'mid-target-arrow-color': '#790',
				// 'target-arrow-color': '#790'
			}
		},
		{
			selector: 'edge.shotsLine',
			style: {
				// 'line-color': '#05A',
				// 'mid-target-arrow-color': '#06B',
				// 'target-arrow-color': '#06B'
			}
		},
		{
			selector: 'edge:selected',
			style: {
				'line-color': '#FC0',
				'target-arrow-color': '#FC0'
			}
		},
		{
			selector: 'edge.highlight',
			style: {
				'mid-target-arrow-shape': 'triangle',
				'mid-target-arrow-color': '#FC0',
				'target-arrow-color': '#FC0'
			}
		}
	],


	layout: {
		name: 'dagre',
		animate: true
	}

});
// Cytoscape Init ends


var lastClickCoords  = [0,0];	// Pour sauver la position du clic-droit
var contextSelection = false;	// Pour garder en mémoire le node du clic-droit

var url_localstorage_graph_txt = '__projects/1_aufildeleau/localstorage_graph.txt';	

if (!localStorage.graph){ 

	localStorage.graph = ""; 

}

var layoutChoosen = "dagre";



// Document Ready starts
$(function(){

	if (localStorage.graph !== "") {
		var elems = JSON.parse(localStorage.graph);
		//console.log(localStorage.graph);
		// console.log(elems);
		if (elems.length) {
			// cy.add(elems);
			// cy.layout({'name': layoutChoosen, animate: true});

		}

	}

		






	// Get url_localstorage_graph_txt
	function GET_localstorage_graph_txt(src) {

	    $.get( url_localstorage_graph_txt , function( data ) {
	    	console.log(data);
	        var elems = JSON.parse(data); // can be a global variable too...
	        // process the content...
	        //console.log(elems);

	        if (elems.length) {
				cy.add(elems);
				// cy.layout({'name': layoutChoosen, animate: true});

			}

			
	    });

	return elems;

	}




	elems = GET_localstorage_graph_txt(url_localstorage_graph_txt);
	// console.log(elems);
 //    if (elems.length) {
	// 	cy.add(elems);
	// 	// cy.layout({'name': layoutChoosen, animate: true});
	// }







	// Highlight children on hover NODE
	cy.on('mouseover', 'node', function(e){
		e.cyTarget.addClass('highlight').outgoers().addClass('highlight');
		if (e.originalEvent.ctrlKey && cy.$(":selected").length)
			e.cyTarget.addClass('conxlight');
	});
	cy.on('mouseout', 'node', function(e){
		e.cyTarget.removeClass('highlight conxlight').outgoers().removeClass('highlight');
	});

	// Highlight children on hover EDGE // todo better
	cy.on('mouseover', 'edge', function(e){
		e.cyTarget.addClass('highlight').outgoers().addClass('highlight');
		e.cyTarget.addClass('conxlight').outgoers().addClass('conxlight');
		// if (e.originalEvent.ctrlKey && cy.$(":selected").length)
			e.cyTarget.addClass('highlight');
			e.cyTarget.addClass('conxlight');
	});
	cy.on('mouseout', 'edge', function(e){
		e.cyTarget.removeClass('highlight conxlight').outgoers().removeClass('highlight');
	});

	///////////// Menu principal //////////////

	// Choix du layout
	$('#layoutCh').on('change', function(){
		layoutChoosen = $(this).val();
		cy.layout({'name': layoutChoosen, animate: true});
	});

	// Bouton FIT
	$('#fit, #fitM').click(function(){
		cy.fit();
	});

	// Bouton REDRAW
	$('#redraw').click(function(){
		cy.layout({'name': layoutChoosen, animate: true});
	});

	// Bouton CLEAR
	$('#clear, #clearM').click(function(){
		if (!confirm("Are you REALLY sure to delete ALL graph(s) ?")) return; // alert confirm
		cy.remove('*');
		localStorage.graph = "";
		$('#save').trigger('click',[ "true" ]);
		$('#nbNodes').html("OK, Graph deleted").show();
	});

	// Comportement à la sélection
	cy.on('select', function(e){
		$('#deleteNodes').removeClass('disabled');
	});


	cy.on('unselect', function(e){
		if (! cy.$(':selected').length)
			$('#deleteNodes').addClass('disabled');
	});
	// Connexions manuelles
	function checkConnectable(srce, dest) {
/*		if (srce.hasClass('shots'))
			return false;*/
		if (srce.hasClass('sequences') && dest.hasClass('cases'))
			return false;
		if (srce.hasClass('cases') && dest.hasClass('sequences'))
			return true;
		if (srce.hasClass('cases') && dest.hasClass('cases'))
			return true;
		if (srce.hasClass('sequences') && dest.hasClass('sequences'))
			return true;
		return true;
	}
	cy.on('tapstart', 'node', function(e){
		if (!e.originalEvent.ctrlKey)
			return;
		var parents = cy.$(":selected");
		if (!parents.length)
			return;
		for (i=0; i<parents.length; i++) {
			var srce 	= parents.eq(i);
			var srceID 	= srce.data('id');
			var dest 	= e.cyTarget;
			var destID 	= dest.data('id');
			if (!checkConnectable(srce, dest))
				return true;
			var edge = {
				data: {
					id: "E"+srceID+destID,
					source: srceID,
					target: destID
				},
				group: "edges"
			}
			cy.add(edge);
			console.log("Connection to '"+dest.data('name')+"' done.");
		}
	});
	cy.on('tapend', 'node', function(e){
		if (e.originalEvent.ctrlKey) {
			console.log("Unselect '"+e.cyTarget.data('name')+"'...");
			setTimeout(function(){ e.cyTarget.unselect(); }, 50);
		}
	});

	// Bouton DELETE sélection
	$('#deleteNodes').click(function(){
		if (!confirm("Are you sure to delete element(s) ?")) return;
		cy.remove(":selected");
		$('#deleteNodes').addClass('disabled'); // alert confirm
		$('#save').trigger('click',[ "true" ]);
	});

	// Bouton LOAD
	$('#load').click(function(){
		cy.remove('*');
		$('#deleteNodes').addClass('disabled');
		if (localStorage.graph !== "") {
			var elems = JSON.parse(localStorage.graph);
			if (elems.length) {
				cy.add(elems);
				cy.layout({'name': layoutChoosen, animate: true});
				return;
			}
		}
		var version = Date.now();
		$.getJSON('./elements.json?v='+version, function(elems){
			cy.add(elems).layout({'name': layoutChoosen, animate: true});
		});
	});

	// Bouton SAVE
	$('#save').click(function(event, check_arrays='true'){
		console.log("trigger : "+check_arrays);
		
		console.log(localStorage.uiMenuBin);
		console.log(cy.elements().length);
		// if (!cy.elements().length)
		// 	return;
		var allJson = cy.elements().jsons(); // todo better in a function 
		localStorage.graph = JSON.stringify(allJson);
		$('#nbNodes').html("OK, "+cy.nodes().length+" element(s) saved.").show();
		console.log(localStorage.graph);
		  $.ajax({ // todo better in a function
		    type: 'POST',
		    url: '_storygraph/save_graphNodes.php',
		    data: {'nodes': localStorage.graph , 'del_dir': check_arrays},
		    success: function(msg) {
		      console.log(msg);

				  if(localStorage.uiMenuBin=='bt_sequences_clicked'){
					  var url = 'sequences_bin.php';
					  //$("#iframe-right-component").attr("src", url);
				  }

				  if(localStorage.uiMenuBin=='bt_cases_clicked'){
					  var url = 'cases_bin.php';
					  //$("#iframe-right-component").attr("src", url);
				  }

				  if(localStorage.uiMenuBin=='bt_medias_clicked'){
					  var url = 'medias_bin.php';
					  //$("#iframe-right-component").attr("src", url);
				  }

				  $("#iframe-right-component").attr("src", url);
		    },
	        error: function() {
	          alert("There was an error. Try again please!");
	        }
		  });
		  console.log('save');
		  return false;
	});

	// Bouton Clear LocalStorage
	$('#emptyLS').click(function(){
		localStorage.graph = "";
		$('#nbNodes').html("OK, memory cleared.").show();
	});

	// Affichage du nombre de nodes chargés
	cy.on('layoutready', function(){
		if (cy.nodes().length) {
			$('#nbNodes').html("Ok ! "+ cy.nodes().length +' nodes loaded.').show();
			setTimeout(function(){ $('#nbNodes').fadeOut() }, 4000);
		}
		else
			$('#nbNodes').html("Nothing to show.").show();
	});


	///////////// Node to Layout drag and drop//////////////

	$('.nodeModel').draggable({
		helper: "clone",
		cursor: "pointer"
	});
	$('#container').droppable({
		accept: ".nodeModel",
		drop: function (e, ui) {
			var nodeModel = ui.draggable.get(0);
			var offset = $('#container').offset();
			if(cy.nodes().length==0){var idE	 = cy.nodes().length + 1;}
			else{
				// console.log(cy.elements().jsons());
				// console.log(cy.elements('node[id!="x"]'));

				var ar_id = [];
				cy.nodes().each(function(i) {
					ar_id.push(parseInt(this.id()));
				    // console.log(this.id());
				});
				ar_id.sort(function(a,b){return a - b})
				//ar_id.sort();
				ar_id.reverse();
				//console.log(ar_id);
				var last_id = ar_id[0];
				// console.log(typeof last_id);
				// console.log(last_id);
				var idE	 = parseInt(last_id) + 1;
				// console.log(idE);
			}



			var type = $(nodeModel).data('type');
			var elem = {
				data: {
					id: idE,
					// name: "Case "+type
					// name: type
					name: type + "_" + idE
				},
				renderedPosition: {
					x: e.pageX - offset.left,
					y: e.pageY - offset.top
				},
				group: "nodes",
				classes: type+"s"
			};
			cy.add(elem);
			// cy.layout({'name': layoutChoosen, animate: true});
		}
	});

	///////////// Menu contextuel //////////////

	// Init
	cy.on('cxttap', 'node', function(e){
		$('.ctxNodeTitle').html(e.cyTarget.data('name'));
		var offset = $('#container').offset();
		lastClickCoords = [e.originalEvent.pageX -offset.left, e.originalEvent.pageY -offset.top];
		contextSelection = e.cyTarget.data('id');
		$('.overNode, .nodeAction').show();
		$("#contextMenu").css({'top': (e.originalEvent.pageY-5)+'px', 'left': (e.originalEvent.pageX-10)+'px'}).show();
		e.originalEvent.preventDefault();
		e.originalEvent.stopPropagation();
		return false;
	});

	cy.on('cxttap', 'edge', function(e){
		// $('.ctxNodeTitle').html(e.cyTarget.data('name'));
		var offset = $('#container').offset();
		lastClickCoords = [e.originalEvent.pageX -offset.left, e.originalEvent.pageY -offset.top];
		contextSelection = e.cyTarget.data('id');
		$('.overNode, .nodeAction').show();
		$("#contextMenu").css({'top': (e.originalEvent.pageY-5)+'px', 'left': (e.originalEvent.pageX-10)+'px'}).show();
		e.originalEvent.preventDefault();
		e.originalEvent.stopPropagation();
		return false;
	});


	cy.on('cxttap', function(e){
		if (e.cyTarget.length) return false;
		lastClickCoords = [e.originalEvent.pageX -30, e.originalEvent.pageY -120];
		$('.overNode, .nodeAction').hide();
		$("#contextMenu").css({'top': (e.originalEvent.pageY-5)+'px', 'left': (e.originalEvent.pageX-10)+'px'}).show();
		e.originalEvent.preventDefault();
		e.originalEvent.stopPropagation();
		return false;
	});
	$('#contextMenu').on('mouseleave click', function(){
		$(this).hide();
	});

	// Ajout de node right click
	$('.addNode').click(function(e){
		var type = $(this).data('type');
		var idE	 = cy.nodes().length + 1;
		var elem = {
			data: {
				id: idE,
				//name: "test add "+type
				name: type
			},
			renderedPosition: {
				x: lastClickCoords[0],
				y: lastClickCoords[1]
			},
			group: "nodes",
			classes: type+"s"
		};
		cy.add(elem);
	});

	// Suppression de node
	$('#deleteNode').click(function(){
		cy.remove('#'+contextSelection);
	});

	// Renommage de node
	$('#renameNode').click(function(){
		var newName = prompt('New name');
		// if (newName === '') return;
		// cy.$('#'+contextSelection).data('name', newName);
		// $('#save').trigger('click');

		if (!newName || 0 === newName.length) { return; }
		// else if (newName == '') { return; }
		// else if (newName == '') { return; }
		else {
			cy.$('#'+contextSelection).data('name', newName);
			$('#save').trigger('click',[ "false" ]);
		}



	});















$("#buttonTEST").click(function(){
 //  var list = cy.filter(function (i, ele) {
	// 	return (parseInt(ele.id().slice(1), 10) % 2 === 0);
	// });

	var parents =  cy.$(":selected");


	var nodes = [];

	// Create new parent
	// nodes.push({group: "nodes", data: {id: "n0"}, position: {x: 0, y: 0}});




		if (!parents.length)
			return;
	
		var seq_id = [];
		var cases_id = [];

		for (i=0; i<parents.length; i++) {
			var srce 	= parents.eq(i);
			var srceID 	= srce.data('id');
			// if (srce.hasClass('cases') )
			// var clName = srce.classe;
			// console.log(clName);

			if (srce.hasClass('cases') && parents[i].classes()=="cases") {

				// srce.data('parent', "5");
				//srce.data('parent', 6);

				cases_id.push(srceID);console.log(srceID);
			}

			if (srce.hasClass('sequences') && parents[i].classes()=="sequences") {
				seq_id.push(srceID);console.log(srceID);
			}

			// console.log(srceID);
			
		}


		console.log('cases : ' + cases_id);
		console.log('sequence : ' + seq_id);















	// Create copies of old nodes
	// for (var i=list.size()-1; i >= 0; i--) {

	// 	console.log(list[i].data('id'));


// if(list[i].classes()=="cases") {


// console.log(list[i].data('id'));
// console.log(list[i].data('name'));
// console.log(list[i].data('parent'));

// console.log(list[i].position('x'));
// console.log(list[i].position('y'));

// console.log(list[i].group());

// console.log(list[i].removed());
// console.log(list[i].selected());
// console.log(list[i].selectable());
// console.log(list[i].locked());
// console.log(list[i].grabbable());

// console.log(list[i].classes());

// // "group":"nodes",
// // "removed":false,
// // "selected":true,
// // "selectable":true,
// // "locked":false,
// // "grabbable":true,
// // "classes":"cases"

// 		nodes.push({
// 			group: "nodes",
// 			// data: {id: "c1" + i, parent: "n0"},
// 			data: {id: list[i].data('id'), name: list[i].data('name'), parent: "4"},
// 			// position: {x: list[i].position('x'), y: list[i].position('y')},
// 			group: list[i].group(),
// 			classes: list[i].classes()
// 		});
// 	}

// 	// Remove old nodes
// 	// console.log(list);
// 	//list.remove();

// 	// Add new nodes
// 	cy.add(nodes);


	// }


});





function get_cases_sequence(nodes_selected){

	var parents = nodes_selected;
	if (!parents.length)
			return;

		var seq_id = [];
		var cases_id = [];
		for (i=0; i<parents.length; i++) {
			var srce 	= parents.eq(i);
			var srceID 	= srce.data('id');
			if (srce.hasClass('cases')) {
				cases_id.push(srceID);
			}

			if (srce.hasClass('sequences')) {
				seq_id.push(srceID);
			}

		}


		if (!seq_id.length || seq_id.length>1 || !cases_id.length) {
			alert('U Need to Select 1 Sequence MAX with 1 Asset(s) at least !!!')
			console.log('cases FALSE : ' + cases_id);
			console.log('sequence FALSE : ' + seq_id);			
			return;
		}

		console.log('cases ok : ' + cases_id);
		console.log('sequence ok : ' + seq_id);

		return {cases:cases_id,sequence:seq_id}
}





	// Cases addToSequence
	$('#addToSequence').click(function(){
		
		var nodes_selected = cy.$(":selected");	
		var result = get_cases_sequence(nodes_selected);
		var cases =result.cases;
		var sequence_id =result.sequence[0];
		console.log(cases);
		console.log(sequence_id);


		

		for (i=0; i<cases.length; i++) {

			var node_case_TOcopy = [];

			// caseID = cases[i]+"_copied"; // IMPORTANT must be different as Original, or delete Original first see #CASEID
			caseID = cases[i]; // IMPORTANT must be different as Original, or delete Original first
			console.log(caseID);



			var node_to_copy = cy.getElementById( caseID);


			var parentID = sequence_id;
			console.log(parentID);
			var caseName = node_to_copy.data('name');
			console.log(caseName);
			var group = node_to_copy.group();
			console.log(group);
			var cl_classes = "cases";
			console.log(cl_classes);




			node_case_TOcopy.push({
				group: "nodes",
				// data: {id: "c1" + i, parent: "n0"},
				data: {id: caseID, name: caseName, parent: parentID},
				// position: {x: list[i].position('x'), y: list[i].position('y')},
				group: group,
				classes: cl_classes
			});

			// delete old original nodes
			// var node_to_del = cy.getElementById( caseID ); // see #CASEID
			cy.remove('#'+caseID); // delete

			// add elem cases selected to copy
			cy.add(node_case_TOcopy);

		}

		return;





// var parentNode = cy.$('#2');
// cy.$('#'+contextSelection).data({'parent', "5"});
// node.data({lfc: lfc, pval: pval});
// $('#save').trigger('click',[ "false" ]);

// return

		if (!parents.length)
			return;
	
		// console.log('select test');
		// console.log(cy.$(":selected"));
		// console.log(parents);

		var seq_id = [];
		var cases_id = [];
		for (i=0; i<parents.length; i++) {
			var srce 	= parents.eq(i);
			var srceID 	= srce.data('id');
			// if (srce.hasClass('cases') )
			// var clName = srce.classes;

			// console.log(parents[i].classes());


			if (srce.hasClass('cases')) {

			console.log(srce.position('x'));
			console.log(srce.position('y'));
			console.log(srce.group());
			//console.log(srce.classes(''));

				// srce.data('parent', "5");
				// srce.data('parent', 6);
				//$('#save').trigger('click',[ "false" ]);
				cases_id.push(srceID);
				// console.log(srceID);
			}

			if (srce.hasClass('sequences')) {
				seq_id.push(srceID);
				// console.log(srceID);
			}


			// console.log(srceID);
			
		
			
		}
		// console.log(cases_id);
		// console.log(seq_id);

		if (!seq_id.length || seq_id.length>1 || !cases_id.length) {
			alert('U Need to Select 1 Sequence MAX with 1 Asset(s) at least !!!')
			console.log('cases FALSE : ' + cases_id);
			console.log('sequence FALSE : ' + seq_id);			
			return;
		}

		console.log('cases ok : ' + cases_id);
		console.log('sequence ok : ' + seq_id);





		var caseID = "14";




// 
//		var node_to_del = cy.getElementById( caseID );
//		node_to_del.remove();








		// array cases selected to copy
		var nodes_cases_selected_TOcopy = [];





		// var caseID = "6";
		var caseName = "case_"+caseID;
		var parentID = "5";

		// var p_x = "nodes";
		// var p_y = "cases";

		var group = "nodes";
		var cl_classes = "cases";





		nodes_cases_selected_TOcopy.push({
			group: "nodes",
			// data: {id: "c1" + i, parent: "n0"},
			data: {id: caseID, name: caseName, parent: parentID},
			// position: {x: list[i].position('x'), y: list[i].position('y')},
			group: group,
			classes: cl_classes
		});





		// add elem cases selected to copy
		//cy.add(nodes_cases_selected_TOcopy);



// var b64key = 'base64,';
// var b64 = cy.png().substring( cy.png().indexOf(b64key) + b64key.length );
// var imgBlob = base64ToBlob( b64, 'image/png' );

// saveAs( imgBlob, 'graph.png' );










		// cy.$('#'+caseID).data('parent', seqID);
		// $('#save').trigger('click',[ "false" ]);

		// var elem.push({
		//      parent : "5"
  //   	})

			// cy.$('#6').data('parent', "5");
			// $('#save').trigger('click',[ "false" ]);

// console.log(localStorage.graph);

	});




	// Connexion des nodes en drag & drop
	//
	// cy.edgehandles({
	// 	enabled: false,
	// 	handleColor: '#FFF',
	// 	hoverDelay: 200,
	// 	toggleOffOnLeave: true,
	// 	edgeType: function( sourceNode, targetNode ) {
	// 		if (sourceNode.hasClass('shots'))
	// 			return null;
	// 		if (sourceNode.hasClass('cases') && targetNode.hasClass('shots'))
	// 			return null;
	// 		if (sourceNode.hasClass('scene') && targetNode.hasClass('cases'))
	// 			return null;
	// 		if (cy.$('#E'+sourceNode.data('id')+targetNode.data('id')).isEdge())
	// 			return null;
	// 		return 'flat';
	// 	},
	// 	edgeParams: function(sourceNode, targetNode, i) {
	// 		var edgeClass = "";
	// 		if (sourceNode.hasClass('cases') && !targetNode.hasClass('shots'))
	// 			edgeClass = "casesLine";
	// 		if (sourceNode.hasClass('scenes') && !targetNode.hasClass('cases'))
	// 			edgeClass = "scenesLine";
	// 		if (targetNode.hasClass('shots') && !sourceNode.hasClass('cases'))
	// 			edgeClass = "shotsLine";
	// 		return {
	// 			data: {
	// 				id: "E"+sourceNode.data('id')+targetNode.data('id'),
	// 				source: sourceNode.data('id'),
	// 				target: targetNode.data('id')
	// 			},
	// 			group: "edges",
	// 			classes: edgeClass
	// 		}
	// 	}
	// });
	// $('.switchMode').click(function(){
	// 	if (!$(this).hasClass('switchOn')) {
	// 		$(this).addClass('switchOn').find('span').html("ON");
	// 		cy.edgehandles('enable');
	// 	}
	// 	else {
	// 		$(this).removeClass('switchOn').find('span').html("(off)");
	// 		cy.panBy({x:1, y:0});
	// 		cy.edgehandles('disable');
	// 	}
	// });

});
// Document Ready Ends
