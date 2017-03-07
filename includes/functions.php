<?php

echo '<p>בס"ד</p>';

$mysqli = new mysqli("localhost", "root", "Skype2015", "gmach");

$mysqli->set_charset("utf8");


function insertPerson($mysqli){ 

if ($_POST['submit']){


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
    if (!$person_stmt->execute()) {
            echo '<h4 style="color:red; margin-right: 50px">כנראה שאני כבר ברשימה... (או שהפרטים לא מדוייקים?)</h4>';
    } 


// INSERT INTO LOAN  FOLDER 
    $loan_folder_insert = "INSERT INTO Loan (Person_FirstName, Person_Cellular, TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments/*, FutureInstallments, DoneTransactions*/) VALUE (?,?,?,?,?,?,?,?,?/*,?,?*/)";
    $loan_folder_stmt = $mysqli->prepare($loan_folder_insert);
    $loan_folder_stmt->bind_param("sssssssss", $firstname, $cellphone, $SumOfLoans, $currency, $method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments);
    $loan_folder_stmt->execute();
    

// INSRT loan transaction FOLDER
    $loan_transaction_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'Loan')";
    $loan_transaction_stmt = $mysqli->prepare($loan_transaction_insert);
    $loan_transaction_stmt->bind_param("ssssss", $firstname, $cellphone, $DateOfLoan, $currency, $method, $SumOfLoans);
    $loan_transaction_stmt->execute();



//CLOSE EXECUTE
$person_stmt->close();
$loan_transaction_stmt->close();


// installments   
      
    if ($_POST['installments']) {


        // radio = monthly
        if ($_POST['options'] === "monthly") {

            /*code for monthly installments*/


            // to convert selected day of every month to correct mysql date format
            
            $nowDate = new DateTime();

            $X = $_POST('DayOfMonth');
            $d = $nowDate->format('d');
            $m = $nowDate->format('m');
            $Y = $nowDate->format('Y');

            $nowDate->setDate($Y , $m , $X);

            if ($d>$X) {
                $nowDate->modify( '+1 month');
            } 

            $formatted_nowDate = $nowDate->format('Y-m-d');
            



        }  // radio = specified
            elseif ($_POST['options'] === "specified") {

            /*code for specified installments*/



        }

            // needs to be foreach transaction

            $installment_date = $_POST['DayOfMonth'];
            // month needs to be added to date
            $installment_currency = $_POST['monthly_Currency'];
            $installment_method = $_POST['monthly_Method'];
            $installment_amount = $_POST['monthly_Amount'];

        $installment_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";

        $installment_stmt = $mysqli->prepare($installment_insert);
            
            /***********************************************
            /
            /       foreach NumbeOfPayments                */

        if(!$installment_stmt->bind_param("ssssss",$firstname, $cellphone, $installment_date, $installment_currency, $installment_method, $installment_amount)) {
            echo "binding did not work</br>";}

        $installment_stmt->execute();



    } else {
        echo "no תשלומים";
    }
}




} 






function insertloan($mysqli){

    // 

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

        if($_POST['submit']) {
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
            if ($NumberOfPayments > 1) {
                header('Location: ../includes/installments.php');
            }

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
?>
   





