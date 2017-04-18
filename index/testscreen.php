<?php


require_once("../includes/functions.php");


?>


    <div class="window">
      <table class="table table-bordered table-hover table-condensed" id="myTable" >
         <thead id="stikyhead">
             <tr>
                 <th width="175">שם </th>
                 <th>פלאפון</th>
                 <th>סכום הלוואות</th>
                 <th>סכום פקדונות</th>
                 <th>פעיל</th>
             </tr>
         </thead>

         <tbody id="myTableBody">
                 
                     <?php

             $query = "SELECT * FROM Person";

             if ($result = $mysqli->query($query)) {

                 /* fetch object array */
                 while ($row = $result->fetch_array(MYSQLI_NUM)) {
                     $fullname = $row[1] . ', ' . $row[0];
                     print_r ('<tr>
                             <td><a href="#' . $fullname . '">' . $fullname . '</a></td>
                             <td><a href="#' . $row[3] . '">' . $row[3] . '</a></td>
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
                

         </tbody>
      </table>

    </div>
    


