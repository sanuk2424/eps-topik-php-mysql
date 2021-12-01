<?php 
include_once('partials/config.php');
include('partials/db_connection.php');

//set Default values
$id=0;
$category = "";
$course_title = "";
$body = "";
$active = "";

//add course
if(isset($_POST['add'])) {
    //get the data from form

    $category_id = $_POST['category'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    if(isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = 'No'; //set the default value for active
    }

    //check data entered by user is empty or not
    if(!empty($category_id) && !empty($title) && !empty($body) && !empty($active)) {
        //create sql query to insert data in database

        $sql = "INSERT INTO course SET
        category_id='$category_id',
        title='$title',
        body='$body',
        active='$active'
        ";

        //database connection 
        $conn = dbConnect();

        //execute the query

        $result = mysqli_query($conn,$sql);

        //check whether the data added successfully or not

        if($result==TRUE) {
            //successfully added data
            $_SESSION['message'] = "Course Added Successfully";
            $_SESSION['msg_type'] ="success";
            header("location: ".SITEURL."admin/manage-course.php");


        } else {
            //failed to add data
            $_SESSION['message'] = "Failed to add course";
            $_SESSION['msg_type'] ="danger";
            header("location: ".SITEURL."admin/manage-course.php");
        }



    } else {
        //Fill all fields

        $_SESSION['message'] = "Fill out all fields properly";
        $_SESSION['msg_type'] ="danger";
        header("location: ".SITEURL."admin/manage-course.php");
    }

}

// delete course
if(isset($_GET['delete'])) {
   //get id;
   $id = $_GET['delete'];
   
   //create sql query to delete data

   $sql = "DELETE FROM course WHERE id=$id";

   //Create database connection
   $conn = dbConnect();


   //execute the query

   $result = mysqli_query($conn,$sql);


   //check whether the query executed or not

   if($result ==TRUE) {

       //Success
       $_SESSION['message'] ="Course Deleted Successfully";
       $_SESSION['msg_type']="success";
       header("location: ".SITEURL."admin/manage-course.php");


   }else{
       //Failed to delete course

       $_SESSION['message'] ="Failed to delete course";
       $_SESSION['msg_type']="danger";
       header("location: ".SITEURL."admin/manage-course.php");

   }

}

//Edit Course
if(isset($_GET['edit'])) {
    $id = $_GET['edit'];

    //create sql query to edit selected course

    $sql = "SELECT * FROM course WHERE id=$id";

    //Database connection
    $conn = dbConnect();

    //execute the query

    $result = mysqli_query($conn,$sql);

    //check whether the query executed or not

    if($result==TRUE) {
        //$count
        $count = mysqli_num_rows($result);
        if($count>0) {
            $row = mysqli_fetch_assoc($result);
            $id=$row['id'];
            $category = $row['category_id'];
            $course_title = $row['title'];
            $body = $row['body'];
            $active = $row['active'];
        }
    }



}

//Update Course

if(isset($_POST['update'])) {
   //Get all data from form

   $id = $_POST['id'];
   $category_id = $_POST['category'];
   $title = $_POST['title'];
   $body = $_POST['body'];
   $active = $_POST['active'];

   //create sql query to update course

   $sql = "UPDATE course SET
   category_id=$category_id,
   title='$title',
   body='$body',
   active='$active'
   WHERE id=$id
   ";
   //Database connection

   $conn = dbConnect();

   //execute a query

   $result = mysqli_query($conn,$sql);

   //check whether the query executed or not 

   if($result == TRUE) {
       $_SESSION['message']="Course Updated Successfully";
       $_SESSION['msg_type']="success";
       header('location: '.SITEURL."admin/manage-course.php");
       //Success
   } else {
       //Failed to update course
       $_SESSION['message']="Failed to update course";
       $_SESSION['msg_type']="danger";
       header('location: '.SITEURL."admin/manage-course.php");
   }
}

?>