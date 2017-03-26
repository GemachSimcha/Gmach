<?php

require_once("../includes/functions.php");


$query = "SELECT * FROM loan";



?>
<!DOCTYPE html>
<html>
<head>


	<title>הלואות</title>
    <link href="../includes/styles.css" media="all" rel="stylesheet" type="text/css" />

</head>
<body dir="rtl">
<h1>הלואות</h1>

<table>
	<tr>
        <th>הלואה מס'</th>
		<th>שם פרטי ומשפחה</th>
		<th>סכום הלוואות</th>
        <th>סוג מטבע</th>
        <th>צורת הלואה</th>
        <th>תאריך הלואה</th>
        <th>תאריך פירעון (אחרון)</th>
		<th>ערבים</th>
        <th>מספר תשלומים</th>
        <th>פעולות עתידות</th>
		<th>פעולות קודמות</th>
	</tr>
	
		<?php

if($results = $mysqli->query($query)){


    /* fetch object array */
    while ($rows = $results->fetch_array(MYSQLI_NUM)) {
        /*find last name*/
        $lastname_select = "SELECT LastName FROM person WHERE FirstName = '" .$rows[1] ."' AND Cellular = '".$rows[2] . "'";
        $lastname_query = $mysqli->query($lastname_select);
        $lastname_row = $lastname_query->fetch_array(MYSQLI_NUM);
        $lastname = $lastname_row[0];


        print_r ('<tr>
            <td>'.$rows[0].'</td>
            <td>'.$rows[1].' '.$lastname.'</td>
            <td>'.$rows[3].'</td>
            <td>'.$rows[4].'</td>
            <td>'.$rows[5].'</td>
            <td>'.$rows[6].'</td>
            <td>'.$rows[7].'</td>
            <td>'.$rows[8].'</td>
            <td>'.$rows[9].'</td>
            <td>'.$rows[10].'</td>
            <td>'.$rows[11].'</td>
       		</tr>
        		');
    }
        
    /* free result set */
    $results->close();
}

?>
	
</table>
</body>
</html>



