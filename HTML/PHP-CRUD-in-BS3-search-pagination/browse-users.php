<?php 
	include_once('config.php');
	$table = "reservations";

	// ----- pagination  - 1
	$totalPages = count($db->getAllRecords($table,'*'));
	$showRecordPerPage = 2;
	$startFrom = 0;
	$currentPage = 0;
	$style_pagination = "";
	$style_showAll = " style='display:none;'";

	$limit = "  LIMIT $startFrom, $showRecordPerPage";

	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
		$limit_start = ($currentPage + $showRecordPerPage);
		$limit	=	" LIMIT $limit_start, $showRecordPerPage";
	}

	// ----- get request data for Check Form  - 2

	$condition	=	'';

	if(isset($_REQUEST['nom']) and $_REQUEST['nom']!=""){
		$condition	.=	' AND nom LIKE "%'.$_REQUEST['nom'].'%" ';
	}
	if(isset($_REQUEST['email']) and $_REQUEST['email']!=""){
		$condition	.=	' AND email LIKE "%'.$_REQUEST['email'].'%" ';
	}
	// if(isset($_REQUEST['userphone']) and $_REQUEST['userphone']!=""){
	// 	$condition	.=	' AND userphone LIKE "%'.$_REQUEST['userphone'].'%" ';
	// }

	// ----- searchs
	// ----- search in all Columns get data - 3

	if(isset($_REQUEST['submit']) and $_REQUEST['submit']=="search" and isset($_REQUEST['searchAll'])){
		$search = $_REQUEST['search'];
		$datas = $db->searchInColumnsTable($table,$search);
		// print_r($datas);
		// exit;
	}

	// ----- search in unique Column,  and css switch - 4
	if(isset($_REQUEST['submit']) and $_REQUEST['submit']=="search"){
		// $searchSubmit = "TRUE";
		$style_pagination = " style='display:none;'";
		$style_showAll = " style='display:block;'";
		$limit = '';
	}

	// ----- get datas 5
	if(!isset($_REQUEST['searchAll'])){
		$datas	=	$db->getAllRecords($table,'*',$condition,'ORDER BY created DESC',$limit);
	}

?>
<!doctype html>
<html lang="fr" class="no-js">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>PHP CRUD in Bootstrap 3</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		.selects{
			min-width: 140px;
		}
		.inputs-text{
			min-width: 140px;
		}
	</style>
</head>
<body>

   	<div class="container">

		<div class="panel panel-default">
			<div class="panel-heading clearfix">
				<strong><h3><?php echo ucfirst($table);?></h3></strong> 
			</div>
			<div class="panel-body">
				<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record(s) deleted successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record updated successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> You did not change any thing!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';
				}
				?>
				<div class="col-sm-12">

					<form id="form_search" method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" name="input_search" id="input_search" class="form-control inputs-text" value="<?php echo isset($_REQUEST['search'])?$_REQUEST['search']:''?>" placeholder="Search">
								</div>
							</div>


							<div class="col-sm-2">
								<div class="form-group">
									<select id="select_fields" class="form-control selects" data-role="select">
									<option value="all">All Columns</option>
									<option value="nom">Nom</option>
									<option value="email">Email</option>
									</select>
								</div>
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<!-- <label>&nbsp;</label> -->
									<div>
										<button id="bt_search" type="button" name="submit" value="search" class="btn btn-primary">
											<i class="fa fa-fw fa-search"></i> Search</button>

										<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> Clear</a>
									</div>
								</div>
								
							</div>

							<div class="col-sm-4">
								<div class="form-group">
									<!-- <label>&nbsp;</label> -->
									<div>
										<!-- <div class="panel-heading clearfix"> -->
											
											<a href="add-users.php" class="pull-right btn btn-danger">
												<i class="fa fa-fw fa-plus-circle"></i> Add <?php echo ucfirst($table);?></a>
											<!-- </div> -->
			
									</div>
								</div>
								
							</div>



						</div>
					</form>
				</div>
			<!-- </div> -->








			<div class="col-sm-12">
			<form id="form_order" method="get">
						<div class="row">
						<div class="col-sm-2">
								<div class="form-group">
									<select id="select_orderType" class="form-control selects" data-role="select">
									<option value="DESC">ORDER DESC</option>
									<option value="ASC">ORDER ASC</option>
									</select>
								</div>
							</div>


							<div class="col-sm-2">
								<div class="form-group">
									<select id="select_orderType_fields" class="form-control selects" data-role="select">
									<option value="nom">Nom</option>
									<option value="email">Email</option>
									<option value="id">Id</option>
									</select>
								</div>
							</div>

						</div>
					</form>
					

					</div>
					</div>

			
		</div>
		
		
		<div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary">
						<!-- <th>Sr#</th> -->
						<th width="1%" style="background-color:#2F4F4F;">#</th>
						<th width="1%">Id</th>
						<th>Name</th>
						<th>Email</th>
						
						<th with="80px" class="text-center">Action</th>
						<th width="1%"><input type="checkbox" id="all_checkbox" name="all_checkbox_action" value="all" class="all_checkbox"></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$s	=	'';
					$c = 0;
					foreach($datas as $val){
						$sr_bg1 = " style='background-color:#C0C0C0;'";
						$sr_bg2 = " style='background-color:#DCDCDC;'";
						$sr_bg = ($c++ & 1) ? $sr_bg2 : $sr_bg1;
						$s++;
					?>
					<tr>
						<td width="1%" <?php echo $sr_bg;?>><?php echo $s;?></td>
						<td><?php echo $val['id'];?></td>
						<td><?php echo $val['nom'];?></td>
						<td><?php echo $val['email'];?></td>
						
						<td  width="80px" align="center">
							<a href="edit-users.php?editId=<?php echo $val['id'];?>" class="text-primary">
							<i class="fa fa-pencil-square-o" style="font-size:18px;font-weight:bold;"></i></a>
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a id="deleteIds" role="button" class="text-danger" style="font-size:18px;font-weight:bold;" delId="<?php echo $val['id'];?>">
							<i class="fa fa-times"></i></a>
						</td>
						<td width="1%"><input type="checkbox" id="<?php echo $val['id'];?>" name="all_checkbox" value="all" class="all_checkbox"></td>
					</tr>
					<?php } ?>
					
				</tbody>
			</table>

			<!-- // ----- Pagination -->
			<nav aria-label="Page navigation">

			<div id="div_pagination" <?php echo $style_pagination; ?>>

			<style>

				.navigation_pages{
					color: darkgray !important;
					border: 1px solid darkgray !important;
					/* background-color: #ccc !important; */
					background-color: white !important;
				}
				.navigation_pages:hover{
					color: white !important;
					background-color: darkgray !important;
				}
				.navigation_pages_before_after{
					background-color: white !important;
					border: 1px solid darkgray !important;
					color: darkgray !important;
				}
				.navigation_pages_before_after:hover{
					color: white !important;
					/* border: 1px solid darkgray !important; */
					/* background-color: #ccc !important; */
					background-color: darkgray !important;
				}
				.navigation_pages_before{
					/* background-color: white !important; */
					/* margin-right: 15px !important; */
				}
				.navigation_pages_after{
					/* background-color: grey !important; */
					/* margin-left: 5px !important; */
				}
				.navigation_margin_right{
					margin-right: 2px !important;
				}
				.bt_pagination_active{
					color: white !important;
					background-color: darkgray !important;
				}
				.a_result{
					color: darkgray !important;
					background-color: white !important;	
					border: 1px solid darkgray !important;
				}
				.a_result_perPage{
					color: darkgray !important;
				}
				.select_n_byPage{
					color: darkgray !important;
				}
			</style>		

				<?php



					/* On calcule le nombre de pages */
					// to do better check if result derniere page
					$nombreDePages = ceil($totalPages / $showRecordPerPage);
					$page = $currentPage;

					?>

					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<a class="btn btn-primary navigation_pages_before navigation_pages" role ="button" href="?page=0">FIRST</a>&nbsp;<?php
					
					/* Si on est sur la première page, on n'a pas besoin d'afficher de lien
					* vers la précédente. On va donc l'afficher que si on est sur une autre
					* page que la première */
					if ($page > 0):
						?><a class="btn btn-primary navigation_margin_right navigation_pages_before_after" role ="button" href="?page=<?php echo $page - 1; ?>"><</a>&nbsp;&nbsp;<?php
					endif;

					/* On va effectuer une boucle autant de fois que l'on a de pages */
					for ($i = 1; $i <= $nombreDePages; $i++):
						$bt_page_active = "";
						if($i==$currentPage){$bt_page_active='bt_pagination_active';}
						?><a class="btn btn-primary navigation_margin_right navigation_pages <?php echo $bt_page_active; ?>" role ="button"  href="?page=<?php echo $i;?>"><?php echo $i;?></a><?php
					endfor;

					/* Avec le nombre total de pages, on peut aussi masquer le lien
					* vers la page suivante quand on est sur la dernière */
					if ($page < $nombreDePages):
						?>&nbsp;&nbsp;<a class="btn btn-primary navigation_margin_right navigation_pages_before_after navigation_pages_after" role ="button" href="?page=<?php echo $page + 1; ?>">></a><?php
					endif;

					?>&nbsp;<a class="btn btn-primary navigation_margin_right navigation_pages_before_after" role ="button" href="?page=<?php echo $nombreDePages + 1; ?>">LAST</a><?php

					?>

<!-- <a class="label btnX btn-primaryX a_result" role ="buttonX"> -->
	

					&nbsp;&nbsp;&nbsp;&nbsp;			
<!-- <div style="height:10px;"></div>		 -->
					<select id="select_n_byPage" class="select_n_byPage" data-role="select">
						<option value="10">10</option>
						<option value="25">25</option>
						<option value="50">50</option>
					</select>
					<i class="a_result_perPage">results per page</i>
					
				
				<!-- </a> -->


					
					<span>

					</span>
					
			
			</div>
			<div  <?php echo $style_showAll; ?>>
				&nbsp;&nbsp;&nbsp;&nbsp;<a id ="bt_showAll" class="btn btn-primary navigation_pages_before navigation_pages" role ="button">RESET</a>
			</div>

			</nav>
<!--/pagination-->

		</div> <!--/.col-sm-12-->
	</div>
	
	
<br><br><br><br>



	
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>


<script>


// DELETE UNIQUE OR MULTIPLE by Id
$(document).on('click', '#deleteIds', function () {

	$("#" + $(this).attr('delId')).prop('checked', true);

	var ids = [];
	$('input.all_checkbox').each(function () {
		if($(this).hasClass('all_checkbox') && $(this).prop('checked')==true && isNaN($(this).attr('id'))==false){
			ids.push($(this).attr('id'));
		}
		// console.log(ids);
	});

	var z = confirm("Confirm delete selected : " + ids + " !?");
	if (z == true) {
		var table = "<?php echo $table;?>";
		var i;
		for (i = 0; i < ids.length; i++) {
			id = ids[i];
			var url = "delete.php?delId="+id+"&table="+table;
			// delete.php?delId=19&table=reservations
			console.log(url);
			window.location.href = url;
		} 
	} else {
		$("#" + $(this).attr('delId')).prop('checked', false);
	}

});

// OTHERS
$(document).ready(function(){

	// // ----- ui vars
	// var order = $("#select_orderType").val();
	// var search = $("#input_search").val();
	// var field = $("#select_fields").val();
	// var orderType = $("#select_orderType").val();
	// var orderType_fields = $("#select_orderType_fields").val();

	// ----- get vars
	var var_order_url = GetUrlValue('order');
	var var_field_url = GetUrlValue('field');
	var var_field_search_url = GetUrlValue('fieldSearch');
	var var_orderType_url = GetUrlValue('orderType');
	var var_orderType_fields_url = GetUrlValue('orderType_fields');

	if(check_var_notNullEmptyUndefined(var_order_url)=="TRUE" && check_var_notNullEmptyUndefined(var_field_url)=="TRUE"){
		conform_ui_orderSelects(var_order_url,var_field_url);
	}
	if(check_var_notNullEmptyUndefined(var_field_search_url)=="TRUE"){
		conform_ui_fieldSelect(var_field_search_url);
	}
	if(check_var_notNullEmptyUndefined(var_orderType_url)=="TRUE"){
		conform_ui_orderType(var_orderType_url);
	}
	if(check_var_notNullEmptyUndefined(var_orderType_fields_url)=="TRUE"){
		conform_ui_orderType_fields(var_orderType_fields_url);
	}
	
	// ----- only used for multiple delete
	$("#all_checkbox").click(function(){
  		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	// -----

	$("#bt_showAll").click(function(){        
		var url = '<?php echo $_SERVER['PHP_SELF'];?>';
		window.location.href = url;
	});

	$("#select_orderType").change(function(){        
		order_select();
	});
	$("#select_orderType_fields").change(function(){        
		order_select();
	});

    $("#bt_search").click(function(){        
		ui_vars_array = ui_vars();
		var search = ui_vars_array[1];
		if(search==""){
			alert("Search is empty");
		} else {
			refresh_page();
		}
    });

	function ui_vars(){
		var order = $("#select_orderType").val();
		var search = $("#input_search").val();
		var field = $("#select_fields").val();
		var orderType = $("#select_orderType").val();
		var orderType_fields = $("#select_orderType_fields").val();
		var ui_vars_array = [order,search,field,orderType,orderType_fields]
		return ui_vars_array;
	}

	function refresh_page(){
		ui_vars_array = ui_vars();
		var order = ui_vars_array[0];
		var search = ui_vars_array[1];
		var field = ui_vars_array[2];
		var orderType = ui_vars_array[3];
		var orderType_fields = ui_vars_array[4];

		var url = '<?php echo $_SERVER['PHP_SELF'];?>'+'?'+field+'='+search+'&submit=search&search='+search+'&fieldSearch='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields;
		if(field=="all"){
			var url = '<?php echo $_SERVER['PHP_SELF'];?>'+'?'+field+'='+search+'&submit=search&search='+search+'&searchAll='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields;
		}
		window.location.href = url;
	}

	function order_select(){
		refresh_page();
	}

	function GetUrlValue(VarSearch){
		var SearchString = window.location.search.substring(1);
		var VariableArray = SearchString.split('&');
		for(var i = 0; i < VariableArray.length; i++){
			var KeyValuePair = VariableArray[i].split('=');
			if(KeyValuePair[0] == VarSearch){
				return KeyValuePair[1];
			}
		}
	}

	function check_var_notNullEmptyUndefined(my_var){
		var check = "TRUE";
		// var undefinedString;
		if(!my_var){
			// console.log("string is undefined");
			var check = "FALSE";
		}
		var emptyString="";
		if(!my_var){
			// console.log("string is empty");
			var check = "FALSE";
		}
		var nullString=null;
		if(!my_var){
			// console.log("string is null");
			var check = "FALSE";
		}
		return check;
	}

});

function conform_ui_orderSelects(var_order_url,var_field_url){
	$("#select_orderType").val(var_order_url);
	$("#select_orderType_fields").val(var_field_url);
}

function conform_ui_fieldSelect(var_field_search_url){
	$("#select_fields").val(var_field_search_url);
}

function conform_ui_orderType(var_orderType_url){
	$("#select_orderType").val(var_orderType_url);
}

function conform_ui_orderType_fields(var_orderType_fields_url){
	$("#select_orderType_fields").val(var_orderType_fields_url);
}

</script>


</body>
</html>
