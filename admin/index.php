<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>EPS TOPIK NEPAL -LOGIN</title>
    <style>
        body {
            background-color:#f1f3e6;
        }
    </style>
  </head>
  <body>
  <div class="container">
    <div class="row">
        <div class="col-2">

        </div>

        <div class="col-8 my-5">

        <div class="card">
            <div class="card-header bg-dark text-center text-white">
              EPS TOPIK NEPAL-LOGIN

            </div>
            <div class="card-body">
                <?php include("process-user.php");?>
            
        <?php 

            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }



        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        

                <form action="process-user.php" method="POST">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" name="username" class="form-control">

                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="login" value="Login" class="btn btn-primary btn-lg btn-block">
                    </div>

                    <div class="form-group text-center bg-dark text-white">

                    <p>2021 All right reserved EPS TOPIK NEPAL Created By: <a href="#">Sarun Ale</a></p>
                       
                    </div>
                    

                </form>
            </div>
        </div>
            
            </div>


            <div class="col-2">
            
            </div>
    </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>