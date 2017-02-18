<?php


require_once("../includes/functions.php");


?>
<!DOCTYPE html>
<html>
<head>


	<title>אנשים</title>
    <link href="../includes/styles.css" media="all" rel="stylesheet" type="text/css" />


</head>

<body>

<h1>אנשים</h1>
<table>
	<tr>
		<th width="175">שם </th>
        <th>תעודת זהות</th>
		<th>פלאפון</th>
        <th>טלפון</th>
		<th>כתובת</th>
        <th>סכום הלוואות</th>
		<th>סכום פקדונות</th>
        <th>פעיל</th>
	</tr>
	
		<?php

$query = "SELECT * FROM Person";

if ($result = $mysqli->query($query)) {

    /* fetch object array */
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        $fullname = $row[1] . ', ' . $row[0];
        print_r ('<tr>
                <td><a href="#' . $fullname . '">' . $fullname . '</a></td>
                <td>' . $row[2] . '</td>
                <td><a href="#' . $row[3] . '">' . $row[3] . '</a></td>
                <td>'.$row[4].'</td>
                <td>'.$row[5].'</td>
                <td>'.$row[6].'</td>
                <td>'.$row[7].'</td>'
                );
                if ($row[8] == 0) { print_r("<td>לא</td></tr>"); } 
        		else { print_r("<td>כן</td></tr>");}
        		    }

    /* free result set */
    $result->close();
}
?>
	
</table>
</body>
</html>



