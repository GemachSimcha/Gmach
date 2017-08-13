<?php
$connect = mysqli_connect("localhost", "root", "root", "gmach");
$request = mysqli_real_escape_string($connect, $_POST["query"]);
$query = "SELECT * FROM person WHERE FirstName LIKE '%{$request}%'";
$result = mysqli_query($connect, $query);

$data = array();

if(mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$data[] = $row["name"];
	}
	echo json_encode($data);
}

?>


	</table>
</div>
