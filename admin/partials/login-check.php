<?php
//Authorization --Access Control
// check whether the user is logged in or not

if(!isset($_SESSION['user'])){  
    //if user session is not set . 
    //User is not logged in rediredt to login page
    $_SESSION['no-login-message'] = "<div class='alert alert-danger'>Please login to access Admin Panel</div>";
    header("location: ".SITEURL."admin");

}

?>