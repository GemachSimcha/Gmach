<?php
// $mysqli
$output = '';
$sql = "SELECT * FROM person WHERE FirstName LIKE '%".$_POST["search"]."%'";
$result = mysqli_query($mysqli, $sql);
if (mysqli_num_rows($result) > 0) {
	$output .='<h4 align="center">Search Result</h4>
';
	$output .='<div class="table-responsive">
	<table class="table table-bordered">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Teudat Zehut</th>
		</tr>';
	while ($row = mysqli_fetch_array(result)) {
		$output .= '
		<tr>
			<td>'.$row["FirstName"].'</td>
			<td>'.$row["LastName"].'</td>
			<td>'.$row["TeudatZehut"].'</td>
		</tr>
		';
	}
	echo $output;
 }
 else {
 	echo "לא נמצא במערכת, הוסף אנשים חדשים";
 }
?>


	</table>
</div>
