<?php 
	if (isset($_POST['create_post'])) {
    
		$post_title = escape($_POST['post_title']); 
		$cat_id = escape($_POST['post_category']); 
		$post_user = escape($_POST['post_user']); 
		
		// speciaal case for image 
		$post_image = escape($_FILES['post_image']['name']); 
		$post_image_temp = escape($_FILES['post_image']['tmp_name']); // it should be 'tmp_name'

    $post_content = escape($_POST['post_content']); 
		$post_date = date("d-mm-year"); 
		$post_tags = escape($_POST['post_tags']); 
		$post_status = escape($_POST['post_status']); 

    // copy the image to a folder you want 
		move_uploaded_file($post_image_temp, "../images/$post_image"); 

    // Inserting to DB 
    $query  = "INSERT INTO posts(cat_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) "; 
    $query .= "VALUES ({$cat_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )"; 

    $create_post_query = mysqli_query($connection, $query);

    confirm_query($create_post_query); 

    $the_post_id = mysqli_insert_id($connection); // give us the last id creared in DB 
    
     echo "<p class='alert alert-success'>Post Created Successfuly! <a href='../post.php?p_id=$the_post_id'>watch this post</a></p>";
     echo "<p class='alert alert-info'>or <a href='posts.php'>watch all posts</a></p>";
	}

 ?>
<form action="" method="post" enctype="multipart/form-data"> <!--enctype for uploading images  --> 
    
    <!-- Post Title  -->
    <div class= "form-group">
          <label for="post_title">Post Title</label>
          <input class="form-control" type="text" name="post_title" id="post_title">
    </div>
    <!-- Category Id  -->
    <div class= "form-group">
      <label for="post_category">Post category</label>
     <!--      <label for="cat_id">Category Id</label>
          <input class="form-control" type="text" name="cat_id" id="cat_id"> -->
          <select name="post_category">
        <?php 
              $query = "SELECT * FROM categories"; 
              $select_all_catgs = mysqli_query($connection, $query);
              confirm_query($select_all_catgs);

              while ($row = mysqli_fetch_assoc($select_all_catgs)) {
                $cat_id = escape($row['cat_id']); 
                $cat_title = escape($row['cat_title']); 

                echo "<option value ='$cat_id'>{$cat_title}</option>";
              }

           ?>
      </select>
    </div>
    <!-- Post User  -->
    <div class= "form-group">
          <label for="post_user">Post User</label>
          <select name="post_user">
        <?php 
              $query = "SELECT * FROM users"; 
              $select_users = mysqli_query($connection, $query);
              confirm_query($select_users);

              while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = escape($row['user_id']); 
                $user_name = escape($row['user_name']); 

                echo "<option value ='$user_name'>{$user_name}</option>";
              }

           ?>
      </select>
    </div>    

<!--     <div class= "form-group">
          <label for="post_author">Post Author</label>
          <input class="form-control" type="text" name="post_author" id="post_author">
    </div> -->
    <!-- Post Image  -->
    <!-- there is something to edit -->
    <div class= "form-group">
          <label for="post_image">Post Image </label>
          <input type="file" name="post_image" id="post_image">
    </div>
    <!-- Post Content  -->
    <!-- there is something to edit -->
    <div class= "form-group">
          <label for="post_content">Post Content</label>
          <textarea class="form-control" type="text" name="post_content" id="post_content" cols="30" rows="10"> </textarea>
    </div>
    <!-- Post Tags  -->
    <div class= "form-group">
          <label for="post_content">Post Tags</label>
          <input class="form-control" type="text" name="post_tags" id="post_tags">
    </div>

    <!-- Post Status  -->
    <div class="form-group">
      <label for="post_status">Post Status</label>
      <select name="post_status">
        <option value="draft" selected> Draft</option>
        <option value="published"> Published</option>
      </select>
    </div>


    <div class= "form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
    </div>

</form>