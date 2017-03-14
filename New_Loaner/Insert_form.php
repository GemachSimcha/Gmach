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


<nav class="navbar clearfix">
    <div class="container-fluid">
      <div class="navbar-header navbar-right"><p class="navbar-brand">פעולות</p></div>
      <ul class="nav nav-tabs navbar navbar-right" role="tablist">
        <li role="presentation" class="active pull-right">
          <a role="tab" data-toggle="tab"
           href="#newloaner">הוסף לוה חדש</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#oldLoaner">הלואה לרשום</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#newDepositor">הוסף מפקיד חדש</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#oldDepositor">פקדון לרשום</a>
        </li>
        <li role="presentation" class="pull-right">
          <a role="tab" data-toggle="tab"
           href="#donation">תרומה</a>
        </li>
      </ul>
      </div> <!-- container-fluid -->

    

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="newloaner">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
        <table class="form_group">
                  
            <tr  class="has-warning">
                <td><label for="firstname">שם פרטי</label></td>
                <td><input type="text" class="form-control" name="firstname" id="firstname" placeholder="שם פרטי - שדה חובה!"></td>
            </tr>
            <tr>
                <td><label for="lastname">שם משפחה</label></td>
                <td><input type="text" name="lastname" id="lastname" class="form-control" placeholder="שם משפחה"></td>
            </tr>
            <tr class="no_spin">
                <td><label for="idnumber">תעודת זהות</label></td>
                <td><input type="number" name="idnumber" id="idnumber" class="form-control" placeholder="תעודת זהות"></td>
            </tr>
            <tr class="no_spin has-warning">
                <td><label for="cellphone">פלאפון</label></td>
                <td><input type="number" name="cellphone" id="cellphone" class="form-control" placeholder="פלאפון  - שדה חובה!" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
            </tr>
            <tr class="no_spin">
                <td><label for="telephone">טלפון</label></td>
                <td><input type="number" name="telephone" id="telephone" class="form-control" placeholder="טלפון"></td>
            </tr>
            <tr>
                <td><label for="address">כתובת</label></td>
                <td><input type="text" name="address" id="address" class="form-control" placeholder="כתובת"></td>
            </tr>
            <tr class="no_spin has-warning">
                <td><label for="TotalLoan">סכום ההלואה</label></td>
                <td><input type="number" name="TotalLoan" id="TotalLoan" class="form-control" placeholder="סכום ההלואה   - שדה חובה!" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
            </tr>
            <tr class="form-inline">
                <td><label for="Currency Method">מטבע וצורה</label></td>
                <td>
                    <select name="Currency" class="form-control" id="Currency" style="width: 44%">
                      <option value="shekel">שקל</option>
                      <option value="dollar">דולר</option>
                      <option value="euro">אירו</option>
                      <option value="other">אחר</option>
                    </select>
                    <select name="Method" class="form-control" id="Method" style="width: 50%">
                      <option value="cash">מזומן</option>
                      <option value="check">צ'יק</option>
                      <option value="transfer">העברה בנקאית</option>
                      <option value="creditCcard">כרטים אשראי</option>
                      <option value="horaatKeva">הוראת קבע</option>
                    </select>
                </td>
            </tr>            
            <tr>

                <td><label for="DateOfLoan">תאריך ההלואה</label></td>
                <td><input type="text" name="DateOfLoan" id="datepick1" class="form-control datepicker"></td>
            </tr>
            <tr>
                <td><label for="DateOfFinalPayment">תאריך תשלום(אחרון)</label></td>
                <td><input type="text" name="DateOfFinalPayment" id="datepick2" class="form-control datepicker" placeholder="תאריך תשלום (אחרון)"></td>
            </tr>
            <tr>
                <td><label for="Areivim">ערבים</label></td>
                <td><input type="text" name="Areivim" id="Areivim" class="form-control" placeholder="ערבים"></td>
            </tr>
            <tr>
            <td></td>
              <td class="form-inline">
               <label for="installments">תשלומים</label><input type="checkbox" name="installments">
               <input type="number" name="NumberOfPayments" class="form-control" placeholder="מספר תשלומים" min="1">
              </td>
            </tr>
            <!-- 


                  need to be hidden and shown as needed

                               -->
            <tr>
              <td></td>
              <td class="form-check">
                 <label class="form-check-label" for="monthly">
                 <input class="form-check-input" type="radio" name="options" <?php if (isset($monthlyOrSpecific) && $monthlyOrSpecific=="monthly") echo "checked";?> value="monthly">   חודשי
                 </label> 
              </td>
            </tr>
            <tr class="form-inline">
              <td></td>
              <td class="no_spin"><input class="form-control" style="width:38%" type="number" name="monthly_Amount" id="monthly_Amount" placeholder="סכום"><input class="form-control" style="width:38%" type="number" name="DayOfMonth" id="DayOfMonth" placeholder="תאריך חודשי" min="1" max="31"></td>
            </tr>
            <tr>
            <td></td>
            <td class="form-inline">
              
              <select class="form-control" name="monthly_Currency" style="width:33%">
                <option value="shekel">שקל</option>
                <option value="dollar">דולר</option>
                <option value="euro">אירו</option>
                <option value="other">אחר</option>
              </select>
              <select class="form-control" name="monthly_Method" style="width:41%">
                <option value="check">צ'יק</option>
                <option value="transfer">העברה בנקאית</option>
                <option value="cash">מזומן</option>
                <option value="credit-card">אחר</option>
              </select>
              
            </td>
            </tr>
            <tr>
              <td></td>
              <td class="form-check">
                <label for="" class="form-check-label" for="specificied">
                  <input class="form-check-input" type="radio" name="options" <?php if (isset($monthlyOrSpecific) && $monthlyOrSpecific=="specificied") echo "checked";?> value="specificied">    אחר
                </label>
                    
              </td>
            </tr>                         
           
            <tr>
            <td></td>
            <td class="form-inline">
              
              <select class="form-control" name="installment_Currency" style="width:33%">
                <option value="shekel">שקל</option>
                <option value="dollar">דולר</option>
                <option value="euro">אירו</option>
                <option value="other">אחר</option>
              </select>
              <select class="form-control" name="installment_Method" style="width:41%">
                <option value="check">צ'יק</option>
                <option value="transfer">העברה בנקאית</option>
                <option value="cash">מזומן</option>
                <option value="credit-card">אחר</option>
              </select>
              
            </td>

            </tr>
            <tr class="installments form-inline">
              <td></td>
              <td><input class="form-control" style="width:38%" type="number" name="installment_amount" id="installment_amount" placeholder="סכום"><input type="text" style="width:38%" name="installment_date" id="datepick3" placeholder="תאריך" class="form-control datepicker"></td>
            </tr>


            <tr>
            <td></td>
              <td>
                    <input type="submit" name="submit" class="btn btn-block" value="הוסף">
              </td>
            </tr>                   
            
         


        </table>
      </form>
      
        </div> <!-- newloaner tab -->

      <div role="tabpanel" class="tab-pane" id="oldLoaner">

      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
        <table class="form_group">
          <tr  class="has-warning">
              <td><label for="firstname">שם פרטי</label></td>
              <td><input type="text" class="form-control" name="firstname" id="firstname" placeholder="שם פרטי - שדה חובה!"></td>
          </tr>
          
        </table>
      </form>
      </div> <!-- oldloaner tab -->

      <div role="tabpanel" class="tab-pane" id="newDepositor">

      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
        <table class="form_group">
          <tr  class="has-warning">
              <td><label for="firstname">שם פרטי</label></td>
              <td><input type="text" class="form-control" name="firstname" id="firstname" placeholder="שם פרטי - שדה חובה!"></td>
          </tr>
          
        </table>
      </form>
      </div> <!-- newDepositor tab -->

      <div role="tabpanel" class="tab-pane" id="oldDepositor">

      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
        <table class="form_group">
          <tr  class="has-warning">
              <td><label for="firstname">שם פרטי</label></td>
              <td><input type="text" class="form-control" name="firstname" id="firstname" placeholder="שם פרטי - שדה חובה!"></td>
          </tr>
          
        </table>
      </form>
      </div> <!-- oldDepositor tab -->

      <div role="tabpanel" class="tab-pane" id="donation">

      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
        <table class="form_group">
          <tr  class="has-warning">
              <td><label for="firstname">שם פרטי</label></td>
              <td><input type="text" class="form-control" name="firstname" id="firstname" placeholder="שם פרטי - שדה חובה!"></td>
          </tr>
          
        </table>
      </form>
      </div> <!-- donation tab -->
      


  </div>  <!-- tab-content -->
  </nav>
  

      

        
            



        
          

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

