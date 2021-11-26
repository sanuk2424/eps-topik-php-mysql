<?php

//incldue constant.php fro SITEURL

define('BASEURLADDRESS','http://localhost/eps-topik/');
//Destroy the session

session_destroy(); //unsets $_SESSION['user']
// 2Redirect to login Page
header("location: ".BASEURLADDRESS."admin");

?>