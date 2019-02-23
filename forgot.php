<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include 'includes/navigation.php'; ?>

<!-- for phpmaier -->
<?php // require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vendor/phpmailer/phpmailer/src/Exception.php';
// require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require 'vendor/autoload.php';
// require 'vendor/phpmailer/phpmailer/src/SMTP.php';

?>
<?php  // require 'classes/config.php';?>

<?php 
// with composer this is requiring evreything in classes folder
require 'vendor/autoload.php'; 

?>

<?php 
   use PHPMailer\PHPMailer\PHPMailer;
 // use PHPMailer\PHPMailer\Exception;

 ?>

<?php

 // $mail = new PHPMailer(); 


// echo get_class($mail);
 ?>

<?php 
        // make it more secure 
        if (  !isset($_GET['forgot'])) {
            redirect('index.php'); 
        }

 ?>

 <?php 
    if (ifItisMethod("post")) {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $length = 50; 
            $token = bin2hex(openssl_random_pseudo_bytes($length)); // give some random chars

            $errors = array('email'=>'', 'token' =>'');
            if (email_exists($email)) {
                if($stmt = mysqli_prepare($connection, "UPDATE users set token = '$token' where user_email = ?")){
                   mysqli_stmt_bind_param($stmt, "s", $email); 
                   mysqli_stmt_execute($stmt); 
                   mysqli_stmt_close($stmt);  

                   /*
                   *    Configure PHPMAailer
                   *
                   */   

                   //    $mail = new PHPMailer(); 
                   // try {
                     

                   //  $mail->isSMTP();                                      // Set mailer to use SMTP
                   //  $mail->Host = Config::SMTP_HOST;  // Specify main and backup SMTP servers
                   //  $mail->SMTPAuth = true;                               // Enable SMTP authentication
                   //  $mail->Username = Config::SMTP_USER;              // SMTP username
                   //  $mail->Password = Config::SMTP_PASSWORD;                                 // SMTP password
                   //  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                   //  $mail->Port = Config::SMTP_PORT; 

                   //  $mail->isHTML(true);
                   //  $mail->setFrom('watheq@gmail.com', 'watheq');
                   //  $mail->addAddress($email);
                   //  $mail->Subject ='this is a test email';   
                   //  $mail->Body ='Email body';

                   //  $message ="message sent"; 

                   // }catch (Exception $e) {
                   //          $message = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;
                   //  }
                 
                 // this is from the source code
     $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'confident.ye@gmail.com';                 // SMTP username
    $mail->Password = '774881466!';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);       
    // $mali->Charset('UTF-8');                           // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "<p>Please Click to reset password 
                      <a href='http://localhost/diaz/mine/cms2/reset.php?email=".$email."&  token=".$token.  "'></a>
    </p>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);

    if ($mail->send()) {
    // echo 'Message has been sent';

      $emailSend = true; 
    }
    exit; 
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
                   
                    // if ($mail->send()) {
                    //        $message = "<p class='alert alert-success'>Was sent :)</p>";
                    //    }else{
                    //     $message =  "<p class='alert alert-danger'>not sent :(</p>";
                    //    }   

                }else{
                     $errors['token'] = 'error happended' . mysqli_error($connection);
                }

                
            }else {
                $errors['email']= 'email did not exist. register a new account'; 
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
                        <h2 class="text-center">Forgot Password?</h2>
                        <p>You can reset your password here.</p>
                        <div class="panel-body">

                            <?php if (!isset($emailSend)): ?>
                              
                       


                            <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                <div class="form-group">
                                    <div class="input-group">
                                        <!-- <span class="input-group-addon"></span> -->
                                        <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>
                                <?php echo isset($errors['email'])?$errors['email']:''; ?>
                                 <?php echo isset($errors['token'])?$errors['token']:''; ?>
                                 <?php echo isset($message)?$message:''; ?>

                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>
                                <?php else: ?>
                                  <h2>please check your email</h2>

                             <?php endif; ?>

                          </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

