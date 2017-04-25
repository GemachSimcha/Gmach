<?php

echo '<p>בס"ד</p>';

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null :
  define('SITE_ROOT', DS.'wamp'.DS.'www'.DS.'gmach');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
// Database Constants
defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER') ? null :define("DB_USER", "root");
defined('DB_PASS') ? null :define("DB_PASS", "GemachSimcha");
defined('DB_NAME') ? null :define("DB_NAME", "gmach");

$mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

$mysqli->set_charset("utf8");

     
if (isset($_POST['newloaner_submit'])) {
    /*   variables for insert functions     */

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $telephone = $_POST['telephone'];
    $cellphone = $_POST['cellphone'];
    $address = $_POST['address'];
    $idnumber = $_POST['idnumber'];
    $SumOfLoans = $_POST['TotalLoan'];
    $NumberOfPayments = $_POST['NumberOfPayments'];
    $currency = $_POST['Currency'] ;
    $method = $_POST['Method'] ;
    $DateOfLoan = $_POST['DateOfLoan'] ;
    $DateOfFinalPayment = $_POST['DateOfFinalPayment'] ;
    $Areivim = $_POST['Areivim'] ;

// INSERT PERSON FOLDER
    $person_insert = "INSERT INTO Person (FirstName, LastName, TeudatZehut, Cellular, HomePhone, Address, SumOfLoans) VALUES (?,?,?,?,?,?,?)";

    $person_stmt = $mysqli->prepare($person_insert);
    $person_stmt->bind_param("sssssss",$firstname, $lastname, $idnumber, $cellphone, $telephone, $address, $SumOfLoans);
    //execute query
    $person_stmt->execute();    // can use: if (!$person_stmt->execute()) with error msg
    
// INSERT INTO LOAN  FOLDER 
    $loan_folder_insert = "INSERT INTO Loan (Person_FirstName, Person_Cellular, TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments/*, FutureInstallments, DoneTransactions*/) VALUE (?,?,?,?,?,?,?,?,?/*,?,?*/)";
    $loan_folder_stmt = $mysqli->prepare($loan_folder_insert);
    $loan_folder_stmt->bind_param("sssssssss", $firstname, $cellphone, $SumOfLoans, $currency, $method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments);
    $loan_folder_stmt->execute();
    
// INSRT loan transaction into TRANSACTION FOLDER
    $loan_transaction_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'Loan')";
    $loan_transaction_stmt = $mysqli->prepare($loan_transaction_insert);
    $loan_transaction_stmt->bind_param("ssssss", $firstname, $cellphone, $DateOfLoan, $currency, $method, $SumOfLoans);
    $loan_transaction_stmt->execute();

        //CLOSE EXECUTE
        $person_stmt->close();
        $loan_folder_stmt->close();
        $loan_transaction_stmt->close();


// INSRT repay installments into TRANSACTION FOLDER
      
    if (isset($_POST['installments'])) {

        // if selected radio = monthly
        /*code for monthly installments*/
        if ($_POST['options'] === "monthly") {            

            // to convert selected day in the month to correct mysql date format            
            $nowDate = new DateTime();
            $d = $nowDate->format('d');
            $m = $nowDate->format('m');
            $Y = $nowDate->format('Y');

            $X = $_POST['DayInMonth'];            

            $nowDate->setDate($Y , $m , $X);

            if ($d>$X) {
                $nowDate->modify( '+1 month');
            } // end of date conversion

            $installment_date = $nowDate->format('Y-m-d');
            $installment_currency = $_POST['monthly_Currency'];
            $installment_method = $_POST['monthly_Method'];
            $installment_amount = $_POST['monthly_Amount'];

            $installment_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";

            $installment_stmt = $mysqli->prepare($installment_insert);
                
            if(!$installment_stmt->bind_param("ssssss",$firstname, $cellphone, $installment_date, $installment_currency, $installment_method, $installment_amount)) {
                echo "binding did not work</br>";
            }

            $installment_stmt->execute();

            /*  foreach NumbeOfPayments    */

            $i = 1;
            while ($i <= $NumberOfPayments) {
                $nowDate->modify( '+1 month');
                $next_installment_date = $nowDate->format('Y-m-d');

                $installment_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";

                $installment_stmt = $mysqli->prepare($installment_insert);

                if(!$installment_stmt->bind_param("ssssss",$firstname, $cellphone, $next_installment_date, $installment_currency, $installment_method, $installment_amount)) {
                    echo "binding did not work</br>";}

                $installment_stmt->execute();
                $i++;  
            } 

            $installment_stmt->close();

        }  // end monthly installments

        /*code for specified installments*/
        elseif ($_POST['options'] === "specified") {
                // constant variables
            $installment_currency = $_POST['installment_Currency'];
            $installment_method = $_POST['installment_Method'];
            
            //  foreach transaction
            $installments = 1;
            while ($installments <= $_POST['NumberOfPayments']) {

                $installment_amount = $_POST['installment_amount'];
                $installment_date = $_POST['installment_date'];

                $installment_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";

                $installment_stmt = $mysqli->prepare($installment_insert);
                    
                if(!$installment_stmt->bind_param("ssssss",$firstname, $cellphone, $installment_date, $installment_currency, $installment_method, $installment_amount)) {
                    echo "binding did not work</br>";}

                $installment_stmt->execute();

                $installments++;
            }   // end foreach transaction
        }   // end code for specified transactions
    }  // end of all installments
     else {
        echo "<div></div>";   // can edit this message 
    }
} // end of ($_POST['submit'])





if (isset($_POST['oldLoaner_submit'])) {
    

    $loan_insert = "INSERT INTO Loan (Person_FirstName, Person_Cellular, TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments/*, FutureInstallments, DoneTransactions*/) VALUE (?,?,?,?,?,?,?,?,?/*,?,?*/)";

    $loan_stmt = $mysqli->prepare($loan_insert);

            $firstname = $_POST['firstname'];
            $cellphone = $_POST['cellphone'];
            $SumOfLoan = $_POST['TotalLoan'];
            $currency = $_POST['Currency'];
            $method = $_POST['Method'];
            $DateOfLoan = $_POST['DateOfLoan'];
            $DateOfFinalPayment = $_POST['DateOfFinalPayment'];
            $Areivim = $_POST['Areivim'];
            $NumberOfPayments = $_POST['NumberOfPayments'];
            $_SESSION['NumberOfPayments'] = $NumberOfPayments;
                // $FutureInstallments = $_POST['FutureInstallments'];
                // $DoneTransactions = $_POST['DoneTransactions'];

    
    if(!$loan_stmt->bind_param("sssssssss",$firstname, $cellphone, $SumOfLoan, $currency, $method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments)){
            echo "bind_param not working!";
            } 
     // $loan_stmt->bind_param("sssssssssss",$firstname, $cellphone, $SumOfLoans, $currency, $method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments, $FutureInstallments, $DoneTransactions);

    //EXECUTE QUERY
    elseif (!$loan_stmt->execute()) {
            echo '<h4 style="color:red; margin-right: 50px">כנראה שאני כבר ברשימה... (או שהפרטים לא מדוייקים?)</h4>';
    }

    //CLOSE EXECUTE
    $loan_stmt->close();

    // // // // loan transaction

    $transactions_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $loan_stmt = $mysqli->prepare($loan_insert);


    // update old sum of loans
            // retreive old sum
            $old_total_select = "SELECT SumOfLoans FROM person WHERE FirstName ='".$firstname."' AND Cellular = '".$cellphone."'";
            $old_TotalLoan = $mysqli->query($old_total_select);
            $total_row = $old_TotalLoan->fetch_array(MYSQLI_NUM);
            $All_Loans = $total_row[0] + $SumOfLoan;
            $old_TotalLoan->close();

            // add new sum
            $new_total_select ="UPDATE person SET SumOfLoans = '".$All_Loans."'  WHERE FirstName ='".$firstname."' AND Cellular = '".$cellphone."'";
            $new_total = $mysqli->query($new_total_select);

            // installments
                // if ($NumberOfPayments > 1) {
                //     header('Location: ../includes/installments.php');
                // }

            // transactions
        $transactions_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $transactions_stmt = $mysqli->prepare($transactions_insert);

                $transaction_date = $_POST['DateOfInstallment'];
                $transaction_currency = $_POST['transaction_Currency'];
                $transaction_method = $_POST['transaction_Method'];
                $transaction_amount = $_POST['transaction_Amount'];
                $Explaination = 'RepayLoan';


            if($_POST['transaction_submit']) {
                
                /***********************************************
                /
                /       foreach NumbeOfPayments                */

                if(!$transaction_stmt->bind_param("sssssssss",$firstname, $cellphone, $transaction_date, $transaction_currency, $transaction_method, $transaction_amount, $Explaination)){
            echo "bind_param not working!";
            } 


            }
    
    }

}