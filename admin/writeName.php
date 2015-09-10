<?php




if(isset($_POST['clanName'])) {

		// secho $_POST['clanName'];


		$txt = $_POST['clanName'];


		$myfile = fopen("clanName.txt", "w") or die("Unable to open file!");
		/*$txt = "okx\n";*/
		fwrite($myfile, $txt);
		/*$txt = "ok etc\n";
		fwrite($myfile, $txt);*/
		fclose($myfile);

}

?>

