<!-- 
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Register</title>

     Bootstrap core CSS
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   -->
    <!-- Custom fonts for this template-->

    <!--  
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
-->
    <!-- Custom styles for this template-->
    <!-- <link href="css/sb-admin.css" rel="stylesheet"> 

  </head>

-->

<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
<?php // include 'admin/functions.php'; ?>

<!-- for pusher notification -->
<?php require 'vendor/autoload.php';  ?>
<?php 

  $dotenv = Dotenv\Dotenv::create(__DIR__);
  $dotenv->load();

 ?>

<?php 
// should be an array 
//  $options = array(
//     'cluster' => 'ap2',
//     'useTLS' => true
//   );
//   $pusher = new Pusher\Pusher(
//     getenv('KEY'),
//     getenv('SECRET'),
//     getenv('APP_ID'),
//     $options
//   );


 ?>


<?php 
  
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = trim($_POST['username']);
        $email    = trim($_POST['email']);
        $password = trim($_POST['password']);

      // we are using old way beacause new are not excepted. 
        $error = array('username' => '',
          'email' => '', 
          'password' =>''
        );

        // usernames errors 
        if (strlen($username) < 3) {
          $error['username'] = 'username should be more than 3 characters';
        }

        if ($username == '') {
          $error['username'] ='username should not be empty'; 
        }

        if (user_exists($username)) {
           $error['username'] ='username already exists, pick another one'; 
        }

        // email erors 
        if ($email == '') {
          $error['email'] ='email should not be empty'; 
        }

        if (email_exists($email)) {
           $error['email'] = "email already exists, <a href='includes/login.php'>login</a>"; 
        }

        //password errors  
        if ($password == '') {
          $error['password'] = "password can not be empty"; 
        }

        foreach ($error as $key => $value) {
          if (empty($value)) {
              unset($error[$key]); 
          }
        }
        if (empty($error)) {
              register_user($username, $email, $password); 
              // for pusher notification
                $data['message'] = $username ;
                // $pusher->trigger('notifications', 'new_user', $data);
              login_user($username, $password);

        }

     
  } 

     

 ?>

  <body class="bg-dark">
    <div class="container">
      <div class="row">
        

      <div class="card card-register mx-auto mt-5" style="width: 500px;">
        <div class="card-header">Register an Account</div>
        <div class="card-body">

          <form action="" method="post">
            <h6 class="text-center"><?php echo $message; ?></h6>
             <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputUsername" class="form-control" placeholder="User Name" name="username" autocomplete="on" value="<?php echo isset($username)? $username: ''?>">
                <p><?php echo isset($error['username'])?$error['username']:''; ?></p>

              </div>
            </div>

            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="required" name="email" autocomplete="on" value="<?php echo isset($email)?$email:''; ?>">
                <p><?php echo isset($error['email'])?$error['email']:''; ?></p>
                <!-- <label for="inputEmail">Email address</label> -->
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                    <!-- <label for="inputPassword">Password</label> -->
                    <p><?php echo isset($error['password'])?$error['password']:''; ?></p>
                  </div>
                </div>

              </div>
            </div>
            <!-- <a class="btn btn-primary btn-block" href="login.html">Register</a> -->
            <input type="submit" name="register" value="Register" class="btn btn-primary btn-block">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="login.php">Login Page</a>
            <!-- <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
          </div>
        </div>
      </div>
     </div> <!--row --> 
    </div>

  <?php include "includes/footer.php";?>
