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

   //check image_name empty or not 

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

//Edit Category
if(isset($_GET['edit'])) {
    //Get the selected 
    $id = $_GET['edit'];

    //database connection

    $conn = dbConnectPreparedStatement();
    
    //create a sql query display
    $sql = "SELECT * FROM categories WHERE id=?";

    //create a prepared statement
    $query = $conn->prepare($sql);
    
    //Bind data 
    $query->bind_param('i',$id);

    //execute the query
    $query->execute();

    //get result 
    $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    // die();
   //check count

   if(count($result)>0) {
       $title = $result[0]['title'];
       $image_name = $result[0]['image_name'];
       $active = $result[0]['active'];
   }

}


//Update category 
if(isset($_POST['update'])) {
          
    //Get all the values from our form
    $id = $_POST['id'];

    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    
    $active = $_POST['active'];

    //2.Updating new image if selected

    // check whether the image is selected or not
    if(isset($_FILES['image']['name'])){
        //Get the image details
        $image_name = $_FILES['image']['name'];

        //whether image is available or not
        if($image_name!="") {
            //Image available
            //1.upload the new image

            // Auto rename our image
            // get the extension of our images(png,jpg,gif) ex. food.jpg
            $tmp = explode('.',$image_name);
            $ext = end($tmp);

            // rename the image 
            $image_name = 'Category_Name_'.rand(000,999).'.'.$ext;

            //Source path image 
            $source_path = $_FILES['image']['tmp_name'];
            //Destionation path image
            $destionation_path = "../images/category/".$image_name;

            // FInally upload the image
            $uploaded = move_uploaded_file($source_path,$destionation_path);

            //check whether the image uploaded or not
            //And if the image is not uploaded then we will stop the prcoces and redirect with error message
            if($uploaded==false) {
                //set the message
                $_SESSION['message'] = "Failed to upload image";
                $_SESSION['msg_type'] = "danger";
                //redirect to manage-category.php page
                header("location: ".SITEURL."admin/manage-category.php");
                // stop the process
                die();

            }


            //2.Remove the current image if avaialable
            if($current_image!="") {
                $remove_path = "../images/category/".$current_image;
                $removed = unlink($remove_path);
                // checked whether the image removed or not
                //if failed to removed display message and stop the process
                if($removed==false) {
                    $_SESSION['message'] = "Failed to remove current image";
                    $_SESSION['msg_type'] = "danger";
                    //redirect to manage-category.php 
                    header("location:".SITEURL."admin/manage-category.php");
                    // stop the procees
                    die();
                }

            } 

          
        } else {
            $image_name = $current_image;
        }

    } else {
        $image_name = $current_image;
    }

    //3 Update the database

    $sql2 = "UPDATE categories SET
        title='$title',
        image_name='$image_name',
        active='$active'
        WHERE id=$id
    ";

    //database connection
    $conn = dbConnect();

    //execute the query
    $res2  =mysqli_query($conn,$sql2);


    //4. Redirect to manage-category with message

    //Check whether query executed or not
    if($res2 ==TRUE) {
        //Category updated 
        $_SESSION['message'] = "Category Updated successfully";
        $_SESSION['msg_type'] = "success";

        header("location: ".SITEURL."admin/manage-category.php");
    } else {
        //Failed to update category
        $_SESSION['message'] = "Failed to update category";
        $_SESSION['msg_type'] = "danger";
        header("location: ".SITEURL."admin/manage-category.php");
    }


}




?>