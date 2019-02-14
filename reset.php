<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include 'includes/navigation.php'; ?>


<?php 

if (!isset($_GET['email']) && !isset($_GET['token'])) {
	redirect('index');
}

// $email = "sub@gmail.com"; 
// $token = 'fc02986218d2ac1aa4c2df346fb6a1f9700a3f5a9ff1f54ea833ef37fc4ab5cbf96b54f49bd9bd021b69f719fd4e6e64c7ad'; 

if ($stmt = mysqli_prepare($connection, "SELECT user_name, user_email, token  from users where token =?")) {
	mysqli_stmt_bind_param($stmt, "s", $_GET['token']);
	mysqli_stmt_execute($stmt); 
	mysqli_stmt_bind_result($stmt, $username, $user_email, $token); 
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt); 

	// if ($_GET['token']!==$token|| $_GET['email']!==$email) {
	// 	redirect('index'); 
	// }


	if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
		if ($_POST['password'] === $_POST['confirmPassword']) {
			$password = $_POST['password'];
			$hashedPassword= password_hash($password, PASSWORD_BCRYPT, array('cost'=>10));

            if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='{$hashedPassword}' WHERE user_email = ?")){


                mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) >= 1){

                  redirect('/diaz/mine/cms2/login.php');


                }

                mysqli_stmt_close($stmt);
            }

                // Unsecure way 
			// $query = "UPDATE users SET token=null WHERE user_email= '$user_email'";
			// $set_token_query = mysqli_query($connection, $query); 

			// if ($set_token_query) {
			// 	echo "It was affected"; // you can use login_user()
			// 	redirect('/diaz/mine/cms2/login.php');
			// }
			// mysqli_close($set_token_query);


			// if ($stmt = mysqli_prepare($connection, "UPDATE users set token ='', user_password='$hashedPassword' where user_email = ?")) {
			//  	mysqli_stmt_bind_param($stmt, "s", $email); 
			//  	if (mysqli_stmt_affected_rows($stmt)) {
			//  		echo "It was affected"; 
			//  	}else {
			//  		echo "bad query"; 
			//  	}
			//  } 
		}
	}

}
 ?>
<!-- Page Content -->
<body class="bg-dark">
<div class="container">

		


    <!-- <div class="form-gap"></div> -->
    <div class="container">
        <div class="row">
              <div class="card card-register mx-auto mt-5" style="width: 500px;">
        <!-- <div class="card-header">Forget password</div> -->
        <div class="card-body">

           <!--  <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
 -->

                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">Update password</h2>
                        <div class="panel-body">
                              
                       


                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                      <input class="form-control" type="password" name="password" placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                      <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="resetPassword" class="btn btn-lg btn-primary btn-block" value="Update Password" type="submit">
                                </div>
                            </form>


                          </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php include "includes/footer.php";?>