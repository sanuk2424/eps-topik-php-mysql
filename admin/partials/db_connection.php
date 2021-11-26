<?php 
//Create Constant to store non repeating values.
define('DB_HOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','eps-topik-php');


function dbConnect(){
    $conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());   //Database connection
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //Selecting database
    return $conn;
}

function dbConnectPreparedStatement() {
    return new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

}




?>