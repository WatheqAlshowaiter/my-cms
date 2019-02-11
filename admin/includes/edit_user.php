<?php 
    
    if (isset($_GET['u_id'])) {
      
      $the_user_id = $_GET['u_id']; 

       $query = "SELECT * FROM users where user_id = $the_user_id"; 
                 $select_user_to_edit_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_user_to_edit_query)) {
                  $user_id = $row['user_id']; 
                  $user_name = $row['user_name'];
                  $user_firstname = $row['user_firstname']; 
                  $user_lastname = $row['user_lastname'];
                  $user_email = $row['user_email'];
                  $user_password = $row['user_password'];
                  $user_image = $row['user_image'];
                  $user_role = $row['user_role'];
                }




  if (isset($_POST['edit_user'])) {
    
    $user_name = $_POST['user_name']; 
    $user_firstname = $_POST['user_firstname']; 
    $user_lastname = $_POST['user_lastname']; 
    
    // speciaal case for image 
    // $post_image = $_FILES['post_image']['name']; 
    // $post_image_temp = $_FILES['post_image']['tmp_name']; // it should be 'tmp_name'

    $user_email = $_POST['user_email']; 
    $user_password = $_POST['user_password']; 
    // $post_date = date("d-mm-year"); 
    $user_role = $_POST['user_role']; 

    // copy the image to a cairo_font_options_get_subpixel_order(options)r you want 
    // move_uploaded_file($post_image_temp, "../images/$post_image"); 

    // for encryting password OLD WAY 

       // $query ="SELECT user_rand_salt from users"; 
       // $select_rand_salt_query = mysqli_query($connection, $query); 

       // if (!$select_rand_salt_query) {
       //    die('query failed ' . mysqli_error($connection)); 
       // }
       // $row  = mysqli_fetch_array($select_rand_salt_query);
       // $salt = $row['user_rand_salt']; 

       // $hashed_password = crypt($password, $salt); 

      // NEW WAY FOR ENCRPTING PASSWORD 

    if (!empty($user_password)) {
        $query_password ="SELECT user_password from users where user_id = $the_user_id"; 
        $get_user_query = mysqli_query($connection, $query_password); 
        confirm_query($get_user_query); 

        $row = mysqli_fetch_array($get_user_query);
        $db_user_password = $row["user_password"]; 

            if ($db_user_password != $user_password) {
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10));
                }
    // just for checking 
    // Inserting to DB 
            $query  = "UPDATE users SET "; 
            $query .= "user_name = '$user_name', ";
            $query .= "user_firstname = '$user_firstname', ";
            $query .= "user_lastname = '$user_lastname', ";
            $query .= "user_email = '$user_email',  ";
            $query .= "user_password = '$hashed_password', ";
            $query .= "user_role = '$user_role' ";
            $query .= "WHERE user_id = $the_user_id ";


            $update_user_query = mysqli_query($connection, $query);

            confirm_query($update_user_query);  
    }



  }
      }else {
        header("Location: index.php"); 
      }

 ?>
<form action="" method="post" enctype="multipart/form-data"> <!--enctype for uploading images  --> 
    
    <!-- user id -->
  <!--   <div class= "form-group">
          <label for="user_id">User ID</label>
          <input class="form-control" type="text"  name="user_id" >
    </div> -->
      <!-- user name  -->
    <div class= "form-group">
          <label for="user_name">User Name</label>
          <input class="form-control" value="<?php echo $user_name; ?>" type="text"  name="user_name" >
    </div>
      <!-- user first name  -->
    <div class= "form-group">
          <label for="user_firstname">User First Name</label>
          <input class="form-control" value="<?php echo $user_firstname; ?>" type="text" id= "user_firstname" name="user_firstname" >
    </div>
    
    <!-- user last name  -->
    <div class= "form-group">
          <label for="user_lastname">User Last Name</label>
          <input class="form-control" value="<?php echo $user_lastname; ?>"type="text" id= "user_lastname" name="user_lastname" >
    </div>
    <!-- user email  -->
    <div class= "form-group">
          <label for="user_email">Email</label>
          <input class="form-control" value="<?php echo $user_email; ?>" type="email" id= "user_email" name="user_email" >
    </div>
     <!-- user email  -->
    <div class= "form-group">
          <label for="user_password">Password</label>
          <input class="form-control" type="password"  value="<?php echo $user_password ?>"id= "user_password" name="user_password" >
    </div>
    <!-- this way of making the entering values options  -->
    <!-- User role  -->
    <div class= "form-group">
          <label >User Role</label>
          <select name="user_role">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 
              if ($user_role == 'subscriber') {
                  echo "<option value'admin'> Admin </option>";
                }else {
                  echo "<option value'subscriber'> Subscriber </option>";
                }

             ?>

<!--             <option value="admin">     Admin        </option>
            <option value="subscriber">Subscriber   </option> -->
      </select>
    </div>
      <!-- Post Image  -->
    <!-- there is something to edit -->
<!--     <div class= "form-group">
          <label for="user_image">User Image </label>
          <input type="file" name="user_image" id="user_image">
    </div> -->
  
    <div class= "form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>

</form>