<?php include('partials/header.php');?>

<div class="row my-2">
    <div class="col-5">
        <div class="card">
            <div class="card-header bg-dark text-white text-center">Add/Update Filling Question</div>
            <div class="card-body">
                <?php include('process-filling-question.php');?>
                <?php if(isset($_SESSION['message'])):?>
                    <div class="alert alert-<?php echo $_SESSION['msg_type']?>"><?php echo $_SESSION['message'];?></div>
                    <?php
                     unset($_SESSION['message']);   
                     unset($_SESSION['msg_type']);
                    ?>

                <?php endif; ?>
                <form action="process-filling-question.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">

                <div class="form-group">
                    <label for="question">Question</label>
                    <textarea name="question"  cols="15" rows="10" class="form-control"><?php echo $question;?></textarea>
                </div>

                <div class="form-group">
                    <label for="option1">Option1</label>
                    <input type="text" name="option1" class="form-control" value="<?php echo $option1; ?>">

                </div>


                <div class="form-group">
                    <label for="option2">Option2</label>
                    <input type="text" name="option2" class="form-control" value="<?php echo $option2; ?>">

                </div>


                <div class="form-group">
                    <label for="option3">Option3</label>
                    <input type="text" name="option3" class="form-control" value="<?php echo $option3; ?>">

                </div>


                <div class="form-group">
                    <label for="option4">Option4</label>
                    <input type="text" name="option4" class="form-control" value="<?php echo $option4; ?>">

                </div>


                <div class="form-group">
                    <label for="answer">Answer</label>
                    <input type="text" name="answer" class="form-control" value="<?php echo $answer; ?>">

                </div>

                <div class="form-group">
                    <?php if(isset($_GET['edit'])):?>
                    <input type="submit" name="update" value="Update Filling Question" class="btn btn-success btn-block">
                    <?php else: ?>
                    <input type="submit" name="add" value="Add Filling Question" class="btn btn-success btn-block">
                <?php endif;?>
                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-7">
        <div class="card">
            <div class="card-header bg-dark text-white text-center">List Filling Questions</div>
            <div class="card-body">
            <a href="manage-filling-question.php" class="card-link btn btn-info my-1"><i class="fa fa-question" aria-hidden="true"></i> Add Filling Question</a>

            <table class="table table-hover" id="example">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <!-- <th>Question</th> -->
                        <th>Option1</th>
                        <th>Option2</th>
                        <th>Option3</th>
                        <th>Option4</th>
                        <th>Answer</th>
                        <th>Actions</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //create sql query to get all data from database
                        
                        $sql  = "SELECT * FROM filling_question";

                        //create database connection

                        $conn = dbConnect();

                        //execute query

                        $result = mysqli_query($conn,$sql);

                        //check whether query executed or not

                        if($result==TRUE) {
                            if(mysqli_num_rows($result)>0) {
                                while($row = mysqli_fetch_assoc($result)){
                                    $id=$row['id'];
                                    $question = $row['question'];
                                    $option1 = $row['option1'];
                                    $option2 = $row['option2'];
                                    $option3 = $row['option3'];
                                    $option4 = $row['option4'];
                                    $answer = $row['answer'];


                                    ?>
                                    <tr>
                                        <td><?php echo $id;?></td>
                                        <!-- <td><?php //echo $question;?></td> -->
                                        <td><?php echo $option1;?></td>
                                        <td><?php echo $option2;?></td>
                                        <td><?php echo $option3;?></td>
                                        <td><?php echo $option4; ?></td>
                                        <td><?php echo $answer; ?></td>
                                        <td><a  
                        href="manage-filling-question.php?edit=<?php echo $row['id'];?>" 
                        class="btn btn-info action-link"
                        data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Edit Filling Question"
                        >
                        <i class="fa fa-question" aria-hidden="true"></i></a>
                        <a  

                        href="process-filling-question.php?delete=<?php echo $row['id'];?>" 
                        class="btn btn-danger action-link"
                        data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Delete Filling Question"
                        > <i class="fa fa-question" aria-hidden="true"></i></a></td>
                                 </tr>


                                    <?php

                                }
                            } else {
                                echo "Filling Question Not Yet Added.";
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