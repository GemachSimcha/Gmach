
						<!-- DOESNT WORK YET -->

						DELIMITER //
						CREATE PROCEDURE insertfullLoan 
						BEGIN
						INSERT INTO person (FirstName, LastName, TeudatZehut, Cellular, HomePhone, Address, SumOfLoans)
						VALUES (' ', ' ','','','','','');
						INSERT INTO loan (TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments, FutureInstallments, DoneTransactions,) 
						VALUES (' ', '','','','','','','','');
						END//

						DELIMITER ;




						DELIMITER //
						CREATE PROCEDURE insertfullLoan (IN person TEXT)
						BEGIN
						INSERT INTO person (FirstName, LastName, TeudatZehut, Cellular, HomePhone, Address, SumOfLoans)
						VALUES (???????);
						INSERT INTO loan (TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments, FutureInstallments, DoneTransactions,) 
						VALUES (?????????);
						END//

						DELIMITER ;


						DELIMITER //
						CREATE FUNCTION insertfullLoan ()
						BEGIN
						INSERT INTO person (FirstName, LastName, TeudatZehut, Cellular, HomePhone, Address, SumOfLoans)
						VALUES ('".$FirstName."','".$LastName."','".$TeudatZehut."','".$Cellular."','".$HomePhone."','".$Address."','".$SumOfLoans."');
						INSERT INTO loan (TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments, FutureInstallments, DoneTransactions,) 
						VALUES ('".$TotalLoan."','".$Currency."','".$Method."','".$DateOfLoan."','".$DateOfFinalPayment."','".$Areivim."','".$Areivim."','".$NumberOfPayments."','".$FutureInstallments."','".$DoneTransactions."');
						END//

						DELIMITER ;





						DELIMITER //
						CREATE FUNCTION insertfullLoan ()
						BEGIN
						INSERT INTO person (FirstName, LastName, TeudatZehut, Cellular, HomePhone, Address, SumOfLoans)
						VALUES ('@FirstName','@LastName','@TeudatZehut','@Cellular','@HomePhone','@Address','@SumOfLoans');
						INSERT INTO loan (TotalLoan, Currency, Method, DateOfLoan, DateOfFinalPayment, Areivim, NumberOfPayments, FutureInstallments, DoneTransactions,) 
						VALUES ('@TotalLoan','@Currency','@Method','@DateOfLoan','@DateOfFinalPayment','@Areivim','@NumberOfPayments','@FutureInstallments','@DoneTransactions');
						END//

						DELIMITER ;	




						                 