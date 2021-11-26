<?php include('partials/header.php');?>
<?php include('process-category.php'); ?>
<div class="row my-2">
    <div class="col-3">
       <div class="card">
           <div class="card-header text-center bg-dark text-white">Add/Update Category</div>
           <div class="card-body">
               <!-- Session message start here -->
               <?php if(isset($_SESSION['message'])):?>
                <div class="alert alert-<?php echo $_SESSION['msg_type'];?>"><?php echo $_SESSION['message'];?></div>
                <?php 
                    unset($_SESSION['message']);
                    unset($_SESSION['msg_type']);
                
                ?>
                <?php endif;?>

               <!-- Session message end here -->

               <!-- Category form starts here -->
               <form action="process-category.php" method="POST" enctype="multipart/form-data">

               <div class="form-group">
                   <label for="Title">Title</label>
                   <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
               </div>

               <?php if($image_name!=""):?>
               <div class="form-group">
               <label for="Image">Current Image:</label>
               <img 
               src="../images/category/<?php echo $image_name;?>" 
               width="150px" 
               alt="<?php echo $image_name;?>">

               </div>
              
                <?php endif; ?>
               <div class="form-group">
                   <label for="Image">Select Image:</label>
                   <input type="file" name="image" class="form-control-file">
               </div>
               <div class="form-group">
                   <label for="Active">Active</label>
               <div class="form-check">
                        <input <?php if($active=='Yes'){echo 'checked';}?> type="radio" name="active" value="Yes" class="form-check-input">
                        <label  class="form-check-label" for="exampleRadios1">
                           Yes
                        </label>
                        </div>


                        <div class="form-check">
                        <input <?php if($active=='No'){echo 'checked';}?> type="radio" name="active" value="No" class="form-check-input">
                        <label class="form-check-label">
                           No
                        </label>
                        </div>

               </div>
               <?php if($image_name!=""):?>
               <input type="hidden" name="id" value="<?php echo $_GET['edit'];?>">
                   <input type="hidden" name="current_image" value="<?php echo $image_name;?>">
                <?php endif;?>
               <div class="form-group">
                   <?php if(!isset($_GET['edit'])):?>
                  
                   <input type="submit" name="add" value="Add Category" class="btn btn-success">
                   <?php else: ?>

                   <input type="submit" name="update" value="Update Category" class="btn btn-primary">
                   <?php endif;?>
               </div>

               
               </form>

               <!-- Category form ends here -->


           </div>
       </div>
    </div>

    <div class="col-9">
    <div class="card">
           <div class="card-header text-center bg-dark text-white">Category Lists</div>
           <div class="card-body">
           <a href="manage-category.php" class="card-link btn btn-info my-1"><i class="fas fa-object-group"></i> Add Category</a>
                <table id="example" class="table table-hover">
                    <thead class="thead-light">
                       <tr>
                       <th>ID</th>
                       <th>TITLE</th>
                       <th>Image</th>
                       <th>Active</th>
                       <th>Actions</th>
                       </tr>

                   </thead>
                   <tbody>
                       <?php 
                       //Create a query to display category data 
                       $sql = "SELECT * FROM categories";

                       //database connection 
                       $conn = dbConnect();

                       //execute a query

                       $result = mysqli_query($conn,$sql);

                       //check whether the queru exexuted or not
                       if($result == TRUE) {
                           //Get how data
                           $count = mysqli_num_rows($result);
                           if($count>0) {
                               $sn = 1;
                               while($row=mysqli_fetch_assoc($result)) {
                                   $id = $row['id'];
                                   $title = $row['title'];
                                   $image_name = $row['image_name'];
                                   $active = $row['active'];
                                   ?>
                                   <tr>
                           <td><?php echo $sn++; ?></td>
                           <td><?php echo $title?></td>
                           <td>
                               <?php 
                               if($image_name!=""): ?>
                               <img src="../images/category/<?php echo $image_name;?>" alt="<?php echo $image_name;?>" width="100px">
                               <?php else:?>
                                <?php echo "<div class='bg-danger'>Image Not Found</div>";?>
                               <?php endif;?>
                            </td>
                           <td><?php echo $active?></td>
                           <td colspan="2">

                           <a  
                                                href="manage-category.php?edit=<?php echo $row['id'];?>" 
                                                class="btn btn-info action-link"
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="Edit Category"
                                                >
                                                <i class="fas fa-edit"></i></a>
                                                <a  
                                                
                                                href="process-category.php?delete=<?php echo $row['id'];?>&image_name=<?php echo $image_name; ?>" 
                                                class="btn btn-danger action-link"
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="Delete Category"
                                                ><i class="fas fa-trash-alt"></i></a>
                           </td>

                       </tr>



                                   <?php
                               }
                           } else {
                               //No data here
                               echo "<div class='bg-danger'>Category Not Yet Added.</div>";
                           }

                       } 
                       ?>
                       

                   </tbody>
               </table>
               
           </div>
       </div>
      
    </div>
</div>






<?php include('partials/footer.php');?>