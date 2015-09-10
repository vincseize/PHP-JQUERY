<?php


/*		$myfile = fopen("timeLeft.txt", "w") or die("Unable to open file!");

		fwrite($myfile, 'txt2000');
		fclose($myfile);
*/


if(isset($_POST['thisday'])) {



		$day = $_POST['thisday'];
		$hour = $_POST['thishour'];
		$min = $_POST['thismin'];
		$sec = '0';

		// $date = "2015-06-14 17:16:00";


		$thisYear = Date("Y");
		$thisMonth = Date("m");
		$thisDay = Date("d");
		$thisHour = Date("H");
		$thisMinute = Date("i");
		$thisSecond = Date("s");

		 $date = new DateTime($thisYear.'-'.$thisMonth.'-'.$thisDay.' '.$thisHour.':'.$thisMinute.':'.$thisSecond.'');
		//$date = new DateTime('Y-m-d H:i:s');
		// $date->modify('+1 day');
		$date->modify('+'.$day.' day');
		$date->modify('+'.$hour.' hour');
		$date->modify('+'.$min.' minute');
		// $date->modify('+'.$sec.' second');
		/*echo $date->format('Y-m-d H:i:s'); // 2014-01-04
		echo "<br>";*/


		$CTdate = $date->format('Y-m-d H:i:s'); // 2014-01-04


		$txt = $day.';'.$hour.';'.$min.';'.$sec.';'.$CTdate;


		$myfile = fopen("timeLeft.txt", "w") or die("Unable to open file!");

		fwrite($myfile, $txt);
		fclose($myfile);

}

?>

