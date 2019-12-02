<?php 
	include_once('../include/config.php');

	$table = basename(__FILE__, '.php');

	function array_sort_by_usort($datas,$orderType){
		if($orderType=="DESC"){
			usort($datas, function($b, $a) {
				return $a['id'] <=> $b['id'];
			});
		}
		if($orderType=="ASC"){
			usort($datas, function($a, $b) {
				return $a['id'] <=> $b['id'];
			});
		}
	}

	function array_sort_by_column(&$arr, $orderBy, $orderType) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$orderBy];
		}
		array_multisort($sort_col, $orderType, $arr);
	}

	// ----- pagination  - 1
	$array_select_n_byPage = array(2=>2,3=>3,5=>5,10=>10,15=>15,25=>25,50=>50);
	// $array_select_n_byPage = array(2,3,4,5,10,15,25);
	$totalResults = count($db->getAllRecords($table,'*'));
	$showRecordPerPage = 5;
	$startFrom = 0;
	$currentPage = 0;
	$style_pagination = "";

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
		// Not really necessary
		$order = 'ORDER BY ' . $orderBy . ' ' . $orderType . ' ';
		$datas_tot	=	$db->getAllRecords($table,'*',$condition,$order,$limit);	
	}

	// -----
	$start = ($currentPage*$showRecordPerPage);
	$end = $showRecordPerPage;
	// We choose only data array in range
	$datas = array_slice($datas_tot, $start , $showRecordPerPage); 

	// ----- Sorting

	// other solution
	// array_sort_by_usort($datas,$orderType);

	if($orderType=="ASC"){
		array_sort_by_column($datas, $orderBy, $orderType=SORT_ASC);
	}
	if($orderType=="DESC"){
		array_sort_by_column($datas, $orderBy, $orderType=SORT_DESC);
	}

	// -----
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script>
    	var showRecordPerPage = '<?php echo $showRecordPerPage; ?>';
	</script>

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
									<div>	
										<a id="bt_create" hrefX="include/_create.php?table=<?php echo $table;?>" class="pull-right btn btn-danger">
										<i class="fa fa-fw fa-plus-circle"></i> Add <?php echo ucfirst($table);?></a>		
									</div>
								</div>
								
							</div>



						</div>
					</form>
				</div>


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
							<a id="bt_update" class="text-primary" updId="<?php echo $val['id'];?>">
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
			<?php include('../include/pagination.php');?>
			<!--/pagination-->

		</div> <!--/.col-sm-12-->
	</div>
	
	<br><br>
	
	<!-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<!-- ----- at the end -->
	<script src="../js/crud.js"></script>

<script>

path_include = "../include";

// CREATE
$(document).on('click', '#bt_create', function () {
		var url = window.location.pathname;
		var res = url.substring(url.lastIndexOf('/')+1);
		var table = res.split(".")[0];
		var url = path_include+"/_create.php?table="+table;
		window.location.href = url;
  });

// UPDATE
$(document).on('click', '#bt_update', function () {
		var id = $(this).attr('updId');
		var url = window.location.pathname;
		var res = url.substring(url.lastIndexOf('/')+1);
		var table = res.split(".")[0];
		var url = path_include+"/_update.php?editId="+id+"&table="+table;
		window.location.href = url;
  });

// DELETE UNIQUE OR MULTIPLE by Id
$(document).on('click', '#deleteIds', function () {

	$("#" + $(this).attr('delId')).prop('checked', true);

	var ids = [];
	$('input.all_checkbox').each(function () {
		if($(this).hasClass('all_checkbox') && $(this).prop('checked')==true && isNaN($(this).attr('id'))==false){
			ids.push($(this).attr('id'));
		}
	});

	var z = confirm("Confirm delete selected : " + ids + " !?");
	if (z == true) {
		var url = window.location.pathname;
		var res = url.substring(url.lastIndexOf('/')+1);
		var table = res.split(".")[0];
		var url = path_include+"/_delete.php?delIds="+ids+"&table="+table;
		window.location.href = url;
	} else {
		$("#" + $(this).attr('delId')).prop('checked', false);
	}

});


</script>


</body>
</html>