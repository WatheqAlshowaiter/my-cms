
<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>


<?php 

// IMPORTANT 
// this can work only in online severs that enables MAIL server 
  
    if (isset($_POST['submit'])) {
     
     $to        = "confident.ye@gmail.com"; // my email 
     $subject   = $_POST['email'];
     $body      = wordwrap($_POST['body'], 70);    
     $header    = "From: ". $_POST['email']; 

     mail($to, $subject, $body, $header); 

    }
 ?>

  <body class="bg-dark">
    <div class="container">
      <div class="row">
        

     </div> <!--row --> 
     <br>
     <div class="row">
     <div class="card mx-auto" style="width: 45rem;">
        <div class="card-body">
          <h5 class="card-title text-center">Contact</h5>
          <form action="" method="post">
            <h6 class="text-center"><?php echo $message; ?></h6>
             <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputUsername" class="form-control" placeholder="User Name*" name="username">
              </div>
            </div>

            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address*" required="required" name="email">
                <!-- <label for="inputEmail">Email address</label> -->
              </div>
            </div>
            <div class="form-group">
              <textarea class='form-control' type="text-area" name="body" id="body" cols='30' rows='10' placeholder="Enter your message*"></textarea>
            </div>
            <!-- <a class="btn btn-primary btn-block" href="login.html">Register</a> -->
            <input type="submit" name="submit" value="Send Message" class="btn btn-primary btn-block">
          </form>
<!--          <a href="#" class="btn btn-primary">Go somewhere</a> -->
      </div>
        </div>
      </div>
    </div>

  <?php include "includes/footer.php";?>
