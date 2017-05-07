				<!-- second navbar -->

  <nav class="navbar clearfix"> 
    <div class="container-fluid">
      <div class="navbar-header navbar-right"><p class="navbar-brand">מידע ועדכונים</p></div>
      <ul class="nav nav-tabs navbar navbar-right" role="tablist">
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#uncompleted">פעולות שטרם אושרו</a>
        </li>
        <li role="presentation" class="pull-right active">
          <a role="tab" data-toggle="tab"
           href="#people">אנשים</a>
        </li>
        <li role="presentation" class="pull-right">
            <a role="tab" data-toggle="tab"
             href="#changes">עדכונים</a>
          </li>
        </ul>
    </div> <!-- container-fluid -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane" id="uncompleted">

        <h3>טבלת פעולות שטרם היו/אושרו</h3>

      </div> <!-- uncompleted tab -->
      <div role="tabpanel" class="tab-pane active" id="people">

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
      
      </div> <!-- people tab -->
      <div role="tabpanel" class="tab-pane" id="changes">

        <h3>טופס של שינויי פרטים אישיים ופרטי עסקאות וכו'</h3>

      </div> <!-- changes tab -->

    </div>
  </nav> <!-- second navbar -->