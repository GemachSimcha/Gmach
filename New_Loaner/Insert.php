<?php

include_once("../includes/functions.php");
session_start(); 


insertPerson($mysqli);



   
?>
<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../includes/styles/bootstrap.min.css">
    <link href="../includes/styles/styles.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../includes/js/jquery-ui-calendar/jquery-ui.css">




	<title>הוסף אנשים חדשים</title>

</head>
<body>

<div class="container">
<div class="row">
  <section class="col-xs-12">
      
<div id="insert">
<h1>הוסף אנשים חדשים</h1>

    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline">
        <table id="insert" class="form-group">
            
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
                <td><input type="tel" name="idnumber" id="idnumber"></td>
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
                    <select name="Currency" style="width: 26%">
                      <option value="shekel">שקל</option>
                      <option value="dollar">דולר</option>
                      <option value="euro">אירו</option>
                      <option value="other">אחר</option>
                    </select>
                    <select name="Method" style="width: 40%">
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
                <td><input type="text" name="DateOfLoan" id="datepick1" class="datepicker"></td>
            </tr>
            <tr>
                <td>תאריך תשלום(אחרון)</td>
                <td><input type="text" name="DateOfFinalPayment" id="datepick2" class="datepicker"></td>
            </tr>
            <tr>
                <td>ערבים</td>
                <td><input type="text" name="Areivim" id="Areivim"></td>
            </tr>
            <tr>
              <td>
                <div class="checkbox">
                    <label>תשלומים    <input type="checkbox"></label>
                </div>
              </td>
              <td>
                <input style="width:44%" type="number" name="NumberOfPayments" placeholder="מספר תשלומים" min="1">
              </td>

            </tr>

            <!-- need to be hidden and shown as needed -->


            <tr>
              <td></td>
              <td>
                   <input type="radio">    חודשי 
              </td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="monthly_Amount" id="monthly_Amount" placeholder="סכום"><input style="width:40%" type="number" name="DayOfMonth" id="DayOfMonth" placeholder="תאריך חודשי" min="1" max="31"></td>
            </tr>
            <tr>
            <td></td>
            <td>
              
              <select name="monthly_Currency" style="width:26%">
                <option value="shekel">שקל</option>
                <option value="dollar">דולר</option>
                <option value="euro">אירו</option>
                <option value="other">אחר</option>
              </select>
              <select name="monthly_Method" style="width:40%">
                <option value="check">צ'יק</option>
                <option value="transfer">העברה בנקאית</option>
                <option value="cash">מזומן</option>
                <option value="credit-card">אחר</option>
              </select>
              
            </td>
            </tr>
            <tr>
              <td></td>
              <td>
                 <input type="radio">    אחר   
              </td>
            </tr>
            <tr>
            <td></td>
            <td>
              
              <select name="installment_Currency" style="width:26%">
                <option value="shekel">שקל</option>
                <option value="dollar">דולר</option>
                <option value="euro">אירו</option>
                <option value="other">אחר</option>
              </select>
              <select name="installment_Method" style="width:40%">
                <option value="check">צ'יק</option>
                <option value="transfer">העברה בנקאית</option>
                <option value="cash">מזומן</option>
                <option value="credit-card">אחר</option>
              </select>
              
            </td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick3" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick4" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick5" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick5" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick6" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick7" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick8" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick9" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick10" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick11" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick12" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick13" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick14" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick15" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick16" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick17" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick18" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick19" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick20" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick21" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick22" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick23" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick24" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick25" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick26" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick27" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick28" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick29" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick30" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick31" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick32" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick33" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick34" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick35" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick36" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick37" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick38" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick39" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick40" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick41" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick42" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick43" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick44" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick45" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick46" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick47" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick48" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick49" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick50" placeholder="תאריך" class="datepicker"></td>
            </tr>
            <tr>
              <td></td>
              <td><input style="width:30%" type="text" name="" id="" placeholder="סכום"><input type="text" name="" id="datepick51" placeholder="תאריך" class="datepicker"></td>
            </tr>






            <tr>
            <td></td>
              <td>
                    <input type="submit" name="submit" class="btn btn-default" value="הוסף">
              </td>
            </tr>                   
            
        
            



        </table>
        
        
    </form>
    </div>
          

  </section>
</div>
</div>    
  
  <?php include_once 'testscreen.php'; ?>


  <script src="../includes/js/jquery-3.1.1.min.js"></script>
  <script src="../includes/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../includes/js/jquery-ui-calendar/jquery-ui.js"></script>
  <script type="text/javascript" src="../includes/js/script.js"></script>



  </body>
</html>

