<?php
include_once 'functions.php';
session_start(); 

?>
<!DOCTYPE html>
<html>
<head>
	<title>תשלומים</title><link href="styles.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>

    <div>
        <h1>תשלומים</h1>

        
        <form method="post" action="<?php echo $_SESSION['URL']; ?>">
            <table>
            	<tr>
            		<td>חודשי</td>
            		<td><input style="width:30%" type="text" name="monthly_Amount" id="monthly_Amount" placeholder="סכום"><input style="width:40%" type="number" name="DayOfMonth" id="DayOfMonth" placeholder="תאריך" min="1" max="30"></td>
            	</tr>
				<?php for ($i=1; $i <= $_SESSION['NumberOfPayments']; $i++) {  ?>
				<tr>
                   <td><?php echo $i?></td>
                   <td><input style="width:30%" type="text" name="transaction_Amount" id="transaction_Amount" placeholder="סכום"><input style="width:65%" type="date" name="DateOfInstallment" id="DateOfInstallment" ></td>
               </tr>
               <?php } ?>
               <tr>
                   <td>מטבע וצורה</td>
                   <td>
                       <select name="transaction_Currency" style="width:30%">
                         <option value="shekel">שקל</option>
                         <option value="dollar">דולר</option>
                         <option value="euro">אירו</option>
                         <option value="other">אחר</option>
                       </select>
                       <select name="transaction_Method" style="width:50%">
                         <option value="cash">מזומן</option>
                         <option value="check">צ'יק</option>
                         <option value="transfer">העברה בנקאית</option>
                         <option value="credit-card">אחר</option>
                       </select>
                   </td>
               </tr>
               <tr>
                   <td></td>
                   <td><input type="submit" name="transaction_submit" id="transaction_submit" value="הוסף"></td>
               </tr>

          	</table>
        </form>
    </div>
</body>
</html>
<?php
?>