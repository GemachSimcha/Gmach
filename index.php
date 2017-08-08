<?php
include('header.php');
include('navbar.php');
?>
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="newPeople">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="navbar-form">
    <table class="form-group">
              
      <tr class="has-warning">
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
      
      <tr>
        <td></td>
        <td>
          <input type="submit" name="newPerson_submit" class="btn btn-block" value="הוסף" style="width: 50%">
        </td>
      </tr>                   
    </table>
  </form>
  </div> <!-- newloaner tab -->
<?php
include('second_form.php');
include('third_form.php');
include('fourth_form.php');
include('fifth_form.php');
include('sixth_form.php');

?>
</div>  <!-- tab-content -->
</nav> <!-- first navbar -->

</section>
</div>
</div>
			
<?php
include('navbar2.php');
include('footer.php');
 ?>


  


  
