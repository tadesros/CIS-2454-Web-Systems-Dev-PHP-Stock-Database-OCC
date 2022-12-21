<!DOCTYPE html>

<?php
//The model for creating classes,functions and use is based on the example demonstrated by Professor Eric Charnesky's 
//lecture on php classes @ https://www.youtube.com/watch?v=yxauhPL97jU
//Controller File
//Controllers Job -
//* Get parameters figure out what you want to do
//* Call the business logic
//* Sent you the correct view: Could be redirect back, Error Message
try {
    //Only get's loaded once
    require_once 'utility/ensure_logged_in.php';
    require_once 'models/database.php';
    require_once 'models/stocks.php';

    //What we are looking for
    $action = htmlspecialchars(filter_input(INPUT_POST, "action"));

    //Look for values from input form
    $symbol = htmlspecialchars(filter_input(INPUT_POST, "symbol"));
    $name = htmlspecialchars(filter_input(INPUT_POST, "name"));
    $current_price = filter_input(INPUT_POST, "current_price", FILTER_VALIDATE_FLOAT);

    //INSERT/Update
    if ($action == "insert_or_update" && $symbol != "" && $name != "" && $current_price != 0) {

        $insert_or_update = filter_input(INPUT_POST, 'insert_or_update');

        $stock = new Stock($symbol, $name, $current_price);

        //Check value of insert_or_update
        if ($insert_or_update == "insert") {
            insert_stock($stock);
        } else if ($insert_or_update == "update") {
            update_stock($stock);
        }
        header("Location: stocks.php");
    } else if ($action == "delete" && $symbol != "") {
        //Name and current price do not matter
        $stock = new Stock($symbol, "", 0);
        delete_stock($stock);
        header("Location: stocks.php");
    } else if ($action != "") {
        $error_message = "Missing symbok, name, or current price";
        include('views/error.php');
    }
    //Get stocks using a function
    $stocks = list_stocks();

    //stocks view
    include('views/stocks.php');
} catch (Exception $e) {

    $error_message = $e->getMessage();
    include('views/error.php');
    //* Star is a bad habit. You can get stuff you don't expect
    //More explicit better  
}

