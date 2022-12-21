<?php

//Server type location and name
$data_source_name = 'mysql:host=localhost;dbname=stock';
//Username and password - Not best practice no time better way
//Don't usually put credentials in source code
$username = 'stockuser';
$password = 'test';
//PDO - php database object
$database = new PDO($data_source_name,$username,$password);
