<?php 

  if (isset($_GET['p_id'])) {
    $post_id_to_edit = escape($_GET['p_id']); 
    $query = "SELECT * FROM posts WHERE post_id = $post_id_to_edit limit 1"; 
    $select_post_by_id = mysqli_query($connection, $query);

   while ($row = mysqli_fetch_assoc($select_post_by_id)) {
     $post_id = escape($row['post_id']); 
     $cat_id = escape($row['cat_id']);
     $post_title = escape($row['post_title']); 
     $post_user = escape($row['post_user']);
     $post_date = escape($row['post_date']);
     $post_image = escape($row['post_image']);
     $post_content = $row['post_content'];
     $post_tags = escape($row['post_tags']);
     $post_comment_count = escape($row['post_comment_count']);
     $post_status = escape($row['post_status']);
    }

  }

// After hitting Edit button (to insert)
  if (isset($_POST['update_post'])) {
    // like from adding new post
    // $post_id = $_POST[]
    $post_title = escape($_POST['post_title']); 
    $cat_id = escape($_POST['post_category']); 
    // $post_catgs = $_POST['post_category']; 
    $post_user = escape($_POST['post_user']);
    
    // speciaal case for image 
    $post_image = escape($_FILES['post_image']['name']); 
    $post_image_temp = escape($_FILES['post_image']['tmp_name']); // it should be 'tmp_name'

    $post_content = escape($_POST['post_content']); 
    $post_date = escape(date("d-mm-year")); 
    $post_tags = escape($_POST['post_tags']); 
    $post_status = escape($_POST['post_status']); 

    move_uploaded_file($post_image_temp, "../images/$post_image"); 

    if (empty($post_image)) {
      $query = "SELECT * FROM posts WHERE post_id = $post_id_to_edit"; 
      $select_image =   mysqli_query($connection, $query); 

      while ($row = mysqli_fetch_array($select_image)) {
        $post_image = escape($row['post_image']); 
      }
    }


    $query  = "UPDATE posts SET "; 
    $query .= "post_title = '$post_title', ";
    $query .= "cat_id = '$cat_id', ";
    $query .= "post_date = now(), ";
    $query .= "post_user = '$post_user',  ";
    $query .= "post_content = '$post_content', ";
    $query .= "post_tags = '$post_tags', ";
    $query .= "post_status = '$post_status',  ";
    $query .= "post_image = '$post_image' ";
    $query .= "WHERE post_id = $post_id ";


    $update_query = mysqli_query($connection, $query);

    confirm_query($update_query);
    echo "<p class='alert alert-success'>Post Updated Successfuly! <a href='../post.php?p_id=$post_id'>watch this post</a></p>";
    echo "<p class='alert alert-info'>or <a href='posts.php'>watch all posts</a></p>";


  }

 ?>
<form action="" method="post" enctype="multipart/form-data"> <!--enctype for uploading images  --> 
    
    <!-- Post Title  -->
    <div class= "form-group">
          <label for="post_title">Post Title</label>
          <input class="form-control" value = "<?php echo $post_title; ?>" type="text" name="post_title" id="post_title">
    </div>
    <!-- Category Id  -->
    <div class= "form-group">
      <select name="post_category">
        <?php 
              $query = "SELECT * FROM categories"; 
              $select_all_catgs = mysqli_query($connection, $query);
              confirm_query($select_all_catgs);

              while ($row = mysqli_fetch_assoc($select_all_catgs)) {
                $cat_id = escape($row['cat_id']); 
                $cat_title = escape($row['cat_title']); 
                echo "<option value =\"$cat_id\">{$cat_title}</option>";
              }

           ?>
      </select>
          
    </div>
    <!-- Post Author  -->
 <!--    <div class= "form-group">
          <label for="post_user">Post Author</label>
          <input class="form-control" value = "<?php // echo $post_user; ?>" type="text" name="post_user" id="post_user">
    </div> -->
        <!-- Post User  -->
    <div class= "form-group">
          <label for="post_user">Post User</label>
          <select name="post_user">
            <?php echo "<option value ='$post_user'>{$post_user}</option>"; ?>
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
    <!-- Post Image  -->
    <!-- there is something to edit -->
    <div class= "form-group">
          <label for="post_image">Post Image</label> <br>
          <img width = '200' src="../images/<?php echo $post_image;?>">
          <input type="file" name="post_image" id="post_image">
    </div>
    <!-- Post Content  -->
    <div class= "form-group">
          <label for="post_content">Post Content</label>
          <textarea class="form-control" type="text" name="post_content" id="post_content" cols="30" rows="10"><?php echo str_replace('\r\n', '<br/>', $post_content); ?>
          
          </textarea>
    </div>
    <!-- Post Tags  -->
    <div class= "form-group">
          <label for="post_content">Post Tags</label>
          <input class="form-control" value = "<?php echo $post_tags; ?>"type="text" name="post_tags" id="post_tags">
    </div>
     <!-- Post Status -->

         <div class= "form-group">
          <label for="post_content">Post Status</label>
         
          <select name="post_status"> 
            <option value="<?php echo $post_status ?>"><?php echo $post_status; ?></option>
            <?php 

              if ($post_status == 'published') {
                echo "<option value='draft'>Draft</option>";
                
              }else if ($post_status='draft') {
                  echo "<option value='published'>Published</option>";
              }else{
                echo "<option value='draft'>Draft</option>";
              }

             ?>

          </select>

          <!-- <input class="form-control" type="text" name="post_status" id="post_status"> -->
    </div>
<!--     <div class= "form-group">
          <label for="post_content">Post Status</label>
          <input class="form-control" value = "<?php echo $post_status; ?>" type="text" name="post_status" id="post_status">
    </div> -->
    <div class= "form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
    </div>

</form>