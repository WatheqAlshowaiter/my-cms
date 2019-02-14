<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?> <!-- includes functions --> 

<?php session_start();  ?>


<?php 
  
   checkIfUserIsLoggedInAndRedirect("/diaz/mine/cms2/admin"); 

   if (ifItisMethod('post')) {
     if (isset($_POST['username']) && isset($_POST['password'])) {
      login_user($_POST['username'], $_POST['password']); 
     }else{
      redirect('diaz/mine/cms2/login.php'); 
     }
   }



 ?>



  <body class="bg-dark">
    <div class="container">
      <div class="row">
        

      <div class="card card-register mx-auto mt-5" style="width: 500px;">
        <div class="card-header">Login</div>
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
            <input type="submit" name="register" value="Login" class="btn btn-primary btn-block">
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="registration.php">Register a new account</a>
            <a class="d-block small" href="forgot.php?forgot=<?php echo uniqid(); ?>">Forgot Password?</a>
          </div>
        </div>
      </div>
     </div> <!--row --> 
    </div>

  <?php include "includes/footer.php";?>
