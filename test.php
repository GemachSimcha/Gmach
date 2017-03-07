<!DOCTYPE html>
<html>
<body>

<?php
$nowDate = new DateTime();

$X = 15;
$d = $nowDate->format('d');
$m = $nowDate->format('m');
$Y = $nowDate->format('Y');

$nowDate->setDate($Y , $m , $X);

if ($d>$X) {
	$nowDate->modify( '+1 month');
} 

$formatted_nowDate = $nowDate->format('Y-m-d');
echo  $formatted_nowDate."</br>";


	// $X = 15;
	// $d = $date->format('d');
	// $m = $date->format('m');
	// $Y = $date->format('Y');

	// $date->setDate($Y , $m , $X); // set the wanted day for the month

	// if($d>$X){ //if the wanted day was after the current day, it means that it next month's one.
	// $date->modify($date, '+1 month');
	// }

?>

</body>
</html>