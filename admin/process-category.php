<?php 

include_once('partials/config.php');
include('partials/db_connection.php');
$image_name = "";
$title = "";
$active = "";

// Add Category
if(isset($_POST['add'])) {
    // echo "Button is clicked";
    //1. Get the data from form
    $title = $_POST['title'];
    if(isset($_POST['active'])) {
        $active = $_POST['active'];

    } else {
        $active = "No"; //set the deafult value if user not select 

    }

    //2.Upload the image 
    //check image is selected or not
    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];
    }

    //check whether the image selected
   if($image_name!="") {
       //get extension name;
       $tmp = explode('.', $image_name);
       $ext = end($tmp);
       
       //rename the image name
       $image_name = 'Category_Name_'.rand(000,999).'.'.$ext;
       
       //get source path
       $src_path = $_FILES['image']['tmp_name'];
       $dest_path = "../images/category/".$image_name; 

       //upload image to category directory/folder
       $upload = move_uploaded_file($src_path,$dest_path);

       if($upload ==false) {
           //Failed to upload images
            //session message
            $_SESSION['message'] = "Failed to upload category image.";
            $_SESSION['msg_type'] ="danger";
            //Redirect to manage-category.php page
            header("location: ".SITEURL."manage-category.php");
            // stop the process
            die();
       } 

   }else {
       $image_name="";
   }
    //3.Save to the databse table 

    //Create a sql query
    $sql = "INSERT INTO categories SET 
    title='$title',
    image_name='$image_name',
    active='$active'
    ";

  
    //Database connection
    $conn = dbConnect();

    //execute the query 
    $result = mysqli_query($conn,$sql);

    //check whether the query executed successfully or not
    //3.Set session message and redirect to manage-category.php php
    if($result==TRUE) {
        //Query executed successfully
        $_SESSION['message'] = "Category Added Successfully";
        $_SESSION['msg_type'] = "success";
        header("location: ".SITEURL."admin/manage-category.php");
    } else {

        //Failed to add category to the database
        $_SESSION['message'] = "Failed to add category";
        $_SESSION['msg_type'] = "danger";
        header("location: ".SITEURL."admin/manage-category.php");
    }

    

}


//Delete Category
//check button clicked or not
if(isset($_GET['delete'])) {
    //Get the id

    $id = $_GET['delete'];
    $image_name = $_GET['image_name'];

   //Remove the image from directory images/category

//    check image_name empty or not 

   if($image_name!="") {
       //Delete images from folder
       $remove_path = "../images/category/".$image_name;
       $removed = unlink($remove_path);
       if($removed==false) {
           //Failed to remove image
           $_SESSION['message'] = 'Failed to delete image';
           $_SESSION['msg_type']= 'danger';
           header("location: ".SITEURL."admin/manage-category.php");
           //stop the proces
           die();
       }
   }

    //Delete category from database also
       //create a sql query to delete the data from database

       $sql = "DELETE FROM categories WHERE id=$id";

       //database connection
       $conn = dbConnect();

       //execute the query

       $result = mysqli_query($conn,$sql);

       //check whether the query executed successfully or not

       if($result ==TRUE) {
           //Successfully delete category
           $_SESSION['message'] ="Category Deleted Successfully";
           $_SESSION['msg_type'] ="success";
           header("location: ".SITEURL."admin/manage-category.php");

       } else {
           //Failed to delete category from database
           $_SESSION['message'] ="Failed to delete category";
           $_SESSION['msg_type'] ="danger";
           header("location: ".SITEURL."admin/manage-category.php");
           
       }
    
}

//Udit Category
if(isset($_GET['edit'])) {

}





?>