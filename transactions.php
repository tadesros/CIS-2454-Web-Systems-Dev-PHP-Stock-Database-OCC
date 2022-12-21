<!DOCTYPE html>

<?php
//The model for creating classes,functions and use is based on the example demonstrated by Professor Eric Charnesky's 
//lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU

//Transactions Controller
try{
    //Only get's loaded once
    require_once 'utility/ensure_logged_in.php';
    require_once 'models/database.php';
    require_once 'models/transactions.php';
    require_once 'models/stocks.php';
    require_once 'models/users.php';

    //What we are looking for
    $action = htmlspecialchars(filter_input(INPUT_POST,"action"));
    //Look for values from input form
    $id = htmlspecialchars(filter_input(INPUT_POST,"id",FILTER_VALIDATE_INT));
    $user_id = htmlspecialchars(filter_input(INPUT_POST,"user_id",FILTER_VALIDATE_INT)); 
    $quantity = filter_input(INPUT_POST,"quantity", FILTER_VALIDATE_FLOAT);
    $stock_id = htmlspecialchars(filter_input(INPUT_POST,"stock_id",FILTER_VALIDATE_INT));    
    $price = htmlspecialchars(filter_input(INPUT_POST,"price",FILTER_VALIDATE_INT));    
    
    //Insert
    if($action == "insert" && $user_id != 0 && $stock_id != 0 && $quantity != 0){
        
            //Get users
             $users = list_users();             
             $user_name = "";
             $user_email_address = "";
             $users_cash_balance = 0;              
             
             //Loop thru cash balance looking for the correct one
             foreach($users as $user) 
             {
                 if($user->get_id() == $user_id)        
                 {
                   $user_name = $user->get_name();
                   $user_email_address = $user->get_email_address();
                   $users_cash_balance  = $user->get_cash_balance();
                 }
             }               
             
             //Get Stocks
             $stocks = list_stocks();
             $stock_price = 0;             
             //Loop thru cash balance looking for the correct one
             foreach($stocks as $stock) 
             {
                 if($stock->get_id() == $stock_id)
                 {
                   $stock_price  = $stock->get_current_price();
                 }
             }  
             
             //Calculate total cost
             $total_cost = $stock_price * $quantity;
                     
             //You can add
             if($users_cash_balance >= $total_cost)
             {
                          
              //Make a transaction object
              $transaction = new Transaction($user_id,$stock_id,$quantity,$price,"");
          
              insert_transaction($transaction);
              
              $new_balance = $users_cash_balance - $total_cost;
              
              $user_object_updated = new User($user_name,$user_email_address,$new_balance);
              update_user($user_object_updated); 
              
              header("Location: transactions.php");
               
             }                         
             //You cannot add
             else{
                  echo $error_message = "Insufficient funds to purchase stocks.";
                
             }               
         
    }
    else if($action == "update" && $user_id != 0
            && $stock_id != 0 && $quantity != 0 
            && $id != 0 && $price != 0 )
    {
            //Make a transaction object
            $transaction = new Transaction($user_id,$stock_id,$quantity,$price,"",$id);
            update_transaction($transaction);
            //Refresh the Page   
            header("Location: transactions.php");
     }      
    else if($action == "delete" && $id !=0)
    {
               
      $transactions = list_transactions();
      
      $stock_id = 0;
      $user_id =0;
      $quantity = 0;  
      $transaction_id = 0;
      
      //Go thru each transaction once you find it get values.
      foreach($transactions as $transaction)
      {
          if($transaction->get_id() == $id)
          {
             $stock_id = $transaction->get_stock_id();  
             $quantity = $transaction->get_quantity();  
             $user_id  =  $transaction->get_user_id(); 
             $transaction_id = $transaction->get_id();
          }                 
      }
            
             //Get Stocks
             $stocks = list_stocks();
             $stock_price = 0; 
             
             //Loop thru cash balance looking for the correct one
             foreach($stocks as $stock) 
             {
                 if($stock->get_id() == $stock_id)
                 {
                   $stock_price  = $stock->get_current_price();
                 }
             }  
             
            //Get users
             $users = list_users();             
             $user_name = "";
             $user_email_address = "";
             $users_cash_balance = 0;              
             
             //Loop thru cash balance looking for the correct one
             foreach($users as $user) 
             {
                 if($user->get_id() == $user_id)        
                 {
                   $user_name = $user->get_name();
                   $user_email_address = $user->get_email_address();
                   $users_cash_balance  = $user->get_cash_balance();
                 }
             }        
     
             //Calculate total cost
             $total_sale = $stock_price * $quantity;
                  
             //Update user
             
             //Calculate new balance
             $new_balance = $users_cash_balance + $total_sale;             
             
             $user_object_updated = new User($user_name,$user_email_address,$new_balance);
             
             update_user($user_object_updated);
             
             //Create a transaction object 
             $transaction_object = new Transaction($user_id,$stock_id,$quantity,$stock_price,"",$transaction_id);
             
              delete_transaction($transaction_object);
              header("Location: transactions.php");
    }
    else if($action !="")
    {
        $error_message =  "Missing stock_id,user_id or quantity ";
        include('views/error.php');
    }
       
     //Get stocks using a function
     $transactions = list_transactions();
     
      //stocks view
      include('views/transactions.php');      
    }
catch (Exception $e){
    
    $error_message = $e->getMessage();
    include('views/error.php');
    //* Star is a bad habit. You can get stuff you don't expect
    //More explicit better  
}

