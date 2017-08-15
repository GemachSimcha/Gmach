<?php

if (isset($_POST['newPerson_submit'])) {
    $person_insert = "INSERT INTO Person (FirstName, LastName, TeudatZehut, Cellular, HomePhone, Address, SumOfLoans) VALUES (?,?,?,?,?,?,?)";
    $person_stmt = $mysqli->prepare($person_insert);
    $person_stmt->bind_param("sssssss",$firstname, $lastname, $idnumber, $cellphone, $telephone, $address, $TotalLoan);
    $person_stmt->execute();   
    $person_stmt->close();
}

if (isset($_POST['loan_submit'])) {
    // INSERT INTO 'LOAN'  FOLDER 
    $loan_folder_insert = "INSERT INTO Loan (Person_FirstName, Person_Cellular, TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments) VALUE (?,?,?,?,?,?,?,?,?)";
    $loan_folder_stmt = $mysqli->prepare($loan_folder_insert);
    $firstname = stripLastname($fullname);
    $loan_folder_stmt->bind_param("sssssssss", $firstname, $cellphone, $TotalLoan, $Currency, $Method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments);
    $loan_folder_stmt->execute();
    // INSERT loan transaction into 'TRANSACTION' FOLDER
    $TotalLoan = -$TotalLoan;
    $loan_transaction_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'Loan')";
    $loan_transaction_stmt = $mysqli->prepare($loan_transaction_insert);
    $loan_transaction_stmt->bind_param("ssssss", $firstname, $cellphone, $DateOfLoan, $Currency, $Method, $TotalLoan);
    $loan_transaction_stmt->execute();
    //CLOSE EXECUTE
    $loan_folder_stmt->close();
    $loan_transaction_stmt->close();
}

if (isset($_POST['repay_submit'])) {}
if (isset($_POST['deposit_submit'])) {}
if (isset($_POST['withdrawal_submit'])) {}
if (isset($_POST['donation_submit'])) {}

if (isset($_POST['newloaner_submit'])) {   // if NEWLOANER tab is submitted
        

// INSERT INTO 'LOAN'  FOLDER 
    $loan_folder_insert = "INSERT INTO Loan (Person_FirstName, Person_Cellular, TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments) VALUE (?,?,?,?,?,?,?,?,?)";
    $loan_folder_stmt = $mysqli->prepare($loan_folder_insert);
    $loan_folder_stmt->bind_param("sssssssss", $firstname, $cellphone, $TotalLoan, $Currency, $Method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments);
    $loan_folder_stmt->execute();
    
// INSERT loan transaction into 'TRANSACTION' FOLDER
    $TotalLoan = -$TotalLoan;
    $loan_transaction_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'Loan')";
    $loan_transaction_stmt = $mysqli->prepare($loan_transaction_insert);
    $loan_transaction_stmt->bind_param("ssssss", $firstname, $cellphone, $DateOfLoan, $Currency, $Method, $TotalLoan);
    $loan_transaction_stmt->execute();

//CLOSE EXECUTE
    $person_stmt->close();
    $loan_folder_stmt->close();
    $loan_transaction_stmt->close();


// INSERT repayments into TRANSACTION FOLDER
      
    if (!isset($_POST['installments'])) {
// INSERT repayment transaction into 'TRANSACTION' FOLDER
     $TotalLoan = -$TotalLoan;
     $repayment_transaction_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";
     $repayment_transaction_stmt = $mysqli->prepare($repayment_transaction_insert);
     $repayment_transaction_stmt->bind_param("ssssss", $firstname, $cellphone, $DateOfFinalPayment, $Currency, $Method, $TotalLoan);
     $repayment_transaction_stmt->execute();   
     $repayment_transaction_stmt->close();   

    } else {     // if repaying in installments
        // if selected radio = monthly
        /*code for monthly installments*/
        if ($_POST['options'] === "monthly") {            

            // to convert selected day in the month to correct mysql date format            
                $nowDate = new DateTime();
                $d = $nowDate->format('d');
                $m = $nowDate->format('m');
                $Y = $nowDate->format('Y');
                $nowDate->setDate($Y , $m , $DayInMonth);
                if ($d>$DayInMonth) {
                    $nowDate->modify( '+1 month');
                } // end of date conversion
            $installment_date = $nowDate->format('Y-m-d');
           
            $installment_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";
            $installment_stmt = $mysqli->prepare($installment_insert);
            $installment_stmt->bind_param("ssssss",$firstname, $cellphone, $installment_date, $monthly_Currency, $monthly_Method, $monthly_Amount);
            $installment_stmt->execute();
            $installment_stmt->close();

                /*  foreach NumbeOfPayments    */
            $i = 2;
            while ($i <= $NumberOfPayments) {
                $nowDate->modify( '+1 month');
                $next_installment_date = $nowDate->format('Y-m-d');

                $installment_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";
                $installment_stmt = $mysqli->prepare($installment_insert);
                $installment_stmt->bind_param("ssssss",$firstname, $cellphone, $next_installment_date, $installment_Currency, $installment_Method, $installment_amount);
                $installment_stmt->execute();
                $installment_stmt->close();
                $i++;  
            } 
        }  // end monthly installments

        /*code for specified installments*/
        elseif ($_POST['options'] === "specified") {
            
            //  foreach transaction
            $installments = 1;
            while ($installments <= $_POST['NumberOfPayments']) {

                $installment_insert = "INSERT INTO `transactions` (`loan_person_FirstName`, `loan_person_Cellular`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`) VALUES (?, ?, ?, ?, ?, ?, 'RepayLoan')";

                $installment_stmt = $mysqli->prepare($installment_insert);
                    
                if(!$installment_stmt->bind_param("ssssss",$firstname, $cellphone, $installment_date, $installment_Currency, $installment_Method, $installment_amount)) {
                    echo "binding did not work</br>";}

                $installment_stmt->execute();

                $installments++;
            }   // end foreach transaction
        }   // end code for specified transactions
    }  // end of all installments     
} // end of ($_POST['newloaner_submit'])



if (isset($_POST['oldLoaner_submit'])) {    // if OLDLOANER tab is submitted

            $firstname = $_POST['firstname'];
            $cellphone = $_POST['cellphone'];
            $SumOfLoan = $_POST['TotalLoan'];
            $Currency = $_POST['Currency'];
            $Method = $_POST['Method'];
            $DateOfLoan = $_POST['DateOfLoan'];
            $DateOfFinalPayment = $_POST['DateOfFinalPayment'];
            $Areivim = $_POST['Areivim'];
            $NumberOfPayments = $_POST['NumberOfPayments'];
            $_SESSION['NumberOfPayments'] = $NumberOfPayments;
                // $FutureInstallments = $_POST['FutureInstallments'];
                // $DoneTransactions = $_POST['DoneTransactions'];

// INSERT INTO LOAN  FOLDER 
    $loan_insert = "INSERT INTO Loan (Person_FirstName, Person_Cellular, TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments/*, FutureInstallments, DoneTransactions*/) VALUE (?,?,?,?,?,?,?,?,?/*,?,?*/)";

    $loan_stmt = $mysqli->prepare($loan_insert);
    $loan_stmt->bind_param("sssssssss",$firstname, $cellphone, $SumOfLoan, $Currency, $Method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments);

    //execute query
    $loan_stmt->execute(); // can add error mesage if!
    
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
                $transaction_Currency = $_POST['transaction_Currency'];
                $transaction_Method = $_POST['transaction_Method'];
                $transaction_amount = $_POST['transaction_Amount'];
                $Explaination = 'RepayLoan';


            if($_POST['transaction_submit']) {
                
                /***********************************************
                /
                /       foreach NumbeOfPayments                */

                if(!$transaction_stmt->bind_param("sssssssss",$firstname, $cellphone, $transaction_date, $transaction_Currency, $transaction_Method, $transaction_amount, $Explaination)){
            echo "bind_param not working!";
            } 


            }
    
    }

