<div role="tabpanel" class="tab-pane" id="donation">

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
    <table class="form_group">
      <tr >
          <td><label for="firstname">שם פרטי</label></td>
          <td><input type="text" class="form-control" name="firstname" id="firstname" placeholder="שם פרטי"></td>
      </tr>
      <tr>
          <td><label for="lastname">שם משפחה</label></td>
          <td><input type="text" name="lastname" id="lastname" class="form-control" placeholder="שם משפחה"></td>
      </tr>
      <tr class="no_spin">
          <td><label for="cellphone">פלאפון</label></td>
          <td><input type="number" name="cellphone" id="cellphone" class="form-control" placeholder="פלאפון"></td>
      </tr>
      <tr class="no_spin">
          <td><label for="telephone">טלפון</label></td>
          <td><input type="number" name="telephone" id="telephone" class="form-control" placeholder="טלפון"></td>
      </tr>
      <tr class="no_spin has-warning">
          <td><label for="TotalDonation">סכום תרומה</label></td>
          <td><input type="number" name="TotalDonation" id="TotalDonation" class="form-control" placeholder="סכום תרומה   - שדה חובה!" required oninvalid="this.setCustomValidity('שדה חובה')" oninput="setCustomValidity('')"></td>
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
          <td><label for="DateOfDonation">תאריך</label></td>
          <td><input type="text" name="DateOfDonation" id="donation_datepicker" class="form-control datepicker" placeholder="תאריך"></td>
      </tr>
      <tr>
      <td></td>
        <td>
              <input type="submit" name="donation_submit" class="btn btn-block" value="הוסף" style="width: 50%">
        </td>
      </tr> 
    </table>
  </form>
</div> <!-- donation tab -->