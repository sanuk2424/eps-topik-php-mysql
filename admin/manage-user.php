<?php include('partials/header.php');?>
<?php include('process-user.php');?>
            <?php if(isset($_SESSION['message'])):?>
           <div class="my-1 alert alert-<?php echo $_SESSION['msg_type'];?>">
           <?php 
           echo $_SESSION['message'];
           unset($_SESSION['message']);
           unset($_SESSION['msg_type']);
           ?>
           </div>
        <?php endif; ?>

<div class="row my-1">
    <div class="col-3">
        
        <!-- Add/Update User start here -->
        <?php if(!isset($_GET['change_password'])){
            ?>
        

        <div class="card my-2">
            <div class="card-header text-center text-white bg-dark">Add/Update User</div>
            <div class="card-body">
            
                <form action="process-user.php" method="POST">

                 

               
                    <input type="hidden" name="id" value="<?php echo $id;?>">

                   


                    <div class="form-group">
                        <label for="InputFirstname">Firstname:</label>
                        <input 
                        type="text" 
                        name="first_name" 
                        class="form-control" 
                        id="InputFirstname" 
                        placeholder="Enter Firstname"
                        value="<?php echo $first_name;?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="InputLastname">Lastname:</label>
                        <input 
                        type="text" 
                        name="last_name" 
                        class="form-control" 
                        id="InputLastname" 
                        placeholder="Enter Lastname"
                        value="<?php echo $last_name;?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="InputUsername">Username:</label>
                        <input 
                        type="text" 
                        name="username" 
                        class="form-control" 
                        id="InputUsername" 
                        placeholder="Enter Username"
                        value="<?php echo $username;?>"
                        >
                    </div>

                    <div class="form-group">
                        <label for="InputEmail">Email address:</label>
                        <input 
                        type="email" 
                        name="email" 
                        class="form-control" 
                        id="InputEmail" 
                        aria-describedby="emailHelp"
                        placeholder="Enter email"
                        value="<?php echo $email;?>"
                        >
                    
                    </div>
                    <?php if($password==""):?>
                    <div class="form-group">
                        <label for="InputPassword">Password:</label>
                        <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Enter Password">
                    </div>
                    <?php endif; ?>
                   <?php if($update==true):?>
                    <button 
                    type="submit" 
                    name='update' 
                    class="btn btn-primary"
                    >Update User</button>
                    <?php else:?>
                    <button 
                    type="submit" 
                    name='submit' 
                    class="btn btn-primary"
                    >Add User</button>
                <?php endif; ?>
                    
                </form>
            </div>



        </div>
        <?php } ?>
       

         <!-- Add/Update User end here -->

        <!-- Change Password start here -->
        <?php if(isset($_GET['change_password'])): ?>
        <div class="card my-2">
            <div class="card-header text-center bg-dark text-white">Change Password</div>
            <div class="card-body">
                <form action="process-user.php" method="POST">
                    <div class="form-group">
                        <label for="currentPassword">Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="newPassword">New Password</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="id" value="<?php echo $_GET['change_password'];?>">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input 
                        type="submit" 
                        class="btn btn-success" 
                        name='passwordChange' 
                        value="Change Password">
                    </div>

                </form>
            </div>
        </div>
        <?php endif; ?>    
        
        <!-- Change Password end here -->

    </div>
    <div class="col-9">
        <div class="card my-2">
            <div class="card-header text-center text-white bg-dark">User Lists</div>
            <div class="card-body">
            <a href="manage-user.php" class="card-link btn btn-info my-1"><i class="fas fa-user-plus"></i> Add User</a>
                <table id="example" class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th>ID</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        
                        <!-- <th>CREATED_DATE</th> -->
                        <th>ACTIONS</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        try{
                            //database connection
                            $conn = dbConnect();

                            // create a sql query to get all data from database
                            $sql = "SELECT * FROM users";
                            //execute the query 
                            $result = mysqli_query($conn,$sql);

                            //check query exexuted or not
                            if($result==TRUE) {
                                //Count the result
                                $count = mysqli_num_rows($result);

                                //check the count is grater than 0 than data found 
                                if($count>0) {
                                    //display data
                                    $sn = 1;
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id = $row['id'];
                                        $first_name = $row['first_name'];
                                        $last_name = $row['last_name'];
                                        $username = $row['username'];
                                        $email = $row['email'];
                                        $created_date = $row['created_date'];
                                        ?>

                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $first_name;?></td>
                                            <td><?php echo $last_name; ?></td>
                                            <td><?php echo $username;?></td>
                                            <td><?php echo $email;?></td>
                                            <!-- <td><?php //echo $created_date;?></td> -->
                                            <td colspan="2">
                                           

                                            <a  
                                                href="manage-user.php?change_password=<?php echo $row['id'];?>" 
                                                class="btn btn-success action-link"
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="Change Password"
                                                >
                                                <i class="fas fa-unlock"></i></a>

                                            
                                                <a  
                                                href="manage-user.php?edit=<?php echo $row['id'];?>" 
                                                class="btn btn-info action-link"
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="Edit User"
                                                >
                                                <i class="fas fa-user-edit"></i></a>
                                                <a  
                                                
                                                href="process-user.php?delete=<?php echo $row['id'];?>" 
                                                class="btn btn-danger action-link"
                                                data-toggle="tooltip" 
                                                data-placement="bottom" 
                                                title="Delete User"
                                                ><i class="fas fa-user-times"></i></i></a>

                                            </td>
                                        </tr>


                                        <?php 

                                    }
                                    
                                    
                                } else{
                                    //NO record found
                                    echo "<div class='bg-danger'>User not Yet Added.</div>";
                                }


                            } else {
                                //Query Error
                            }

                        }finally {
                            mysqli_close($conn);
                        }
                        
                        ?>
                        
                    </tbody>


                </table>
            </div>
        </div>

    </div>
</div>



<?php include('partials/footer.php');?>