<?php
/****************
* File: displaytables.php
* Date: 1.13.2009
* Author: design1online.com, LLC
* Purpose: display all table structure for a specific database
****************/
/****************
* File: temb.php
* Edited Date: 1.16.2017
* Author: Me
* Purpose: MYSQLI
****************/

//connection variables

$mysqli = new mysqli("localhost", "root", "GemachSimcha", "gmach");


$query = "SHOW tables FROM gmach";
$result = $mysqli->query($query);   

while($table = $result->fetch_array(MYSQLI_NUM)) 
{

    echo "
        <table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" width=\"75%\">
            <tr bgcolor=\"#666666\">
                <td colspan=\"5\" align=\"center\"><b><font color=\"#FFFFFF\">" . $table[0] . "</font></td>
            </tr>
            <tr>
                <td>Field</td>
                <td>Type</td>
                <td>Key</td>
                <td>Default</td>
                <td>Extra</td>
            </tr>";

    $i = 0; //row counter
    $row = $mysqli->query("SHOW columns FROM " . $table[0])
    or die ('cannot select table fields');

    while ($col = $row->fetch_array(MYSQLI_NUM))
    {
        echo "<tr";

        if ($i % 2 == 0)
            echo " bgcolor=\"#CCCCCC\"";

        echo ">
            <td>" . $col[0] . "</td>
            <td>" . $col[1] . "</td>
            <td>" . $col[2] . "</td>
            <td>" . $col[3] . "</td>
            <td>" . $col[4] . "</td>
        </tr>";

        $i++;
    } //end row loop

  //   echo '<script
  // src="https://code.jquery.com/jquery-3.1.1.slim.js"
  // integrity="sha256-5i/mQ300M779N2OVDrl16lbohwXNUdzL/R2aVUXyXWA="
  // crossorigin="anonymous"></script></br>
    echo '<script src="jquery-3.1.1.min.js"></script>';
    echo "</table><br/><br/>";
} //end table loop

/* free result set */
$result->free();

/* close connection */
$mysqli->close();
?>