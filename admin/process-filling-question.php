<?php 
include_once('partials/config.php');
include('partials/db_connection.php');

//set default values
$id=0;
$question="";
$option1 = "";
$option2 = "";
$option3 = "";
$option4 = "";
$answer = "";


//add filling question

if(isset($_POST['add'])) {
    //get all data from form

    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];

    //create sql query to add filling question
    $sql = "INSERT INTO filling_question SET
            question='$question',
            option1='$option1',
            option2='$option2',
            option3='$option3',
            option4='$option4',
            answer='$answer'
            ";
    //create database connection

    $conn = dbConnect();

    //execute query

    $result = mysqli_query($conn,$sql);

    //check whether the query executed or not
    if($result==TRUE) {
        //success

        $_SESSION['message']="Filling Question Added Successfully";
        $_SESSION['msg_type']="success";
        header("location: ".SITEURL."admin/manage-filling-question.php");

    } else {
        //Failed to add filling question

        $_SESSION['message']="Failed to add filling question";
        $_SESSION['msg_type']="danger";
        header("location: ".SITEURL."admin/manage-filling-question.php");
    }
}

//delete

if(isset($_GET['delete'])){
    //get selected id

    $id = $_GET['delete'];
    //create sql query to delete selected filling question

    $sql = "DELETE FROM filling_question WHERE id=$id";

    //create database connection
    $conn = dbConnect();


    //execute query 

    $result = mysqli_query($conn,$sql);

    //check whether query exexuted successfully or not

    if($result==TRUE) {
        // success
        $_SESSION['message'] = "Filling Question Deleted Successfully.";
        $_SESSION['msg_type']="success";
        header("location: ".SITEURL."admin/manage-filling-question.php");

    } else {
        //Failed to delete filling question

        $_SESSION['message'] = "Failed to delete filling question";
        $_SESSION['msg_type']="danger";
        header("location: ".SITEURL."admin/manage-filling-question.php");
    }

}

//Edit

if(isset($_GET['edit'])){
   //get data from selected
   $id = $_GET['edit'];

   //create database connection
   $conn = dbConnect();

   //create sql query

   $sql = "SELECT * FROM filling_question WHERE id=$id";

   //execute query

   $result = mysqli_query($conn,$sql);

   //check whether the query executed or not
   if($result==TRUE) {
       if(mysqli_num_rows($result)==1) {
           $row = mysqli_fetch_assoc($result);
           $id = $row['id'];
           $question = $row['question'];
           $option1 = $row['option1'];
           $option2 = $row['option2'];
           $option3 = $row['option3'];
           $option4 = $row['option4'];
           $answer = $row['answer'];
            
       }
   }
}

//update

if(isset($_POST['update'])){
    //get all data from form

    $id = $_POST['id'];
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];

    //Create database connection
    $conn = dbConnect();

    //create sql query to update filling question
    $sql  = "UPDATE filling_question SET
            question='$question',
            option1='$option1',
            option2='$option2',
            option3='$option3',
            option4='$option4',
            answer='$answer'
            WHERE id=$id
            ";
    

    //execute sql query

    $result = mysqli_query($conn,$sql);

    //check whether the query executed or not

    if($result==TRUE) {
        $_SESSION['message']="Filling Question Updated Successfully";
        $_SESSION['msg_type']="success";
        header("location: ".SITEURL."admin/manage-filling-question.php");

    } else {
        //Failed to update filling question

        $_SESSION['message']="Failed to update filling question";
        $_SESSION['msg_type']="danger";
        header("location: ".SITEURL."admin/manage-filling-question.php");
    }
    



}


?>