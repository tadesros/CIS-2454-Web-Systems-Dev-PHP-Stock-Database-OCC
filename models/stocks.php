<?php
//The model for creating the class and functions is based on the example demonstrated by Professor Eric Charnesky's 
//lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU
//Create a class for a Stock object
class Stock {

    //Private attributes
    private $symbol, $name, $current_price, $id;

    //Constructor
    public function __construct($symbol, $name, $current_price, $id = 0) {
        $this->set_symbol($symbol);
        $this->set_name($name);
        $this->set_current_price($current_price);
        $this->set_id($id);
    }

    //Public Getters and Setters for each attribute
    public function set_symbol($symbol) {
        $this->symbol = $symbol;
    }

    public function get_symbol() {
        return $this->symbol;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_current_price() {
        return $this->current_price;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_name($name) {
        $this->name = $name;
    }

    public function set_current_price($current_price): void {
        $this->current_price = $current_price;
    }

    public function set_id($id) {
        $this->id = $id;
    }
}
//Function: List Stock
function list_stocks() {
    //Global database object
    global $database;

    $query = 'SELECT symbol, name, current_price, id FROM stocks';
    //To run the query you need a statement to prepare the query
    $statement = $database->prepare($query);
    //Execute the query (run the query)
    $statement->execute();
    //This might be risky if you have huge amounts of data
    $stocks = $statement->fetchAll();
    //Close the connection
    $statement->closeCursor();
    //Return an array of stocks
    $stocks_array = array();

    foreach ($stocks as $stock) {
        $stocks_array[] = new Stock($stock['symbol'],
                $stock['name'],
                $stock['current_price'],
                $stock['id']);
    }
    return $stocks_array;
}
//Function: Insert Stock
function insert_stock($stock) {
    //Global database object
    global $database;
  
    $query = "INSERT INTO stocks(symbol,name,current_price)"
            . "VALUES (:symbol, :name, :current_price)";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $stock->get_symbol());
    $statement->bindValue(":name", $stock->get_name());
    $statement->bindValue(":current_price", $stock->get_current_price());
    $statement->execute();
    $statement->closeCursor();
}
//Function: Update Stock
function update_stock($stock) {
    //Global database object
    global $database;

    $query = "update stocks set name = :name, current_price = :current_price "
            . "where symbol = :symbol";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $stock->get_symbol());
    $statement->bindValue(":name", $stock->get_name());
    $statement->bindValue(":current_price", $stock->get_current_price());
    $statement->execute();
    $statement->closeCursor();
}
//Function: Delete Stock 
function delete_stock($stock) {
    //Global database object
    global $database;

    $query = "delete from stocks "
            . "where symbol = :symbol";
    //Value binding in PBO protects agains sql injection
    $statement = $database->prepare($query);
    $statement->bindValue(":symbol", $stock->get_symbol());
    $statement->execute();
    $statement->closeCursor();
}
