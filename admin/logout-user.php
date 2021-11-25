<?php 

include('partials/config.php');
//Destroy the session

session_destroy(); //unsets $_SESSION['user']
// 2Redirect to login Page
header("location: ".SITEURL."admin");

?>