<?php
$connect = mysqli_connect("localhost", "root", "root", "gmach");
$query = "SELECT CONCAT (`FirstName`, ', ', `LastName`) FROM `person` ";
$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$data() = $row();
	}
	echo json_encode($data);
}

?>
	</table>
</div>
