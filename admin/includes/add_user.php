
<?php 
	if (isset($_POST['create_user'])) {
    
		$user_name = escape($_POST['user_name']); 
		$user_firstname = escape($_POST['user_firstname']); 
		$user_lastname = escape($_POST['user_lastname']); 

		// speciaal case for image 
		// $post_image = $_FILES['post_image']['name']; 
		// $post_image_temp = $_FILES['post_image']['tmp_name']; // it should be 'tmp_name'

    $user_email = escape($_POST['user_email']); 
		$user_password = escape($_POST['user_password']); 

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=>10));
		// $post_date = date("d-mm-year"); 
		$user_role = escape($_POST['user_role']); 

    // copy the image to a cairo_font_options_get_subpixel_order(options)r you want 
		// move_uploaded_file($post_image_temp, "../images/$post_image"); 

    // just for checking 
    // Inserting to DB 
    $query  = "INSERT INTO users(user_name, user_firstname, user_lastname, user_email, user_password, user_role) "; 
    $query .= "VALUES ('{$user_name}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_password}', '{$user_role}' )"; 

    $create_post_query = mysqli_query($connection, $query);

    confirm_query($create_post_query, 'Created User','users.php','View users'); 
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
          <input class="form-control" type="text"  name="user_name" >
    </div>
      <!-- user first name  -->
    <div class= "form-group">
          <label for="user_firstname">User First Name</label>
          <input class="form-control" type="text" id= "user_firstname" name="user_firstname" >
    </div>
    
    <!-- user last name  -->
    <div class= "form-group">
          <label for="user_lastname">User Last Name</label>
          <input class="form-control" type="text" id= "user_lastname" name="user_lastname" >
    </div>
    <!-- user email  -->
    <div class= "form-group">
          <label for="user_email">Email</label>
          <input class="form-control" type="email" id= "user_email" name="user_email" >
    </div>
     <!-- user email  -->
    <div class= "form-group">
          <label for="user_password">Password</label>
          <input class="form-control" type="password" id= "user_password" name="user_password" >
    </div>
    <!-- this way of making the entering values options  -->
    <!-- User role  -->
    <div class= "form-group">
          <label >User Role</label>
          <select name="user_role">
            <option value="subscriber">Select Option</option>
            <option value="admin">     Admin        </option>
            <option value="subscriber">Subscriber   </option>
      </select>
    </div>
      <!-- Post Image  -->
    <!-- there is something to edit -->
<!--     <div class= "form-group">
          <label for="user_image">User Image </label>
          <input type="file" name="user_image" id="user_image">
    </div> -->
  
    <div class= "form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

</form>