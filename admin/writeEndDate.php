<?php




if(isset($_POST['endDate'])) {

		echo $_POST['endDate'];


		$txt = $_POST['endDate'];


		$myfile = fopen("EndDate.txt", "w") or die("Unable to open file!");
		/*$txt = "okx\n";*/
		fwrite($myfile, $txt);
		/*$txt = "ok etc\n";
		fwrite($myfile, $txt);*/
		fclose($myfile);

}

?>

