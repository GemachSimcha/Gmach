<?php


require_once("../includes/functions.php");


?>

<h1>אנשים</h1>
<div class="container">

    <table class="table table-bordered table-hover table-condensed" id="myTable" >
       <thead>
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
       </thead>
       <tbody id="myTableBody">
               
                   <?php

          try {
            $db=new PDO("mysql:host=localhost;dbname=gmach", "root", "Skype2015");

           $total = $db->query("SELECT COUNT(*)  FROM Person")->fetchColumn();


              $limit = 10;
              $pages = ceil($total / $limit);

              // What page are we currently on?
                  $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
                      'options' => array(
                          'default'   => 1,
                          'min_range' => 1,
                      ),
                  )));

                  // Calculate the offset for the query
                  $offset = ($page - 1)  * $limit;

                  // Some information to display to the user
                  $start = $offset + 1;
                  $end = min(($offset + $limit), $total);

                  // The "back" link
                  $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                  // The "forward" link
                  $nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

                  // Display the paging information
                  echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

                  // Prepare the paged query
                      $stmt = $db->prepare('
                          SELECT
                              *
                          FROM
                              Person
                          LIMIT
                              :limit
                          OFFSET
                              :offset
                      ');

                      // Bind the query params
                      $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                      $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                      $stmt->execute();

                      // Do we have any results?
                      if ($stmt->rowCount() > 0) {
                          // Define how we want to fetch the results
                          $stmt->setFetchMode(PDO::FETCH_ASSOC);
                          $iterator = new IteratorIterator($stmt);

                          // Display the results
                          foreach ($iterator as $row) {
                            $fullname = $row[1] . ', ' . $row[0];
                              echo '<tr>
                            <td><a href="#' . $fullname . '">' . $fullname . '</a></td>
                           <td>' . $row[2] . '</td>
                            <td><a href="#' . $row[3] . '">' . $row[3] . '</a></td>
                           <td>'.$row[4].'</td>
                            <td>'.$row[5].'</td>
                           <td>'.$row[6].'</td>
                            <td>'.$row[7].'</td>';
                           if ($row[8] == 0) { echo '<td>לא</td></tr>'; 
                         } 
                            else { echo '<td>כן</td></tr>';
                          }
                        }

                      } else { echo '<p>No results could be displayed.</p>'; 
                    } } 
                    catch (Exception $e) {
                   echo '<p>', $e->getMessage(), '</p>';
               }
           
                          
                      

               // /* fetch object array */
               // while ($row = $result->fetch_array(MYSQLI_NUM)) {
               //     $fullname = $row[1] . ', ' . $row[0];
               //     print_r ('<tr>
               //             <td><a href="#' . $fullname . '">' . $fullname . '</a></td>
               //             <td>' . $row[2] . '</td>
               //             <td><a href="#' . $row[3] . '">' . $row[3] . '</a></td>
               //             <td>'.$row[4].'</td>
               //             <td>'.$row[5].'</td>
               //             <td>'.$row[6].'</td>
               //             <td>'.$row[7].'</td>'
               //             );
               //             if ($row[8] == 0) { print_r("<td>לא</td></tr>"); } 
               //             else { print_r("<td>כן</td></tr>");}
               //                 }


               
           ?>
               
       </tbody>
    </table>
    <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="myPager"></ul>
    </div>
</div>




