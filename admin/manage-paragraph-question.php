<?php include('partials/header.php');?>

<div class="row my-2">
    <div class="col-5">
        <div class="card">
        <?php include('process-paragraph-question.php');?>
            <div class="bg-dark card-header text-center text-white">Add/Update Paragraph Question</div>
            <div class="card-body">
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['msg_type']?>"><?php echo $_SESSION['message'];?></div>
                <?php 
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);
                
                ?>
                <?php endif; ?>

                <form action="process-paragraph-question.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
               

                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" class="form-control" value="<?php echo $question;?>">
                    </div>

                    <div class="form-group">
                        <label for="paragraph">Paragraph</label>
                        <textarea class="form-control" name="paragraph" cols="15" rows="10"><?php echo $paragraph;?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="option1">Option1</label>
                        <input type="text" name="option1" class="form-control" value="<?php echo $option1;?>">
                    </div>

                    

                    <div class="form-group">
                        <label for="option2">Option2</label>
                        <input type="text" name="option2" class="form-control" value="<?php echo $option2;?>">
                    </div>

                    <div class="form-group">
                        <label for="option3">Option3</label>
                        <input type="text" name="option3" class="form-control" value="<?php echo $option3;?>">
                    </div>

                    <div class="form-group">
                        <label for="option4">Option4</label>
                        <input type="text" name="option4" class="form-control" value="<?php echo $option4;?>">
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <input type="text" name="answer" class="form-control" value="<?php echo $answer;?>">
                    </div>

                    <div class="form-group">
                        <?php if(isset($_GET['edit'])):?>
                       <input type="submit" name="update" value="Update Paragraph Question" class=" btn-block btn btn-success">
                       <?php else:?>
                       <input type="submit" name="add" value="Add Paragraph Question" class=" btn-block btn btn-success">
                   <?php endif;?>
                     </div>
                </form>

            </div>
        </div>
    </div>


    <div class="col-7">
        <div class="card">
            <div class="bg-dark card-header text-center text-white">List Paragraph Questions</div>
            <div class="card-body">
            <a href="manage-paragraph-question.php" class="card-link btn btn-info my-1"><i class="fa fa-question" aria-hidden="true"></i> Add Paragraph Question</a>

            <table class="table table-hover" id="example">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <!-- <th>Question</th> -->
                        <!-- <th>Paragraph</th> -->
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
                    
                   
                   //Create sql query to get data from database

                   $sql = "SELECT * FROM paragraph_question";

                   //create database connection

                   $conn = dbConnect();


                   //execute query


                   $result = mysqli_query($conn,$sql);

                   //check query executed or not
                   if($result ==TRUE) {
                        if(mysqli_num_rows($result)>0){
                            $sn = 1;
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['id'];
                                $question = $row['question'];
                                $option1 = $row['option1'];
                                $option2 = $row['option2'];
                                $option3 = $row['option3'];
                                $option4 = $row['option4'];
                                $answer = $row['answer'];

                                ?>

                    <tr>
                        <td><?php echo $sn++;?></td>
                        <!-- <td><?php //echo $question; ?></td> -->
                        <!-- <td></td> -->
                        <td><?php echo $option1; ?></td>
                        <td><?php echo $option2;  ?></td>
                        <td><?php echo $option3;  ?></td>
                        <td><?php echo $option4;  ?></td>
                        <td><?php echo $answer;  ?></td>
                        <td>

                        <a  
                        href="manage-paragraph-question.php?edit=<?php echo $row['id'];?>" 
                        class="btn btn-info action-link"
                        data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Edit Paragraph Question"
                        >
                        <i class="fa fa-question" aria-hidden="true"></i></a>
                        <a  

                        href="process-paragraph-question.php?delete=<?php echo $row['id'];?>" 
                        class="btn btn-danger action-link"
                        data-toggle="tooltip" 
                        data-placement="bottom" 
                        title="Delete Paragraph Question"
                        > <i class="fa fa-question" aria-hidden="true"></i></a>



                        </td>
                    </tr>

                                <?php

                            }

                        } else {
                            echo "No Data yet Added.";
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