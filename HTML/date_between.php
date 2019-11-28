<?php


// $paymentDate = new DateTime(); // Today

// echo $paymentDate->format('d/m/Y'); // echos today! 

$date = '2019-11-28';

$paymentDate = new DateTime($date);;
$contractDateBegin = new DateTime('2019-01-01');
$contractDateEnd  = new DateTime('2020-01-01');

if (
  $paymentDate->getTimestamp() > $contractDateBegin->getTimestamp() && 
  $paymentDate->getTimestamp() < $contractDateEnd->getTimestamp()){
  echo "is between";
}else{
   echo "NO GO!";  
}



exit;





$date = '2019-11-28';

// $timestamp = strtotime('28-11-2019');
$timestamp = strtotime('2019-11-28');
echo $timestamp;
echo "<br>";

$day_before =  $timestamp - 86400; // - 24 heures
$day_before = date('d/m/Y H:i:s', $day_before);
echo $day_before;
echo "<br>";

$day_after =  $timestamp + 86400; // + 24 heures
$day_after = date('d/m/Y H:i:s', $day_after);
echo $day_after;
echo "<br>";

exit;


$day = date("Y-m-d H:i:s");

$day_before =  time() - 86400; // - 24 heures
$day_before = date('d/m/Y H:i:s', $day_before);

$day_after =  time() + 86400; // + 24 heures
$day_after = date('d/m/Y H:i:s', $day_after);

echo $day;
echo "<br>";
echo $day_before;
echo "<br>";
echo $day_after;

?>
