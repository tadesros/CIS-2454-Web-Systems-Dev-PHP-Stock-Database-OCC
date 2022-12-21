<?php

//The model for creating the class and functions is based on the example demonstrated by Professor Eric Charnesky's 
//lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU
//User Model File
class User {

    //Private 
    private $id, $name, $email_address, $cash_balance;

    //Constructor
    public function __construct($name, $email_address, $cash_balance, $id = 0) {
        $this->set_name($name);
        $this->set_email_address($email_address);
        $this->set_cash_balance($cash_balance);
        $this->set_id($id);
    }

    //**Getters and Setters**
    //Users: id
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

    //Users: name
    public function set_name($name) {
        $this->name = $name;
    }

    public function get_name() {
        return $this->name;
    }

    //Users: email_address
    public function set_email_address($email_address) {
        $this->email_address = $email_address;
    }

    public function get_email_address() {
        return $this->email_address;
    }

    //Users: cash_balance
    public function set_cash_balance($cash_balance) {
        $this->cash_balance = $cash_balance;
    }

    public function get_cash_balance() {
        return $this->cash_balance;
    }

}

//Function: List Users
function list_users() {
    //Global database object
    global $database;

    $query = 'SELECT id, name, email_address, cash_balance FROM users';
    //To run the query you need a statement to prepare the query
    $statement = $database->prepare($query);
    //Execute the query (run the query)
    $statement->execute();
    //This might be risky if you have huge amounts of data
    $users = $statement->fetchAll();
    //Close the connection
    $statement->closeCursor();
    //Create an array of users
    $users_array = array();
    //Go thru the array
    foreach ($users as $user) {
        $users_array[] = new User($user['name'],
                $user['email_address'], $user['cash_balance'], $user['id']);
    }

    return $users_array;
}
//Function: insert user
function insert_user($user) {
    //Global database object
    global $database;

    //Danger bad approach - SQL Injection Risk
    //Don't ever just plug values in to a query
    //$query - "INSERT INTO stocks (symbol, name, current_price) "
    //         ."VALUES ($symbol, $name, $current_price)";
    $query = "INSERT INTO users(name,email_address,cash_balance)"
            . "VALUES (:name, :email_address, :cash_balance)";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":email_address", $user->get_email_address());
    $statement->bindValue(":name", $user->get_name());
    $statement->bindValue(":cash_balance", $user->get_cash_balance());
    $statement->execute();
    $statement->closeCursor();
}
//Function: update user
function update_user($user) {
    //Global database object
    global $database;

    $query = "update users set name = :name, cash_balance = :cash_balance "
            . "where email_address = :email_address";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":email_address", $user->get_email_address());
    $statement->bindValue(":name", $user->get_name());
    $statement->bindValue(":cash_balance", $user->get_cash_balance());
    $statement->execute();
    $statement->closeCursor();
}
//Function: Update User balance
function update_user_balance($user) {
    //Global database object
    global $database;

    $query = "update users set cash_balance  = :cash_balance "
            . "where id = :id";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":cash_balance", $user->get_cash_balance());
    $statement->bindValue(":id", $user->get_id());
    $statement->execute();
    $statement->closeCursor();
}
//Function: delete user
function delete_user($user) {
    //Global database object
    global $database;

    $query = "delete from users "
            . "where email_address = :email_address";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":email_address", $user->get_email_address());
    $statement->execute();
    $statement->closeCursor();
}
