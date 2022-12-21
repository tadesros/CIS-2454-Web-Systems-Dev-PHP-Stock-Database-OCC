# Project 1 - Stock Database

Hide Assignment Information
Instructions
https://classroom.github.com/a/TcPRNI9r

Please submit the URL to your project repository AND a self assessment using the rubric

Continue working on the Stock program that was demonstrated in lecture, add the CRUD operations for Users and Transactions.

For Transactions:

When inserting a row, have form fields for user_id, symbol, and quantity. 

 Do a query on the stock table to get the current price from the database.  
Then, you need to ensure that the user specified has enough cash_balance for the amount needed to purchase the stock. 
 If they don't, display an error message and don't insert the transaction row. 
 If they do, update the user row and reduce the cash_balance by the total purchase price of the stocks purchased.

For updating a row, don't bother with any special checking or updating of the user table, it's more complicated that it's worth.

For deleting a row, increase the users cash_balance by the quantity of stock * the current_price, not the purchase price 
( you'll need to go lookup the current price of the stock in the stocks table to calculate that ).

Users table CRUD operations, 1 point per INSERT, SELECT, UPDATE, DELETE
4 points
4 points

Transactions table: SELECT displays all transactions
1 point
1 points

Transactions table: UPDATE changes the row
1 point
1 points

Transactions table: INSERT gets the current stock price, checks the users balance, and updates the balance or displays an error
5 points
5 points

Transactions table: DELETE gets the current stock price, updates the users balance, deletes the row
1/1

**********

Project 2 

**********

Instructions
Please submit the URL to your Project 1 repository AND a self assessment using the rubric.

Please continue modifying the Stock Application program to use classes for Users and Transactions. 
 You are welcome to use the example from class videos as a starting point, but please leave a comment citing your source at the top of each file you use.

Be sure to update the Model, View, and Controllers for each.

Users model is updated to use classes
3 points
3 points
Score of Users model is updated to use classes: 3 / 3

Users view is updated to use classes
2 points
2 points
Score of Users view is updated to use classes: 2 / 2

Users controller is updated to use classes
3 points
3 points
Score of Users controller is updated to use classes: 3 / 3

Transactions model is updated to use classes
3 points
3 points
Score of Transactions model is updated to use classes: 3 / 3

Transactions view is updated to use classes
2 points
2 points
Score of Transactions view is updated to use classes: 2 / 2

Transactions controller is updated to use classes
3 points
0 points
Score of Transactions controller is updated to use classes: 3 / 3