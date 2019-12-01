<?php 
	include_once('config.php');
	$table = "reservations";

	// ----- pagination  - 1
	$array_select_n_byPage = array(2=>2,3=>3,5=>5,10=>10,15=>15,25=>25,50=>50);
	// $array_select_n_byPage = array(2,3,4,5,10,15,25);
	$totalResults = count($db->getAllRecords($table,'*'));
	$showRecordPerPage = 5;
	$startFrom = 0;
	$currentPage = 0;
	$style_pagination = "";
	$style_showAll = " style='display:none;'";

	if(isset($_GET['n_byPage']) && !empty($_GET['n_byPage'])){
		$showRecordPerPage = $_GET['n_byPage'];
	}

	// -----
	$orderType = "DESC";
	if(isset($_GET['orderType']) && !empty($_GET['orderType'])){
		$orderType = $_GET['orderType'];
	}
	$orderBy = "id";
	if(isset($_GET['orderType_fields']) && !empty($_GET['orderType_fields'])){
		$orderBy = $_GET['orderType_fields'];
	}

	$limit = "  LIMIT $startFrom, $showRecordPerPage";
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
		$limit_start = ($currentPage + $showRecordPerPage);
		$limit	=	" LIMIT $limit_start, $showRecordPerPage";
	}

	// ----- get request data for Form  - 2

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
		$datas_tot = $db->searchInColumnsTable($table,$search);
	}

	// ----- get datas 5
	if(!isset($_REQUEST['searchAll'])){
		$limit = '';
		$order = 'ORDER BY ' . $orderBy . ' ' . $orderType . ' ';
		$datas_tot	=	$db->getAllRecords($table,'*',$condition,$order,$limit);	
	}

	// -----
	$start = ($currentPage*$showRecordPerPage);
	$end = $showRecordPerPage;
	$datas = array_slice($datas_tot, $start , $showRecordPerPage); 

	$totalResults = count($datas_tot);
	if($totalResults>end($array_select_n_byPage)){$array_select_n_byPage[$totalResults]=$totalResults;}
	foreach($array_select_n_byPage as $a){
		if($a<=$totalResults){
			$array_select_n_byPage[$a]=$a;
		}
	}
	array_unique($array_select_n_byPage);
	asort($array_select_n_byPage);


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
										<i class="fa fa-fw fa-search"></i> 
										Search
										</button>

										<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger">
										<!-- <i class="fa fa-fw fa-trash"></i>  -->
										Clear | Refresh
										</a>

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
					// $s	=	'';
					$s = ($currentPage*$showRecordPerPage);
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
			<?php include('pagination.php');?>
<!--/pagination-->






		</div> <!--/.col-sm-12-->
	</div>
	
	
<br><br>



	
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>


<script>


// bt_pageId

function refresh_pageId(id){
	var url_server_self = url_server();
	ui_vars_array = ui_vars();
	var pageId = id;
	var order = ui_vars_array[0];
	var search = ui_vars_array[1];
	var field = ui_vars_array[2];
	var orderType = ui_vars_array[3];
	var orderType_fields = ui_vars_array[4];
	var n_byPage = ui_vars_array[5];
	var nombreDePages = ui_vars_array[6];

	if(pageId>=0 && pageId<=nombreDePages){
		// var url = url_server_self+'?page='+pageId;
		var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
		+search+'&fieldSearch='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
		if(field=="all" && search !=""){
			var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
			+search+'&searchAll='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
		}

		window.location.href = url;
	}

}


$("#" + $(this).attr('delId')).prop('checked', true);

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
			console.log(url);
			window.location.href = url;
		} 
	} else {
		$("#" + $(this).attr('delId')).prop('checked', false);
	}

});

// OTHERS
$(document).ready(function(){

	
	$("#select_n_byPage").val(<?php echo $showRecordPerPage;?>);

	// ----- get vars
	var var_order_url = GetUrlValue('order');
	var var_field_url = GetUrlValue('field');
	var var_field_search_url = GetUrlValue('fieldSearch');
	var var_orderType_url = GetUrlValue('orderType');
	var var_orderType_fields_url = GetUrlValue('orderType_fields');
	var var_n_byPage_url = GetUrlValue('n_byPage');

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
	if(check_var_notNullEmptyUndefined(var_n_byPage_url)=="TRUE"){
		conform_ui_select_n_byPage(var_n_byPage_url);
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

function conform_ui_select_n_byPage(var_n_byPage_url){
	$("#select_n_byPage").val(var_n_byPage_url);
}

// ----

	function url_server(){
		var url_server_self = '<?php echo $_SERVER['PHP_SELF'];?>';
		return url_server_self;
	}


	function ui_vars(){
		var order = $("#select_orderType").val();
		var search = $("#input_search").val();
		var field = $("#select_fields").val();
		var orderType = $("#select_orderType").val();
		var orderType_fields = $("#select_orderType_fields").val();
		var n_byPage = $("#select_n_byPage").val();
		var nombreDePages = '<?php echo $nombreDePages;?>';
		var ui_vars_array = [order,search,field,orderType,orderType_fields,n_byPage,nombreDePages]
		return ui_vars_array;
	}

	function refresh_page(){
		// var url_server_self = url_server();
		ui_vars_array = ui_vars();
		pageId = '0';
		var order = ui_vars_array[0];
		var search = ui_vars_array[1];
		var field = ui_vars_array[2];
		var orderType = ui_vars_array[3];
		var orderType_fields = ui_vars_array[4];
		var n_byPage = ui_vars_array[5];
		var nombreDePages = ui_vars_array[6];
		
		go_to_url(pageId,order,search,field,orderType,orderType,orderType_fields,n_byPage);

	}

	function go_to_url(pageId,order,search,field,orderType,orderType,orderType_fields,n_byPage){
		var url_server_self = url_server();
		var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
		+search+'&fieldSearch='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
		if(field=="all"){
			var url = url_server_self+'?page='+pageId+'&'+field+'='+search+'&submit=search&search='
			+search+'&searchAll='+field+'&orderType='+orderType+'&orderType_fields='+orderType_fields+'&n_byPage='+n_byPage;
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

</script>


</body>
</html>
