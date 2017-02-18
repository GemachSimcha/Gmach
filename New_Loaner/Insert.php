<?php

include_once("../includes/functions.php");
session_start(); 


insertPerson($mysqli);



   
?>
<!DOCTYPE html>
<html>
<head>

	<title>הוסף אנשים חדשים</title>
    <link href="../includes/styles.css" media="all" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="insert">
<h1>הוסף אנשים חדשים</h1>

    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table id="insert">
            
            <tr>
                <td>שם פרטי</td>
                <td><input type="text" name="firstname" id="firstname"></td>
            </tr>
            <tr>
                <td>שם משפחה</td>
                <td><input type="text" name="lastname" id="lastname"></td>
            </tr>
            <tr>
                <td>תעודת זהות</td>
                <td><input type="text" name="idnumber" id="idnumber"></td>
            </tr>
            <tr>
                <td>פלאפון</td>
                <td><input type="text" name="cellphone" id="cellphone" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
            </tr>
            <tr>
                <td>טלפון</td>
                <td><input type="text" name="telephone" id="telephone"></td>
            </tr>
            <tr>
                <td>כתובת</td>
                <td><input type="text" name="address" id="address"></td>
            </tr>
            <tr>
                <td>סכום ההלואה</td>
                <td><input type="text" name="TotalLoan" id="TotalLoan"></td>
            </tr>
            <tr>
                <td>מטבע וצורה</td>
                <td>
                    <select name="Currency" style="width: 30%">
                      <option value="shekel">שקל</option>
                      <option value="dollar">דולר</option>
                      <option value="euro">אירו</option>
                      <option value="other">אחר</option>
                    </select>
                    <select name="Method" style="width: 50%">
                      <option value="cash">מזומן</option>
                      <option value="check">צ'יק</option>
                      <option value="transfer">העברה בנקאית</option>
                      <option value="creditCcard">כרטים אשראי</option>
                      <option value="horaatKeva">הוראת קבע</option>
                    </select>
                </td>
            </tr>            
            <tr>
                <td>תאריך ההלואה</td>
                <td><input type="date" name="DateOfLoan" id="DateOfLoan" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
            </tr>
            <tr>
                <td>תאריך תשלום(אחרון)</td>
                <td><input type="date" name="DateOfFinalPayment" id="DateOfFinalPayment"></td>
            </tr>
            <tr>
                <td>ערבים</td>
                <td><input type="text" name="Areivim" id="Areivim"></td>
            </tr>
            <tr>
                <td>תשלומים</td>
                <td><input style="width:55%" type="number" name="NumberOfPayments" id="NumberOfPayments" placeholder="מספר תשלומים" min="0" max="150"></td>
            </tr>           
            <tr>
                <td></td>
                <td id="submit"><input type="submit" name="submit" id="submit" value="הוסף"></td>
            </tr>




        </table>
    </form>
    </div>
    </body>
</html>

    <?php include_once 'testscreen.php'; ?>
