<?php

if (isset($_POST['newPerson_submit'])) {
    $person_insert = "INSERT INTO Person (FirstName, LastName, TeudatZehut, Cellular, HomePhone, Address) VALUES (?,?,?,?,?,?)";
    $person_stmt = $mysqli->prepare($person_insert);
    $person_stmt->bind_param("ssssss",$firstname, $lastname, $idnumber, $cellphone, $telephone, $address);
    $person_stmt->execute();   
    $person_stmt->close();
}

if (isset($_POST['loan_submit'])) {
    $parts = explode( " ", $fullname );
    $lastname = array_pop($parts);
    $firstname = implode( " ", $parts );
    // UPDATE 'person' FOLDER
        // retrieve old SumOfLoans
    $old_total_select = "SELECT SumOfLoans FROM person WHERE FirstName ='".$firstname."' AND Cellular = '".$cellphone."'";
    $old_TotalLoan = $mysqli->query($old_total_select);
    $total_row = $old_TotalLoan->fetch_array(MYSQLI_NUM);
    $All_Loans = $total_row[0] + $TotalLoan;
    $old_TotalLoan->close();
        // update 'person' folder
    $person_folder_update = "UPDATE person SET SumOfLoans = '".$All_Loans."'  WHERE FirstName ='".$firstname."' AND Cellular = '".$cellphone."'";
    $person_folder_query = mysqli_query($mysqli,$person_folder_update);
    // INSERT INTO 'LOAN'  FOLDER 
        // first check if loaner in folder then UPDATE not INSERT
    $loan_folder_select = "SELECT NumberOfPayments, Areivim, transactions, isActive FROM loan WHERE person_FirstName = '".$firstname." ' AND person_Cellular = '".$cellphone."' ";
    $find_loaner = $mysqli->query($loan_folder_select);
    if ($found_loaner = $find_loaner->fetch_array(MYSQLI_NUM)) {
        if ($found_loaner[3] == 1) { // if there is a current loan
            $NumberOfPayments = $found_loaner[0] + $NumberOfPayments;
            $Areivim = $found_loaner[1] . " " . $Areivim;
        }
        $previous_transactions = $found_loaner[2];
        /****
            This is not ideal - We should show client all original loan info, and client edits before we overwrite, at the moment info gets overwritten
        */
        $loan_folder_update = "UPDATE loan SET TotalLoan='".$All_Loans."', Currency='".$Currency."', Method='".$Method."', DateOfLoan='".$DateOfLoan."', DateOfFinalPayment='".$DateOfFinalPayment."', Areivim='".$Areivim."', NumberOfPayments='".$NumberOfPayments."' WHERE  person_FirstName ='".$firstname."' AND person_Cellular = '".$cellphone."'  ";
        $loan_update_query = mysqli_query($mysqli,$loan_folder_update);
    }   // else INSERT
    else {
        $loan_folder_insert = "INSERT INTO `loan` (`person_FirstName`, `person_Cellular`, `TotalLoan`, `Currency`, `Method`, `DateOfLoan`, `DateOfFinalPayment`, `Areivim`, `NumberOfPayments`) VALUES (?,?,?,?,?,?,?,?,?)";
        $loan_folder_stmt = $mysqli->prepare($loan_folder_insert);
        $loan_folder_stmt->bind_param("sssssssss", $firstname, $cellphone, $TotalLoan, $Currency, $Method, $DateOfLoan, $DateOfFinalPayment, $Areivim, $NumberOfPayments);
        if(  $loan_folder_stmt->execute()) {    } else {
            $error = $mysqli->errno . ' ' . $mysqli->error;
            echo $error; // 1054 Unknown column 'foo' in 'field list'
        }
        $loan_folder_stmt->close();
    }
        // INSERT loan transaction into 'TRANSACTION' FOLDER
    $TotalLoan = -$TotalLoan;
    /*INSERT INTO `transactions` (`idTransactions`, `loan_person_FirstName`, `loan_person_Cellular`, `deposit_person_FirstName`, `deposit_person_Cellular`, `Donor_info`, `Date`, `Currency`, `Method`, `Amount`, `Explaination`, `confirmed`) VALUES (NULL, 'a', '1', NULL, NULL, '', NULL, 'Shekel', 'Cash', '6', 'Loan', 'yes')*/
    $loan_transaction_insert = "INSERT INTO transactions (loan_person_FirstName, loan_person_Cellular, Date, Currency, Method, Amount, Explaination, confirmed) VALUES (?, ?, ?, ?, ?, ?, 'Loan', 'yes')";
    $loan_transaction_stmt = $mysqli->prepare($loan_transaction_insert);
    $loan_transaction_stmt->bind_param("ssssss", $firstname, $cellphone, $DateOfLoan, $Currency, $Method, $TotalLoan);
    if(  $loan_transaction_stmt->execute()) {    } else {
        $error = $mysqli->errno . ' ' . $mysqli->error;
        echo $error; 
    }
    $loan_transaction_stmt->close();
    // get installment id and enter into loan folder
    // header('location: index.php');
}

if (isset($_POST['repay_submit'])) {
    // UPDATE 'person' FOLDER
        // retrieve old SumOfLoans
        // update SumOfLoans
    // UPDATE 'loan' FOLDER
    // INSERT repay into 'transaction' folder
    header('location: index.php');
}

if (isset($_POST['deposit_submit'])) {
    // UPDATE 'person' FOLDER
        // retrieve old SumOfDeposits
        // update SumOfDeposits
    // INSERT INTO 'deposit' FOLDER
    // INSERT deposit into 'transaction' folder
    header('location: index.php');
}

if (isset($_POST['withdrawal_submit'])) {
    // UPDATE 'person' FOLDER
        // retrieve old SumOfDeposits
        // update SumOfDeposits
    // UPDATE 'deposit' FOLDER
    // INSERT withdrawal into 'transaction' folder
    header('location: index.php');
}
if (isset($_POST['donation_submit'])) {
    // INSERT donation into 'transaction' folder
    $Donor = $firstname . " " . $lastname . " " . $cellphone . " " . $telephone;
    $deposit_transaction_insert = "INSERT INTO transactions (Donor_info, Date, Currency, Method, Amount, Explaination, confirmed) VALUES (?, ?, ?, ?, ?, 'Donation', 'yes')";
    $deposit_transaction_stmt = $mysqli->prepare($deposit_transaction_insert);
    $deposit_transaction_stmt->bind_param("sssss", $Donor, $DateOfLoan, $Currency, $Method, $TotalDonation);
    $deposit_transaction_stmt->execute();
    $deposit_transaction_stmt->close();
    header('location: index.php');
}

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

