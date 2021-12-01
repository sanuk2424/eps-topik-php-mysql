<?php include('partials/header.php');?>
<div class="row my-1">
<!--Add/Update Course start here -->
<div class="col-5">
    <div class="card">
        <?php include('process-course.php');?>
        <div class="card-header text-center text-white bg-dark">Add/Update Course</div>
        <div class="card-body">
            <!-- Course form start here -->
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['msg_type']?>"><?php echo $_SESSION['message'];?></div>
                <?php 
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);
                
                ?>
                <?php endif; ?>
            <form action="process-course.php" method="post">
            <input type="hidden" value=<?php echo $id;?> name="id"/>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category" >
                    <?php
                  //create a sql query 
                  $sql = "SELECT * FROM categories";

                  // database connection

                  $conn = dbConnect();
                  //execute query 
                  $result = mysqli_query($conn,$sql);

                  //check query exexuted successfully or not
                  if($result ==TRUE) {
                    $count = mysqli_num_rows($result);
                    if($count>0) { 
                        while($row=mysqli_fetch_assoc($result)){
                            $id = $row['id'];
                            $title = $row['title'];

                            ?>

                            <option <?php if($id==$category){ echo 'selected';}?> value="<?php echo $id; ?>"><?php echo $title;?></option>


                            <?php
                        }

                    } else {
                        echo "<option value='0'>No Category Data</option>";
                    }

                  }
                     
                  ?>
              
                   </select>
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $course_title;?>">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" name="body" cols="30" rows="10" class="form-control"><?php echo $body; ?></textarea>
                </div>

                <div class="form-group">
                   <label for="Active">Active</label>
               <div class="form-check">
                        <input type="radio" name="active" <?php if($active=='Yes') {echo "checked";}?> value="Yes" class="form-check-input">
                        <label  class="form-check-label" for="exampleRadios1">
                           Yes
                        </label>
                        </div>


                        <div class="form-check">
                        <input <?php if($active=='No') {echo "checked";}?>  type="radio" name="active" value="No" class="form-check-input">
                        <label class="form-check-label">
                           No
                        </label>
                        </div>

                        <div class="form-group">
                           
                        <?php if(isset($_GET['edit'])):?>
                        <input class="btn btn-success btn-block" type="submit" name="update" value="Update Course">
                        <?php else: ?>
                        <input class="btn btn-success btn-block" type="submit" name="add" value="Add Course">
                        <?php endif;?>            
                            
                        </div>

               </div>


            </form>

            <!-- Course form ends here -->

        </div>
    </div>
</div>
<!--Add/Update Course ends here -->

<!-- Course List start here -->
<div class="col-7">
    <div class="card">
        <div class="card-header text-center text-white bg-dark">Course Lists</div>
        <div class="card-body">
        <a href="manage-course.php" class="card-link btn btn-info my-1"><i class="fas fa-box"></i> Add Course</a>
            <table class="table table-hover" id="example">
                <thead class="thead-light">
                    <tr>
                        <td>ID</td>
                        <td>CatID</td>
                        <td>Title</td>
                        <td>Body</td>
                        <td>active</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    //create a sql query to get all the data from database
                    $sql2 = "SELECT * FROM course";
                    //database connection
                    $conn2 = dbConnect();

                    //execute the query

                    $result2 = mysqli_query($conn2,$sql2);

                    //check whether the query executed or not

                    if($result2==TRUE) {
                        //Count records in database

                        $count2 = mysqli_num_rows($result2);

                        if($count2>0){
                            while($row2 = mysqli_fetch_assoc($result2)) {
                                $id = $row2['id'];
                                $category_id = $row2['category_id'];
                                $title = $row2['title'];
                                $body = $row2['body'];
                                $active = $row2['active'];

                                ?>
                                <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $category_id; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo substr($body,0,30); ?> <span class="more">More..</span></td>
                        <td><?php echo $active; ?></td>
                        <td>

                       
                                            
                        <a  
                        href="manage-course.php?edit=<?php echo $row2['id'];?>" 
                        class="btn btn-info action-link"
                        data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Edit Course"
                        >
                        <i class="fas fa-box"></i></a>
                        <a  

                        href="process-course.php?delete=<?php echo $row2['id'];?>" 
                        class="btn btn-danger action-link"
                        data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Delete Course"
                        > <i class="fas fa-box"></i></a>



                        </td>

                    </tr>


                        <?php

                            }
                        } else {
                            //No course Yet added
                            echo "<div class='bg-danger'>No Course Yet Added.</div>";
                        }
                    }
                    
                    ?>
                    
                </tbody>
            </table>
            
        </div>
    </div>
</div>
<!-- Course Lists ends here -->
</div>






<?php include('partials/footer.php');?>