<?php 

include_once('partials/config.php');
include('partials/db_connection.php');


//set default values

$id = 0;
$question = "";
$paragraph = "";
$option1 = "";
$option2 = "";
$option3 = "";
$option4 = "";
$answer = "";

//add paragraph question


if(isset($_POST['add'])){
    //get add data from form
    $question = $_POST['question'];
    $paragraph = $_POST['paragraph'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];

    //create sql query to add paragraph question into a database

    $sql = "INSERT INTO paragraph_question SET 
            question='$question',
            paragraph='$paragraph',
            option1='$option1',
            option2='$option2',
            option3='$option3',
            option4='$option4',
            answer='$answer'
            ";
    //create database connection

    $conn = dbConnect();

    //execute sql query

    $result = mysqli_query($conn,$sql);

    //check sql executed or not

    if($result==TRUE) {
        //Success
        $_SESSION['message']='Paragraph Question Added Successfully';
        $_SESSION['msg_type']='success';
        header("location: ".SITEURL."admin/manage-paragraph-question.php");
    } else {
        //Failed to add paragraph question
        $_SESSION['message']='Failed to add paragraph question';
        $_SESSION['msg_type']='danger';
        header("location: ".SITEURL."admin/manage-paragraph-question.php");
    }
}

//delete paragraph question

if(isset($_GET['delete'])) {
    //get selected id
    $id = $_GET['delete'];

    //create a query to delete selected id

    $sql = "DELETE FROM paragraph_question WHERE id=$id";

    //create database connection
    $conn = dbConnect();

    //execute a query

    $result = mysqli_query($conn,$sql);

    //check whether the query executed successfully or not

    if($result==TRUE) {
        //success
        $_SESSION['message'] = 'Paragraph Question Deleted Successfully';
        $_SESSION['msg_type']='success';
        header("location: ".SITEURL."admin/manage-paragraph-question.php");
    } else {
        //Failed to delete paragraph question

        $_SESSION['message'] = 'Failed to delete paragraph question';
        $_SESSION['msg_type']='danger';
        header("location: ".SITEURL."admin/manage-paragraph-question.php");

    }
}

//Edit

if(isset($_GET['edit'])){
   //get selected id

   $id = $_GET['edit'];

   //create sql query to get selected data

   $sql = "SELECT * FROM paragraph_question WHERE id=$id";


   //create database connection

   $conn = dbConnect();

   //execute query 

   $result = mysqli_query($conn,$sql);

   //check whether the query executed successfully or not

   if($result==TRUE) {
       if(mysqli_num_rows($result)==1) {
           $row = mysqli_fetch_assoc($result);
           $id = $row['id'];
           $question = $row['question'];
           $paragraph = $row['paragraph'];
           $option1 = $row['option1'];
           $option2 = $row['option2'];
           $option3 = $row['option3'];
           $option4 = $row['option4'];
           $answer = $row['answer'];

       }
   }
}

//Update

if(isset($_POST['update'])){
    //get all data from form

    $id = $_POST['id'];
    $question = $_POST['question'];
    $paragraph = $_POST['paragraph'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $answer = $_POST['answer'];

    //create database connection

    $conn = dbConnect();

    //create sql query to update selected data

    $sql = "UPDATE paragraph_question SET
    question='$question',
    paragraph='$paragraph',
    option1='$option1',
    option2='$option2',
    option3='$option3',
    option4='$option4',
    answer='$answer'
    WHERE id=$id
    ";

    //execute query

    $result = mysqli_query($conn,$sql);

    //check whether the query exexuted or not

    if($result==TRUE) {
        //Success
        $_SESSION['message']="Paragraph Question Updated Successfully.";
        $_SESSION['msg_type']='success';
        header("location: ".SITEURL."admin/manage-paragraph-question.php");
    } else {
        //Failed to update paragraph question
        $_SESSION['message']="Failed to update paragraph question";
        $_SESSION['msg_type']='danger';
        header("location: ".SITEURL."admin/manage-paragraph-question.php");
    }
}



?>