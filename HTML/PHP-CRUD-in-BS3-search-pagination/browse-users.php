<?php 
	include_once('config.php');
	// include('paginator.class.php');

?>
<!doctype html>
<html lang="fr" class="no-js">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>PHP CRUD in Bootstrap 3 with a search functionality</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	
	<div class="container">

	<?php
	$condition	=	'';
	if(isset($_REQUEST['nom']) and $_REQUEST['nom']!=""){
		$condition	.=	' AND nom LIKE "%'.$_REQUEST['nom'].'%" ';
	}

	// ----- check form

	// if(isset($_REQUEST['useremail']) and $_REQUEST['useremail']!=""){
	// 	$condition	.=	' AND useremail LIKE "%'.$_REQUEST['useremail'].'%" ';
	// }
	// if(isset($_REQUEST['userphone']) and $_REQUEST['userphone']!=""){
	// 	$condition	.=	' AND userphone LIKE "%'.$_REQUEST['userphone'].'%" ';
	// }



	// ----- pagination 
	$totalPages = count($db->getAllRecords('reservations','*'));
	$showRecordPerPage = 2;
	$startFrom = 0;
	$currentPage = 0;
	// $nextPage = "EMPTY";
	$page_item_empty = " styleX='display:none;'";
	$limit = "  LIMIT $startFrom, $showRecordPerPage";
	// print_r($limit);
	// print_r("<br>");
	// $limit	=	' LIMIT 0, 5  ';

	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = $_GET['page'];
		$limit_start = ($currentPage + $showRecordPerPage);
		// $limit_start = intval($limit_start);
		$limit	=	" LIMIT $limit_start, $showRecordPerPage";
	}

	// print_r($limit);
	// print_r("<br>");
	$userData	=	$db->getAllRecords('reservations','*',$condition,'ORDER BY created DESC',$limit);


	

	?>
	

























   	<div class="container">
		

		<div class="panel panel-default">
			<div class="panel-heading clearfix"><i class="fa fa-fw fa-globe"></i> <strong>Browse Users</strong> <a href="add-users.php" class="pull-right btn btn-danger"><i class="fa fa-fw fa-plus-circle"></i> Add Users</a></div>
			<div class="panel-body">
				<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record deleted successfully!</div>';
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
					<h5><i class="fa fa-fw fa-search"></i> Find User</h5>
					<form method="get">
						<div class="row">
							<div class="col-sm-2">
								<div class="form-group">
									<label>Nom</label>
									<input type="text" name="nom" id="nom" class="form-control" value="<?php echo isset($_REQUEST['nom'])?$_REQUEST['nom']:''?>" placeholder="Enter user name">
								</div>
							</div>
							<!-- <div class="col-sm-2">
								<div class="form-group">
									<label>User Email</label>
									<input type="email" name="useremail" id="useremail" class="form-control" value="<?php echo isset($_REQUEST['useremail'])?$_REQUEST['useremail']:''?>" placeholder="Enter user email">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>User Phone</label>
									<input type="tel" class="tel form-control" name="userphone" id="userphone" x-autocompletetype="tel" placeholder="Enter User Phone Number" value="<?php echo isset($_REQUEST['userphone'])?$_REQUEST['userphone']:''?>">
								</div>
							</div> -->
							<div class="col-sm-4">
								<div class="form-group">
									<label>&nbsp;</label>
									<div>
										<button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
										<a href="<?php echo $_SERVER['PHP_SELF'];?>" class="btn btn-danger"><i class="fa fa-fw fa-sync"></i> Clear</a>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>
		
		<div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary">
						<th>Sr#</th>
						<th>Id</th>
						<th>Name</th>
						<th>Email</th>

						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$s	=	'';
					foreach($userData as $val){
						$s++;
					?>
					<tr>
						<td><?php echo $s;?></td>
						<td><?php echo $val['id'];?></td>
						<td><?php echo $val['nom'];?></td>
						<td><?php echo $val['email'];?></td>
						
						<td align="center">
							<a href="edit-users.php?editId=<?php echo $val['id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> | 
							<a href="delete.php?delId=<?php echo $val['id'];?>&table=reservations" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>



<!-- // ----- Pagination -->
<nav aria-label="Page navigation">
		
	<?php

		/* On calcule le nombre de pages */
		// to do better check if result derniere page
		$nombreDePages = ceil($totalPages / $showRecordPerPage)+1;
		$page = $currentPage;

		/* Si on est sur la première page, on n'a pas besoin d'afficher de lien
		* vers la précédente. On va donc l'afficher que si on est sur une autre
		* page que la première */
		if ($page > 0):
			?><a class="btn btn-primary" role ="button" href="?page=<?php echo $page - 1; ?>"><</a> — <?php
		endif;

		/* On va effectuer une boucle autant de fois que l'on a de pages */
		for ($i = 1; $i <= $nombreDePages; $i++):
			?><a class="btn btn-primary" role ="button" href="?page=<?php echo $i;?>"><?php echo $i;?></a><?php
		endfor;

		/* Avec le nombre total de pages, on peut aussi masquer le lien
		* vers la page suivante quand on est sur la dernière */
		if ($page < $nombreDePages):
			?>— <a class="btn btn-primary" role ="button" href="?page=<?php echo $page + 1; ?>">></a><?php
		endif;

		?>
		
</nav>


		</div> <!--/.col-sm-12-->
	</div>
    

	
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/jquery.caret/0.1/jquery.caret.js"></script>
	<!-- <script src="https://www.solodev.com/_/assets/phone/jquery.mobilePhoneNumber.js"></script> -->

	<script>
		// $(document).ready(function() {
		// jQuery(function($){
		// 	  var input = $('[type=tel]')
		// 	  input.mobilePhoneNumber({allowPhoneWithoutPrefix: '+1'});
		// 	  input.bind('country.mobilePhoneNumber', function(e, country) {
		// 		$('.country').text(country || '')
		// 	  })
		// 	 });
		// });
	</script>
</body>
</html>