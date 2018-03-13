
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Testing Cytoscape</title>
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/cytoscape.min.js"></script>
	<script src="js/dagre.min.js"></script>
	<script src="js/cytoscape-dagre.js"></script>
	<link rel="stylesheet" href="css/style.css"  type="text/css">
</head>
<body oncontextmenu="return false;">
	<h2>
		<a href="./index.html" title="Recharger la page">Test d'interface</a>
		utilisant la lib <a href="http://js.cytoscape.org/" target="_blank"><u>Cytoscape.js</u></a>
	</h2>

	<div class="mainMenu">
		Layout : 
		<select id="layoutCh">
			<option value="dagre" selected>Dagre</option>
			<option value="breadthfirst">Breadthfirst</option>
			<option value="grid">Grid</option>
			<option value="cose">Cose</option>
			<option value="circle">Circle</option>
			<option value="concentric">Concentric</option>
			<option value="random">Random</option>
		</select>
		<button id="fit">Voir tout</button>
		<button id="redraw">Redessiner</button>
		<button id="clear">Vider</button>
		<button class="disabled" id="deleteNodes">Supprimer sélection</button>
		<div class="mainMenuRight">
			<span id="nbNodes">Rien à afficher.</span>
			<button id="load">Charger</button>
			<button id="save">Mémoriser</button>
			<button id="emptyLS">Oublier</button>
		</div>
	</div>

	<div class="menuLeft">
		<p>Glissez-déposez : éléments ci-dessous</p>
		<div class="nodeModel assetM" data-type="asset">Asset</div>
		<div class="nodeModel sceneM" data-type="scene">Scene</div>
		<div class="nodeModel shotM"  data-type="shot">Shot</div>
		<hr />
		<p>Mémo - aide</p>
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
				<li>&nbsp;&nbsp;&nbsp; -> Assets vers Scenes</li>
				<li>&nbsp;&nbsp;&nbsp; -> Scenes vers Scenes</li>
				<li>&nbsp;&nbsp;&nbsp; -> Scenes vers Shots</li>
			<b>Mémoire :</b>
				<li>
					Bouton "Charger" : charge un graphe depuis la mémoire
					du navigateur si présente, sinon charge depuis un fichier json sur le serveur.
				</li>
				<li>Bouton "Mémoriser" : mémorise le graphe courant dans la mémoire du navigateur.</li>
				<li>Bouton "Oublier" : Vide la mémoire du navigateur</li>
		</ul>
	</div>
	
	<div id="container"></div>

	<div id="contextMenu">
		<div class="ctxNodeTitle overNode"></div>
		<div class="ctxMenuEntry nodeAction" id="renameNode">Renommer</div>
		<div class="ctxMenuEntry nodeAction disabled">Isoler</div>
		<div class="ctxMenuEntry nodeAction disabled">Sélectionner enfants</div>
		<div class="ctxMenuEntry nodeAction" id="deleteNode">Supprimer</div>
		<div class="ctxMenuEntry nodeAction disabled">Déconnecter</div>
		<hr class="overNode" />
		<div class="ctxMenuEntry" id="fitM">Dézoom pour voir tout</div>
		<hr />
		<div class="ctxMenuEntry addNode" data-type="asset">Ajouter un asset</div>
		<div class="ctxMenuEntry addNode" data-type="scene">Ajouter une scène</div>
		<div class="ctxMenuEntry addNode" data-type="shot">Ajouter un shot</div>
		<hr />
		<div class="ctxMenuEntry" id="clearM">Vider le graphe</div>
	</div>

	<script src="js/main.js"></script>
</body>
</html>