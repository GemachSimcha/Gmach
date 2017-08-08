  <div role="tabpanel" class="tab-pane" id="loan">

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
    <table class="form_group">
        <tr  class="has-warning">
           <td><label for="firstname">שם פרטי</label></td>
            <td><input type="text" class="form-control" name="firstname" id="firstname" placeholder="שם פרטי - שדה חובה!"></td>
        </tr>
        <tr class="no_spin has-warning">
            <td><label for="cellphone">פלאפון</label></td>
            <td><input type="number" name="cellphone" id="cellphone" class="form-control" placeholder="פלאפון  - שדה חובה!" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
        </tr>
        <tr class="no_spin has-warning">
          <td><label for="TotalLoan">סכום ההלואה</label></td>
          <td><input type="number" name="TotalLoan" id="TotalLoan" class="form-control" placeholder="סכום ההלואה   - שדה חובה!" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
      </tr>
      <tr class="form-inline">
          <td><label for="Currency Method">מטבע וצורה</label></td>
          <td>
              <select name="Currency" class="form-control" id="Currency">
                <option value="shekel">שקל</option>
                <option value="dollar">דולר</option>
                <option value="euro">אירו</option>
                <option value="other">אחר</option>
              </select>
              <select name="Method" class="form-control" id="Method">
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
         <label for="installments">תשלומים</label><input type="checkbox" id="installments" name="installments">
         <input type="number" name="NumberOfPayments" id="NumberOfPayments" class="form-control" placeholder="מספר תשלומים" min="1" style="width: 50%">
        </td>
      </tr>
      <tr id="selectedMethod">
        <td></td>
        <td class="form-check">
           <label class="form-check-label" for="monthly">
           <input class="form-check-input" type="radio" name="options" <?php if (isset($monthlyOrSpecific) && $monthlyOrSpecific=="monthly") echo "checked";?> value="monthly">   חודשי
           </label> 
        </td>
      </tr>
      <tr class="form-inline" id="monthlyDetails1">
        <td></td>
        <td class="no_spin"><input class="form-control" style="width:19%" type="number" name="monthly_Amount" id="monthly_Amount" placeholder="סכום"><input class="form-control" style="width:31%" type="number" name="DayInMonth" id="DayInMonth" placeholder="תאריך חודשי" min="1" max="31"></td>
      </tr>
      <tr id="monthlyDetails2">
        <td></td>
        <td class="form-inline">
          
          <select class="form-control" name="monthly_Currency" style="width:25%">
            <option value="shekel">שקל</option>
            <option value="dollar">דולר</option>
            <option value="euro">אירו</option>
            <option value="other">אחר</option>
          </select>
          <select class="form-control" name="monthly_Method" style="width:25%">
            <option value="check">צ'יק</option>
            <option value="transfer">העברה בנקאית</option>
            <option value="cash">מזומן</option>
            <option value="credit-card">אחר</option>
          </select>
          
        </td>
      </tr>
      <tr id="selectedMethod">
        <td></td>
        <td class="form-check">
          <label for="" class="form-check-label" for="specificied">
            <input class="form-check-input" type="radio" name="options" <?php if (isset($monthlyOrSpecific) && $monthlyOrSpecific=="specificied") echo "checked";?> value="specificied">    אחר
          </label>
        </td>
      </tr>                         
      <tr id="specificiedDetails">
        <td></td>
        <td class="form-inline">
          <select class="form-control" name="installment_Currency" style="width:25%">
            <option value="shekel">שקל</option>
            <option value="dollar">דולר</option>
            <option value="euro">אירו</option>
            <option value="other">אחר</option>
          </select>
          <select class="form-control" name="installment_Method" style="width:25%">
            <option value="check">צ'יק</option>
            <option value="transfer">העברה בנקאית</option>
            <option value="cash">מזומן</option>
            <option value="credit-card">אחר</option>
          </select>          
        </td>
      </tr>
      <tr class="installments form-inline" id="repay1">
        <td></td>
        <td><input class="form-control" style="width:25%" type="number" name="installment_amount" id="installment_amount" placeholder="סכום"><input type="text" style="width:25%" name="installment_date" id="datepickers1" placeholder="תאריך" class="form-control datepicker"></td>
      </tr>
      <tr>
        <td></td>
        <td>
          <input type="submit" name="loan_submit" class="btn btn-block" value="הוסף" style="width: 50%">
        </td>
      </tr>
    </table>
  </form>
</div>