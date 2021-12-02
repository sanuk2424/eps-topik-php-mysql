<?php include_once('partials/config.php'); ?>
<?php include('login-check.php');?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--    For table pagination-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   
<link rel="stylesheet" href="../css/admin.css">
    <title>EPS-TOPIK NEPAL - Admin</title>
  </head>
  <body>
   <div class="container-fluid">
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">EPS TOPIK NEPAL 2021</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse header-link" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto">

    <li class="nav-item active">
        <a class="nav-link btn btn-success mx-1" href="manage-dashboard.php">Manage Dashboard <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link btn btn-success mx-1" href="manage-user.php">Manage User <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item active">
        <a class="nav-link btn btn-success mx-1" href="manage-category.php">Manage Category <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link btn btn-success mx-1" href="manage-course.php">Manage Course <span class="sr-only">(current)</span></a>
      </li>


      <li class="nav-item dropdown bg-success">
          <a class="nav-link dropdown-toggle btn btn-success" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage Question
          </a>
          <ul class="dropdown-menu bg-success my-2" aria-labelledby="navbarDropdown">

         
            <li class="btn btn-success"><a class="dropdown-item" href="manage-paragraph-question.php">Manage Paragraph Question</a></li>
           
            <li><hr class="dropdown-divider"></li>
            <li class="btn btn-success"><a class="dropdown-item " href="manage-filling-question.php">Manage Filling Question</a></li>
            <li><hr class="dropdown-divider"></li>
            <li class="btn btn-success"><a class="dropdown-item " href="#">Manage Image Question</a></li>
          </ul>
        </li>

     

      <li class="nav-item active">
        <a class="nav-link btn btn-success mx-1" href="manage-course.php">Manage Pages <span class="sr-only">(current)</span></a>
      </li>

      
    
    </ul> 
   
      <div class="form-inline my-2 my-lg-0">
      <a href="#" class="btn btn-secondary mx-1"><i title="<?php echo $_SESSION['user'] ?>" class="fas fa-user"></i></a>
        
      <a title="Logout" class="btn btn-info ms-2 my-sm-0" href="logout-user.php"><i class="fad fa-sign-out"></i></a>
      </div>
     
   
   

  </div>
</nav>


