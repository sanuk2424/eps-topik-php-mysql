<?php include('partials/header.php');?>
<?php include('process-user.php');?>
<?php if(isset($_SESSION['message'])):?>
  <div class="row">
           <div class="my-1 alert alert-<?php echo $_SESSION['msg_type'];?>">
           <?php 
           echo $_SESSION['message'];
           unset($_SESSION['message']);
           unset($_SESSION['msg_type']);
           ?>
           </div>
        <?php endif; ?>
        </div>

<div class="row my-2">
    <div class="col-4">
        <div class="card  box-4">
        <button type="button" class="btn btn-dark">
    Manage User <span class="badge badge-light">10</span>
  <span class="sr-only">new User</span>
</button>
        </div>
       
    </div>
    <div class="col-4">
    <div class="card  box-4">

    <button type="button" class="btn btn-dark">
    Manage Category <span class="badge badge-light">9</span>
  <span class="sr-only">new Category</span>
</button>
   
    
        </div>
       
    </div>
    <div class="col-4">
    <div class="card  box-4">
    <button type="button" class="btn btn-dark">
    Manage Course <span class="badge badge-light">9</span>
  <span class="sr-only">new Course</span>
</button>
    
        </div>
       
    </div>
</div>



<?php include('partials/footer.php');?>