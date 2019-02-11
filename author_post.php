<?php include 'includes/db.php' ?>
<?php include 'includes/header.php'; ?>

    <!-- Navigation -->

<?php include 'includes/navigation.php'; ?>


    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">
         
          <?php 

            if (isset($_GET['p_id']) && isset($_GET['author'])) {
                 $the_post_id = $_GET['p_id']; 
                 $the_author = $_GET['author'];


               $query  = "SELECT * FROM posts WHERE post_user = '{$the_author}'"; 
               $author_posts_query = mysqli_query($connection, $query); 

                  // while ($row = mysqli_fetch_assoc($author_posts_query)) {
                      //  $post_id = $row['post_id']; 
                      //  $cat_id = $row['cat_id'];
                      //  $post_title = $row['post_title']; 
                      //  $post_author = $row['post_author'];
                      //  $post_date = $row['post_date'];
                      //  $post_image = $row['post_image'];
                      //  $post_content = $row['post_content'];
                      //  $post_tags = $row['post_tags'];
                      //  $post_comment_count = $row['post_comment_count'];
                      //  $post_status = $row['post_status'];
                      // }


               // $count = mysqli_num_rows($search_query); 

                

                 while ($row = mysqli_fetch_assoc($author_posts_query)) {
               
         ?> 

              <!-- Title -->
              <h1 class="mt-4">
                <a href="post.php?p_id=<?php echo $row['post_id']?>"> <?php echo $row['post_title']; ?></a>
              </h1>

              <!-- Author -->
              <p class="lead">
                All posts by <?php echo $row['post_user']; ?>
              </p>

              <hr>

              <!-- Date/Time -->
              <p>Posted on <?php echo $row['post_date']; ?></p>

              <hr>
              <!-- Preview Image -->
              <img src="images/<?php echo $row['post_image'] ;?>" class ="img-fluid rounded">

              <hr>

              <!-- Post Content -->
              <p><?php echo substr($row['post_content'], 0, 100); ?></p>
              <a href="post.php?p_id=<?php echo $row['post_id']?>"class="btn btn-primary">
                Read More >> 
                <span class="glyphicaon glyphicaon-chevron-right"></span>

             </a>
             <hr>


              <?php } } else { echo "no author!";}// end of posts (while()) ?>
              
            <?php 
          ?>

          
        </div>

        <!-- Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

