<?php include_once('config.php');

if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
	extract($_REQUEST);
	if($nom==""){
		header('location:'.$_SERVER['PHP_SELF'].'?msg=un&page=0');
		exit;
	}
	// elseif($useremail==""){
	// 	header('location:'.$_SERVER['PHP_SELF'].'?msg=ue&page=0');
	// 	exit;
	// }
	// elseif($userphone==""){
	// 	header('location:'.$_SERVER['PHP_SELF'].'?msg=up&page=0');
	// 	exit;
	// }
	else{
		$userCount	=	$db->getQueryCount('reservations','id');
		// if($userCount[0]['total']<10){
			$data	=	array(
							'nom'=>$nom,
							// 'useremail'=>$useremail,
							// 'userphone'=>$userphone,
							);
			$insert	=	$db->insert('reservations',$data);
			if($insert){
				header('location:browse-users.php?msg=ras&page=0');
				exit;
			}else{
				header('location:browse-users.php?msg=rna&page=0');
				exit;
			}

		// }
		// else{
		// 	header('location:'.$_SERVER['PHP_SELF'].'?msg=dsd&page=0');
		// 	exit;
		// }

	}
}
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
		if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="un"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User name is mandatory field!</div>';
		}
		// elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ue"){
		// 	echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User email is mandatory field!</div>';
		// }
		// elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="up"){
		// 	echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> User phone is mandatory field!</div>';
		// }
		elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="ras"){
			echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record added successfully!</div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Record not added <strong>Please try again!</strong></div>';
		}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="dsd"){
			echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Please delete a user and then try again <strong>We set limit for security reasons!</strong></div>';
		}
		?>

		<div class="panel panel-default">
			<div class="panel-heading clearfix"><i class="fa fa-fw fa-plus-circle"></i> <strong>Add User</strong> <a href="browse-users.php" class="pull-right btn btn-danger btn-sm"><i class="fa fa-fw fa-globe"></i> CLOSE</a></div>
			<div class="panel-body">
				<div class="col-sm-6">
					<!-- // mandatory  -->
					<form method="post">
						<div class="form-group">
							<label>Nom <span class="text-danger">*</span></label>
							<input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
						</div>
						<!-- <div class="form-group">
							<label>User Email <span class="text-danger">*</span></label>
							<input type="email" name="useremail" id="useremail" class="form-control" placeholder="Enter user email" required>
						</div>
						<div class="form-group">
							<label>User Phone <span class="text-danger">*</span></label>
							<input type="tel" class="tel form-control" name="userphone" id="userphone" x-autocompletetype="tel" placeholder="Enter User Phone Number" required>
						</div> -->
						<div class="form-group">
							<button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">
								<i class="fa fa-fw fa-plus-circle"></i> 
								Add User
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
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