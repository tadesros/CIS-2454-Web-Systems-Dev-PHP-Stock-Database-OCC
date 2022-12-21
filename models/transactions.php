<?php

//The model for creating the class and functions is based on the example demonstrated by Professor Eric Charnesky's 
//lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU
//Transaction Class
class Transaction {

    //Private Attributes
    private $user_id, $stock_id, $quantity, $price, $id, $time_stamp;

    //Constructor
    public function __construct($user_id, $stock_id, $quantity, $price, $time_stamp = "", $id = 0) {
        $this->set_user_id($user_id);
        $this->set_stock_id($stock_id);
        $this->set_quantity($quantity);
        $this->set_price($price);
        $this->set_time_stamp($time_stamp);
        $this->set_id($id);
    }

    //**Getters and Setters**
    public function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    //Transaction: stock_id
    public function set_stock_id($stock_id) {
        $this->stock_id = $stock_id;
    }

    public function get_stock_id() {
        return $this->stock_id;
    }

    //Transaction: quantity
    public function set_quantity($quantity) {
        $this->quantity = $quantity;
    }

    public function get_quantity() {
        return $this->quantity;
    }

    //Transaction: price
    public function set_price($price) {
        $this->price = $price;
    }

    public function get_price() {
        return $this->price;
    }

    //Transaction: time_stamp
    public function set_time_stamp($time_stamp) {
        $this->time_stamp = $time_stamp;
    }

    function get_time_stamp() {
        return $this->time_stamp;
    }

    //Transaction: id
    public function set_id($id) {
        $this->id = $id;
    }

    public function get_id() {
        return $this->id;
    }

}

//Function: list transactions
function list_transactions() {
    //Global database object
    global $database;

    $query = 'SELECT user_id, stock_id, quantity, price, timestamp, id'
            . ' FROM transaction';
    //To run the query you need a statement to prepare the query
    $statement = $database->prepare($query);
    //Execute the query (run the query)
    $statement->execute();
    //This might be risky if you have huge amounts of data
    $transactions = $statement->fetchAll();
    //Close the connection
    $statement->closeCursor();
    //Create an array of transactions
    $transaction_array = array();
    //Go thru the array
    foreach ($transactions as $transaction) {
        $transaction_array[] = new Transaction($transaction['user_id'],
                $transaction['stock_id'], $transaction['quantity'], $transaction['price'],
                $transaction['timestamp'], $transaction['id']);
    }

    return $transaction_array;
}
//Function: insert transactions
function insert_transaction($transaction) {
    //Global database object
    global $database;

    $query = "INSERT INTO transaction(user_id, stock_id, quantity, price)"
            . "VALUES (:user_id, :stock_id, :quantity, :price)";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->bindValue(":stock_id", $transaction->get_stock_id());
    $statement->bindValue(":quantity", $transaction->get_quantity());
    $statement->bindValue(":price", $transaction->get_price());
    $statement->execute();
    $statement->closeCursor();
}
//Function: update transactions
function update_transaction($transaction) {
    //Global database object
    global $database;

    $query = "update transaction set user_id = :user_id,"
            . " stock_id = :stock_id,"
            . " quantity = :quantity,"
            . " price = :price"
            . " where id = :id";

    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":user_id", $transaction->get_user_id());
    $statement->bindValue(":stock_id", $transaction->get_stock_id());
    $statement->bindValue(":quantity", $transaction->get_quantity());
    $statement->bindValue(":price", $transaction->get_price());
    $statement->bindValue(":id", $transaction->get_id());
    $statement->execute();
    $statement->closeCursor();
}
//Function: delete transactions
function delete_transaction($transaction) {
    //Global database object
    global $database;

    $query = "delete from transaction "
            . "where id = :id";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":id", $transaction->get_id());
    $statement->execute();
    $statement->closeCursor();
}
