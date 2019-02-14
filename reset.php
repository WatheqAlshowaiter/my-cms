<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include 'includes/navigation.php'; ?>


<?php 

// if (!isset($_GET['email']) && !isset($_GET['token'])) {
// 	redirect('index');
// }
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
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Update Password" type="submit">
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