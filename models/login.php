<?php

function login($email_address,$password)
{   
    //Global database object
    global $database;
    
    $query = 'SELECT email_address, password_hash FROM users'
            . ' where email_address = :email_address';
    
    //To run the query you need a statement to prepare the query
    $statement = $database->prepare($query); 
        
    $statement->bindValue(":email_address",$email_address);
    
    //Execute the query (run the query)
    $statement->execute();
    //This might be risky if you have huge amounts of data
    $user = $statement->fetch();    
    //Close the connection
    $statement->closeCursor();
    //Check if NULL     
    if($user == NULL){
        return false;
    }
    //hash the password   
    $password_hash = $user['password_hash'];
    //Check if the entered password / hashed matches value in the database
     return  password_verify($password, $password_hash);
}