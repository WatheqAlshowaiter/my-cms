<?php include 'delete_modal.php';  ?>
     <?php 
        if($_POST['checkboxArray']){

            foreach ($_POST['checkboxArray'] as $postValueId) {
              $bulk_options  = $_POST['bulk_options'];

              switch ($bulk_options) {
                case 'published':
                  $query = "UPDATE posts SET post_status = 'published' WHERE post_id = $postValueId"; 
                  $update_to_published_status = mysqli_query($connection, $query); 
                  confirm_query($update_to_published_status); 
                  echo "<p class='alert alert-success'>Change posts state to published done Successfully! </p>";
                  break;
                case 'draft': 
                  $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = $postValueId"; 
                  $update_to_draft_status = mysqli_query($connection, $query); 
                  confirm_query($update_to_draft_status); 
                  echo "<p class='alert alert-info'>Change posts state to draft done Successfully! </p>";
                  break;            
                case 'delete': 
                  $query = "DELETE FROM posts WHERE post_id = $postValueId"; 
                  $delete_bulk = mysqli_query($connection, $query); 
                  confirm_query($delete_bulk); 
                  echo "<p class='alert alert-danger'>Delete posts done Successfully! </p>";
                  break;

                  case 'clone':
                    $query = "SELECT * FROM posts where post_id = $postValueId";
                    $select_post_querry = mysqli_query($connection, $query); 

                    while ($row = mysqli_fetch_array($select_post_querry)) {
                      $post_title = $row['post_title']; 
                      $cat_id = $row['cat_id']; 
                      $post_author = $row['post_author']; 
                      $post_content = $row['post_content']; 
                      $post_date = $row['post_date']; 
                      $post_tags = $row['post_tags']; 
                      $post_status = $row['post_status'];   
                      $post_image = $row['post_image'];

                    }

                    $query  = "INSERT INTO posts(cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) "; 
                    $query .= "VALUES ({$cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";

                    $copy_query = mysqli_query($connection, $query); 
                    if (!$copy_query) {
                                die('Query failed ' . mysqli_error($connection));
                               }           

                        break; 

                default:
                  
                  break;
              }
            }

        }

      ?>   


          <?php 
             // just for checking deletion 
             if (isset($_GET['deleted'])) {
                echo "<p class='alert alert-danger'>deletion done Successfully!</p>";
              } 


           ?>
          <form action="" method="post">
            <div class="row">
                <div id="bulkOptionContainer" class="col-sm-4">
              <select class="form-control" name="bulk_options" id="">
                <option value=""> Select Options</option>
                <option value="published"> Publish</option>
                <option value="draft"> Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>

            </select>
            </div>
            <div class="col-sm-4">
              <input type="submit" name="submit" class="btn btn-success" value="Apply" >
              <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
            </div>

            </div> <!-- end row--> 
            <br>
              <table class="table table-bordered table-hover">
               <thead>
                 <tr>
                  <th><input type="checkbox" name="" id="selectAllBoxes"></th>
                   <th>Id</th>
                   <th>Category</th>
                   <th>Title</th>
                   <th>User</th>
                   <th>Date</th>
                   <th>Image</th>
                   <th>Content</th>
                   <th>Tags</th>
                   <th>Comment Count</th>
                   <th>Status</th>
                   <th>View Posts</th>
                   <th>Edit</th>
                   <th>Delete</th>
                   <th>Views</th>
               
               </thead>
               <tbody>
                  <?php 
                    // $user = $_SESSION['username']; // display posts by only usr logged in 1/2 
                 // $query = "SELECT * FROM posts order by post_id desc"; 
 $query  = "SELECT posts.post_id, posts.cat_id, posts.post_title, posts.post_author, posts.post_user, posts.post_date, ";
 $query .="posts.post_image, posts.post_content, posts.post_tags, posts.post_comment_count, posts.post_status, ";   
 $query .= "posts.post_views_count, "; 
 $query .=" categories.cat_id, categories.cat_title "; 
 $query .="FROM posts LEFT JOIN categories on posts.cat_id = categories.cat_id "; 
 $query .="ORDER BY posts.post_id desc"; 
 // $query .="where posts.post_user = '$user' ORDER BY posts.post_id desc"; // // display posts by only usr logged in 2/2 

                 $select_all_posts = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts)) {
                  $post_id = $row['post_id']; 
                  $cat_id = $row['cat_id'];
                  $post_title = $row['post_title']; 
                  $post_author = $row['post_author'];
                  $post_user = $row['post_user'];
                  $post_date = $row['post_date'];
                  $post_image = $row['post_image'];
                  $post_content = $row['post_content'];
                  $post_tags = $row['post_tags'];
                  $post_comment_count = $row['post_comment_count'];
                  $post_status = $row['post_status'];
                  $post_views_count = $row['post_views_count'];
                  $cat_title_by_id = $row["cat_title"]; 
                  // $cat_id = $row["cat_title"]; 

                  // to display Category by id 
                  // $query = "SELECT * FROM categories WHERE cat_id = $cat_id"; 
                  // $category_query = mysqli_query($connection, $query); 

                   // while($row = mysqli_fetch_assoc($category_query)){

                    // $cat_title_by_id = $row["cat_title"]; 
                  // }

                  echo "<tr>";
                  ?>
                  <!--  for bulking stuff -->
                  <td><input type="checkbox" name="checkboxArray[]" value="<?php echo $post_id; ?>" class="checkBox"></td>
                  <?php
                  echo "<td>{$post_id}</td>";
                  echo "<td>$cat_title_by_id</td>";
                  echo "<td>{$post_title}</td>";

                  // echo either post user or post author 
                  if (!empty($post_author)) {
                     echo "<td>{$post_author}</td>";
                  }elseif(!empty($post_user)){
                     echo "<td>{$post_user}</td>";

                  }
                  

                  echo "<td>{$post_date}</td>";
                  echo "<td> <img width='100' src='../images/$post_image' alt='$post_image'></td>";
                  echo "<td>{$post_content}</td>";
                  echo "<td>{$post_tags}</td>";

                  $query = "SELECT * from comments where comment_post_id = $post_id";
                  $send_comment_query = mysqli_query($connection, $query); 

                  // to grap the comment id for make the get request 
                  $row = mysqli_fetch_array($send_comment_query); 
                  $comment_id = $row["comment_id"]; 

                  $comment_count = mysqli_num_rows($send_comment_query); 
                  echo "<td><a href='post_comments.php?id=$post_id'>{$comment_count}</a></td>";
                  

                  echo "<td>{$post_status}</td>";
                  echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View post</a></td>";
                  echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                  // echo "<td><a href='delete_post.php?delete=$post_id'onclick=\"return confirm('Are you sure?');\" >Delete</a></td>";

                  ?>
                  <form method="post">
                    <input type="hidden" name="post_id"value="<?php echo $post_id; ?>">

                    
                  <?php 
                     echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'onclick=\"return confirm('Are you sure?');\"></td>";
                 // echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                 ?>
                 </form>      
                  <?php 

                  echo "<td><a class='btn btn-secondary' href='reset_post.php?p_id=$post_id'>{$post_views_count}</a></td>";
                    
                  
                  echo "</tr>";
                }
               ?>
               </tbody>
              </table>
            </form>

                  <?php 
  
  if (isset($_POST['delete'])) {
   $post_to_delete = $_POST['post_id'];

   $query = "DELETE FROM posts WHERE post_id = $post_to_delete"; 
   echo $query;

   $delete_query = mysqli_query($connection, $query); 

   if (!$delete_query) {
    echo "Qeury Failed: " . mysqli_error($connection); 
   }else {
       header("Location: posts.php?deleted=true"); 
   }


  }


 ?>
            <!-- script should be in this page becaues it is dynamic data -->
            <script>

              $(document).ready(function(){
                  $(".delete_link").on('click', function(){
                      var id = $(this).attr("rel");
                      var delete_url = "posts.php?delete="+id+"";
                      
                      $(".modal_delete_link").attr("href",  delete_url);
                      
                      $("#myModal").modal('show');
                  });
              });


            </script> 