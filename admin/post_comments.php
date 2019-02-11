<?php include 'includes/admin_header.php'; ?>

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php'; ?>


      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Welcome</a>
            </li>
            <li class="breadcrumb-item active">Comments post </li>
          </ol>

          <?php if (isset($_GET['id'])){ ?>
            <?php $comment_post_id = $_GET['id'];  ?>

          
              <table class="table table-bordered table-hover">
               <thead>
                 <tr>
                   <th>Id</th>
                   <th>Author</th>
                   <th>Comment</th>
                   <th>Email</th>
                   <th>Status</th>
                   <th>In Response to</th>
                   <th>Date</th>
                   <th>Approved</th>
                   <th>Unapproved</th>
                   <th>Delete</th>
                 </tr>
               </thead>
               <tbody>
                  <?php 
                 $query = "SELECT * FROM comments where comment_post_id = $comment_post_id order by comment_id desc"; 
                 $select_all_comments = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_comments)) {
                  $comment_id = $row['comment_id']; 
                  $comment_post_id = $row['comment_post_id'];
                  $comment_author = $row['comment_author']; 
                  $comment_content = $row['comment_content'];
                  $comment_email= $row['comment_email'];
                  $comment_status = $row['comment_status'];
                  $comment_date = $row['comment_date'];

                  // to display Category by id 
                  // $query = "SELECT * FROM categories WHERE cat_id = $cat_id"; 
                  // $category_query = mysqli_query($connection, $query); 

                  //  while($row = mysqli_fetch_assoc($category_query)){

                  //   $cat_title_by_id = $row["cat_title"]; 
                  // }

                  echo "<tr>";
                  echo "<td>{$comment_id}</td>";
                  // here some query to join comment with post 
                  echo "<td>$comment_author</td>";
                  echo "<td>{$comment_content}</td>";
                  echo "<td>{$comment_email}</td>";
                  echo "<td>{$comment_status}</td>";

                  $query = "SELECT * from posts  WHERE post_id = $comment_post_id "; 
                  $select_post_id_query = mysqli_query($connection, $query); 
                  while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                    $post_id = $row['post_id']; // the name from DB 
                    $post_title = $row['post_title']; 

                    echo "<td><a href='../post.php?p_id=$post_id'> $post_title </a></td>";
                  }
                  
                  
                  echo "<td>{$comment_date}</td>";
                  echo "<td><a href='post_comments.php?approved={$comment_id}&id=$comment_post_id'>Approved</a></td>";
                  echo "<td><a href='post_comments.php?unapproved={$comment_id}&id=$comment_post_id'>Unapproved</a></td>"; 
                  // echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Edit</a></td>";
                  echo "<td><a href='post_comments.php?delete=$comment_id&id=$comment_post_id' onclick=\"return confirm('Are you sure?');\" >Delete</a></td>";
                  
                  
                  echo "</tr>";
                }
               ?>
               </tbody>
              </table>

              <!-- UNAPPROVVING COMMENTS -->
                <?php 

                if (isset($_GET['unapproved'])) {
                      
                    $comment_to_unapproved= $_GET['unapproved'];

                     $query = "UPDATE comments SET comment_status = 'unapproved' where comment_id = $comment_to_unapproved"; 

                     $unapprove_comment_query = mysqli_query($connection, $query); 

                     if (!$unapprove_comment_query) {
                      echo "Qeury Failed: " . mysqli_error($connection); 
                     }else {
                         header("Location: post_comments.php?id=$comment_post_id"); 
                     }

                }

               ?>

               <!-- APPROVVING COMMENTS -->
                <?php 

                if (isset($_GET['approved'])) {
                      
                    $comment_to_approved= $_GET['approved'];

                     $query = "UPDATE comments SET comment_status = 'approved' where comment_id = $comment_to_approved"; 

                     $approve_comment_query = mysqli_query($connection, $query); 

                     if (!$approve_comment_query) {
                      echo "Qeury Failed: " . mysqli_error($connection); 
                     }else {
                         header("Location: post_comments.php?id=$comment_post_id"); 
                     }

                }

               ?>


<!-- DELETING COMMENTS   -->
              <?php 

                if (isset($_GET['delete'])) {
                      
                    $comment_to_delete = $_GET['delete'];

                     $query = "DELETE FROM comments WHERE comment_id = $comment_to_delete LIMIT 1"; 

                     $delete_query = mysqli_query($connection, $query); 

                     if (!$delete_query) {
                      echo "Qeury Failed: " . mysqli_error($connection); 
                     }else {
                         header("Location: post_comments.php?id=$comment_post_id"); 
                     }

                }



               ?>

<?php } // end if  

  else{
    header("Location: index.php"); 
  }
?>


        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include 'includes/admin_footer.php'; ?>
