<!DOCTYPE html>
  <!--The model for creating classes,functions and use is based on the example demonstrated by Professor Eric Charnesky's 
  lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU -->

<?php
//Controller File
//Controllers Job -
//* Get parameters figure out what you want to do
//* Call the business logic
//* Sent you the correct view: Could be redirect back, Error Message
try{
    //Only get's loaded once
    require_once 'utility/ensure_logged_in.php';
    require_once 'models/database.php';
    require_once 'models/users.php';

    //What we are looking for
    $action = htmlspecialchars(filter_input(INPUT_POST,"action"));

    //Look for values from input form
    $name = htmlspecialchars(filter_input(INPUT_POST,"name"));
    $email_address = htmlspecialchars(filter_input(INPUT_POST,"email_address"));    
    $cash_balance = filter_input(INPUT_POST,"cash_balance", FILTER_VALIDATE_FLOAT);
   

    //INSERT/Update
    if($action == "insert_or_update" && $name !="" && $email_address !="" && $cash_balance != 0){
         
        $insert_or_update = filter_input(INPUT_POST,'insert_or_update');

        //Make a user object
        $user = new User($name,$email_address,$cash_balance);
               
         //Check value of insert_or_update
         if($insert_or_update == "insert"){
             insert_user($user);
         }
         else if($insert_or_update == "update"){
             update_user($user);
         }     
         header("Location: users.php");
    }
    else if($action == "delete" && $email_address !="")
    {
      //Make a user object
      $user = new User($name,$email_address,$cash_balance);  
      delete_user($user);
      header("Location: users.php");
    }
    else if($action !="")
    {
        $error_message =  "Missing name, email-address or cash-balance ";
        include('views/error.php');
    }
      //Get stocks using a function
     $users = list_users();
      
      //stocks view
      include('views/users.php');
      
}
catch (Exception $e){
    
    $error_message = $e->getMessage();
    include('views/error.php');
    //* Star is a bad habit. You can get stuff you don't expect
    //More explicit better  
}

