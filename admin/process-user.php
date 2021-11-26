<?php 
// session_start();

// //define('SITEURL','http://localhost/eps-topik/');


// //Create Constant to store non repeating values.
// define('DB_HOST','localhost');
// define('DB_USERNAME','root');
// define('DB_PASSWORD','');
// define('DB_NAME','eps-topik-php');


// function dbConnect(){
//     $conn = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());   //Database connection
//     $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //Selecting database
//     return $conn;
// }

include_once('partials/config.php');
include('partials/db_connection.php');


$id=0;
$update = false;
$first_name ="";
$last_name ="";
$username="";
$email="";
$password="";


//Add User
//check whether the submit button is clicked or not

if(isset($_POST['submit'])) {
    //Get all the data from form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    //check validation if user enter empty data 
    if(!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email) && !empty($password)){
        //check database if username and email address already exist or not
        //if username already exist set the session message
        // redirec to manage-user.php page
        if(!isEmailExist($email) AND !isUsernameExist($username)) {
            try{
                 //Create sql query to insert data into database
            $sql_query = "INSERT INTO users SET 
            first_name='$first_name',
            last_name='$last_name',
            username='$username',
            email='$email',
            password='$password'
            ";
             //database connection 
             $conn = dbConnect();

            //execute query 
            $result = mysqli_query($conn,$sql_query);

            // check whether the query executed successfully or not
            if($result==TRUE) {
                //Query executed successfully;
                 //Set session message
                $_SESSION['message'] = "User Added Successfully ";
                $_SESSION['msg_type']='success';
                //Redirect to manage-user.php page
                header("location:".SITEURL."admin/manage-user.php");

            } else {
                $_SESSION['message'] = "Failed to add user ";
                $_SESSION['msg_type']='error';
                //Redirect to manage-user.php page
                header("location:".SITEURL."admin/manage-user.php");
            }
            }finally {
                mysqli_close($conn);
            }
           
        } else {
            //set the session message 
            $message = "";
            if(isEmailExist($email)) {
                $message =  "Email Already exist,Try another Email";
                
            } else if(isUsernameExist($username)){
                $message = "Username Already exist,Try another Username";

            }
            $_SESSION['message'] = $message;
            $_SESSION['msg_type']='danger';

            //redirect to manage-user.php page
            header("location: ".SITEURL."admin/manage-user.php");
        }
    }
}

function isEmailExist($email) {

    try{
        $conn = dbConnect();
        //Create a sql query to check email already exist or not
        $sql = "SELECT * FROM users WHERE email='$email'";

   
        //execute sql query
        $res = mysqli_query($conn,$sql);
    
        //check query executed succssfully or not
  
   
          //count the record.if record is 1 then email already exist else record not found the go further proces
        $count = mysqli_num_rows($res);

       
        if($count == 1){
            return TRUE;
        } else {
            return FALSE;
        }  

    } 
    finally{
        mysqli_close($conn);
    }    
}



function isUsernameExist($username) {
   
    try {
        $conn = dbConnect();
         //Create a sql query to check email already exist or not
        $sql = "SELECT * FROM users WHERE username='$username'";

        //execute sql query
   
         $res = mysqli_query($conn,$sql);
  
        //check query executed succssfully or not
 
         //count the record.if record is 1 then username already exist else record not found the go further proces
       $count= mysqli_num_rows($res);
  
       if($count == 1){
           return TRUE;
       } else {
           return FALSE;
       }    

    } finally {
        mysqli_close($conn);
    }  
}


//Delete User
// check button is clicked or not
if(isset($_GET['delete']) && $_GET['delete']!=""){
   
    try {
         //get delete id
        $id= $_GET['delete'];

        //dbconnection 
        $conn = dbConnect();
        //create sql query
        $sql = "DELETE FROM users WHERE id='$id'";

        // execute query

        $result = mysqli_query($conn,$sql);

        // check query executed successfully or not
        if($result==TRUE) {
             //Successfully executed query
            //set the session Message
            $_SESSION['message'] = 'User has been deleted!';
            $_SESSION['msg_type'] = 'success';
            //redirect to manage-user.php page
            header("location: ".SITEURL."admin/manage-user.php");
           
        } else {
            //Query Failed to execute
            //set the session Message
            $_SESSION['message'] = 'Failed to delete user';
            $_SESSION['msg_type'] = 'danger';
            //redirect to manage-user.php page
            header("location: ".SITEURL."admin/manage-user.php");
        }
    

    } finally {
        mysqli_close($conn);
        

    }
} 


//Edit User

//check whether edit button is clicked or not
if(isset($_GET['edit']) && $_GET['edit']!=""){
    try {
        $conn =dbConnect();
        //get id
        $id = $_GET['edit'];
        //create sql query to get selected user id
        $sql = "SELECT * FROM users WHERE id=$id";

        //Execute query

        $result = mysqli_query($conn,$sql);

        //check query executed  successfully or not

        if($result==TRUE) {
            //Get data
            $count = mysqli_num_rows($result);
            if($count==1) {
                $update = true;
                $row = mysqli_fetch_assoc($result);
                $id= $row['id'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $username = $row['username'];
                
                $email = $row['email'];
                $password  = $row['password'];
            
            }

        }

    }finally {

        mysqli_close($conn);


    }
}

//Update User
// check whether the update user button is clicked or not
if(isset($_POST['update'])) {
    //Get all the data from form

    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];


    //create sql query to update selected user

    $sql = "UPDATE users SET
    first_name='$first_name',
    last_name='$last_name',
    username='$username',
    email='$email'
    WHERE id=$id
    ";



    //check is user submited the empty data
    if(!empty($first_name) && !empty($last_name) && !empty($username) && !empty($email)){
        //check is user enter already existing username or not
        //later we will check validation
        //check username and email already exist or not

        if(user_exist($username,$email,$id)) {
            // echo "Username or email already exist of id selected";
            $conn = dbConnect();

            // create sql query
            $sql_query_email = "SELECT * FROM users WHERE 
            email NOT IN (SELECT email FROM users WHERE !(username='$username' OR email='$email'))";
           $sql_query_username = "SELECT * FROM users WHERE 
           username NOT IN (SELECT username FROM users WHERE !(username='$username' OR email='$email'))";
          //Execute query
          

          $result_username = mysqli_query($conn,$sql_query_username);
           $result_email = mysqli_query($conn,$sql_query_email);

           

           //check query executed successfully or not

          
           if($result_email ==TRUE AND $result_username ==TRUE) {
                //check email/username already exist or not
                if((mysqli_num_rows($result_username)==1) AND (mysqli_num_rows($result_email)==1)){
                    try {

            $conn = dbConnect();
            //execute query 
            $result = mysqli_query($conn,$sql);

            //check query executed successfully or not
            if($result==TRUE) {
                //Query executed successfully
                $_SESSION['message']="User Updated Successfully!";
                $_SESSION['msg_type'] ="success";
                header("location: ".SITEURL."admin/manage-user.php");
            } else {
                //Failed to execute query
                $_SESSION['message']="Failed To Update User!";
                $_SESSION['msg_type'] ="danger";
                header("location: ".SITEURL."admin/manage-user.php");
                
            }

        } finally {
            mysqli_close($conn);

        }
                    

                } else {
                    //echo "Username/Email Already exist";
                    $_SESSION['message']="Username or Email Already exist";
                    $_SESSION['msg_type'] ="danger";
                    header("location: ".SITEURL."admin/manage-user.php");
                    
                }

           } else {
            //    echo "Failed to execute query";
               $_SESSION['message']="Failed to execute query";
               $_SESSION['msg_type'] ="danger";
               header("location: ".SITEURL."admin/manage-user.php");
           }
            

        } else {
            // further go
            $_SESSION['message']='Unauthorized Access';
            $_SESSION['msg_type']='danger';
            header("location: ".SITEURL."admin/manage-user.php");
            // echo "update here";
            // stop the process
            die();
        }

       
        // try {

        //     $conn = dbConnect();
        //     //execute query 
        //     $result = mysqli_query($conn,$sql);

        //     //check query executed successfully or not
        //     if($result==TRUE) {
        //         //Query executed successfully
        //         $_SESSION['message']="User Updated Successfully!";
        //         $_SESSION['msg_type'] ="success";
        //         header("location: ".SITEURL."admin/manage-user.php");
        //     } else {
        //         //Failed to execute query
        //         $_SESSION['message']="Failed To Update User!";
        //         $_SESSION['msg_type'] ="danger";
        //         header("location: ".SITEURL."admin/manage-user.php");
                
        //     }

        // } finally {
        //     mysqli_close($conn);

        // }
        

    } else {
        //set the fill out message
        $_SESSION['message']="Please fill out all fields";
        $_SESSION['msg_type']="danger";
        header("location: ".SITEURL."admin/manage-user.php?edit=$id");
        //redirect to manage-user.php
    }
}



function user_exist($username,$email,$id=0) {
    //connect to database
    $conn = dbConnect();
    //create sql query
    $sql = "SELECT * FROM users WHERE 
    (username='$username' OR email='$email')
    ";
    if($id!=0) {
        $sql .= "  AND id=$id";
    }
  
    //execute the query
    $result = mysqli_query($conn,$sql);
    return mysqli_num_rows($result)>0? true : false;
}

//change Password

// check whether the change button clicked or not

if(isset($_POST['passwordChange'])) {
    //Get all information from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    //check in database table if current user exist or not
    

    //create a sql query
    $sql = "SELECT * FROM users where id=$id AND password='$current_password'";

    

    //dbconnection
    $conn = dbConnect();
    
    //execute the query

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1) {
        //Current user exist
        if($new_password== $confirm_password) {

            //Update password
            //create a database connection
            $conn2 = dbConnect();
            
            //create a query
            $sql2 = "UPDATE users SET 
            password='$new_password'
            WHERE id=$id
            ";

            //execute update query to change password

            $result2 = mysqli_query($conn2,$sql2);
            
            //check whether query executed or not
            if($result2 == TRUE) {
                //Successfully changed User password
                // set session message
                $_SESSION['message']="Password Changed Successfully";
                $_SESSION['msg_type'] ="success";
                header("location: ".SITEURL."admin/manage-user.php");

            } else {
                //Failed to changed password
                $_SESSION['message']="Failed to change password";
                $_SESSION['msg_type'] ="danger";
                header("location: ".SITEURL."admin/manage-user.php");

            }


        } else {
            //Unauthorized access to user
            $_SESSION['message']="New and confirm Password dont't match";
            $_SESSION['msg_type'] = "danger";
            header("location: ".SITEURL."admin/manage-user.php");

        }
    } else {
       
        //Unauthorized access to user
        $_SESSION['message']="Current Password don't Match.";
        $_SESSION['msg_type'] = "danger";
        header("location: ".SITEURL."admin/manage-user.php");
    }

}

//check if the login button clicked or not


if(isset($_POST['login'])) {
    // //process for login
    // 1.Get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //database connection
    $conn =dbConnect();

    // 2.create sql to check whether the user with username and password exist or not
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    // 3. execute query
    // check whether the user submit with empty form
    if(!empty($username) && !empty($password)){
        $res = mysqli_query($conn,$sql);
    // check whether the user exist or not
    $count = mysqli_num_rows($res);
    if($count==1) {
        //User Available and login succcess
        $_SESSION['message'] = "Login Successful";
        $_SESSION['msg_type'] = "success";
      
        // create a session if user logged in or  not and logout unset it
        $_SESSION['user'] = $username;
        //Redirect to Dashboard or home page of admin
        header("location: ".SITEURL."admin/manage-dashboard.php");
    } else {
        //User not available
        $_SESSION['login'] = "<div class='alert alert-danger'>Username or Password did not match.</div>";
     
        header("location: ".SITEURL."admin");

    }

    } else {
        $_SESSION['login'] ="<div class='alert alert-danger'>Please fill username and password.</div>";
       
        header("location: ".SITEURL."admin");

    }
    
}


?>

   