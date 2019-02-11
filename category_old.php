<?php include 'includes/db.php' ?>
<?php include 'includes/header.php'; ?>

    <!-- Navigation -->

<?php include 'includes/navigation.php'; ?>
<?php include 'admin/functions.php'; ?>


    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <?php 
            if (isset($_GET['cat_id'])) {
             $post_cat_id  = $_GET['cat_id']; 

            }else {
              header("location: index.php"); 
            }
          ?>

          <?php 

             if(is_admin($_SESSION['username']))
             {
                  $stmt1 = mysqli_prepare($connection, "SELECT post_id,post_title,post_author,post_date,post_image,post_content FROM posts where cat_id = ?");
                  // $post_cat_id;

                  $stmt = $stmt1;  // to know wich statmete are executed 

             }
             else
             {
              $stmt2= mysqli_prepare($connection, "SELECT post_id,post_title,post_author,post_date,post_image,post_content FROM posts where cat_id = ? AND post_status = ?");

              // $post_cat_id, $post_status; 
              $published = 'published';
                  $stmt = $stmt2; 

             }

              // $select_all_posts = mysqli_query($connection, $query);

             if (isset($stmt1)) {

                mysqli_stmt_bind_param($stmt1,"i",$post_cat_id);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_bind_result($stmt1, $post_id, $post_title,$post_author ,$post_date, $post_image, $post_content);  
             }else {
                mysqli_stmt_bind_param($stmt2,"is",$post_cat_id,$published);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $post_id, $post_title,$post_author ,$post_date, $post_image, $post_content);
             }

              // only if the category does not have any post 
              if (mysqli_stmt_num_rows($stmt) < 1) {
                  echo "<br>";
                  echo "<p class='alert alert-danger'>there is no posts</p>";
                  echo "<a href='index.php' class ='btn btn-primary'>  << Go to Home    </a>"; 
              } 

              // if (mysqli_stmt_num_rows($stmt)>=1):
               while (mysqli_stmt_fetch($stmt)):
              
               ?>
               <?php  ?>
                  
                <?php  ?> 


                      <!-- Title -->
                      <h1 class="mt-4">
                        <!-- <?php// echo $row['post_title']; ?> -->
                          <a href="post.php?p_id=<?php echo $post_id;?>"> <?php echo $post_title; ?></a>
                        </h1>

                      <!-- Author -->
                      <p class="lead">
                        by
                        <a href="#"><?php echo $post_author; ?></a>
                      </p>

                      <hr>

                      <!-- Date/Time -->
                      <p>Posted on <?php echo $post_date; ?></p>

                      <hr>
                      <!-- Preview Image -->
                      <a href="post.php?p_id=<?php echo $post_id?>">
                         <img src="images/<?php echo $post_image;?>" class ="img-fluid rounded">
                      </a>
                     
             <!--          <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> -->

                      <hr>

                      <!-- Post Content -->
                      <p><?php echo substr($post_content, 0, 100); ?></p>
                      <a href="post.php?p_id=<?php echo $post_id?>"class="btn btn-primary">
                        Read More >> 
                        <span class="glyphicaon glyphicaon-chevron-right"></span>

                      </a>


                      <hr>


          <?php endwhile; 
          mysqli_stmt_close($stmt); 
                 // end of posts ?>

        </div>

        <!-- Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

