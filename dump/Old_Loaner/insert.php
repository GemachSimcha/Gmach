

        <!-- If Existing Person borrows -->

<?php
require_once("../includes/functions.php");
session_start(); 
$_SESSION['oldsite'] = $_SERVER['PHP_SELF'];


/* once function created remember to uncomment */
 insertLoan($mysqli);


?>
<!DOCTYPE html>
<html>
<head>
    <title>הלואה חדשה</title>
    <link href="../includes/styles.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>

    <div>
        <h1>הלואה חדשה</h1>

        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <table>
                
            <!-- CAN ALSO BE A SCREEN IF LINKED FROM PERSON PAGE -->
            <!-- IT WILL THEN AUTOFILL BORROWER FIELD -->

                <tr>
                    <td>לוה - שם פרטי</td>
                    <td>
                    <input type="text" name="firstname" id="firstname"></td>
                </tr>
                <tr>
                    <td>לוה - פלאפון</td>
                    <td>
                    <input type="text" name="cellphone" id="cellphone"></td>
                </tr>
                <tr>
                    <td>סכום ההלואה</td>
                    <td><input type="text" name="TotalLoan" id="TotalLoan"></td>
                </tr>
                <tr>
                    <td>מטבע וצורה</td>
                    <td>
                        <select name="Currency" style="width:30%">
                          <option value="shekel">שקל</option>
                          <option value="dollar">דולר</option>
                          <option value="euro">אירו</option>
                          <option value="other">אחר</option>
                        </select>
                        <select name="Method" style="width:50%">
                          <option value="cash">מזומן</option>
                          <option value="check">צ'יק</option>
                          <option value="transfer">העברה בנקאית</option>
                          <option value="credit-card">כרטים אשראי</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>תאריך ההלואה</td>
                    <td><input type="date" name="DateOfLoan" id="DateOfLoan" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
                </tr>
                <tr>
                    <td>תאריך תשלום(אחרון)</td>
                    <td><input type="date" name="DateOfFinalPayment" id="DateOfFinalPayment" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
                </tr>
                <tr>
                    <td>ערבים</td>
                    <td><input type="text" name="Areivim" id="Areivim"></td>
                </tr>
               <tr>
                   <td>תשלומים</td>
                   <td><input style="width:60%" type="number" name="NumberOfPayments" id="NumberOfPayments" placeholder="מספר תשלומים" min="0" max="150"></td>
                   
               </tr>
              
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" id="submit" value="הוסף"></td>
                </tr>




            </table>
        </form>
    </div>

</body>
</html>

    <?php include_once 'testscreen.php'; ?>
