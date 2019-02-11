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
            if (isset($_POST['submit']) && !empty($_POST['search'])) {
               $search = $_POST['search']; 
               $query  = "SELECT * FROM posts WHERE post_tags LIKE '%{$search}%'"; // I should make it only for published posts 
               $search_query = mysqli_query($connection, $query); 

               if(!$search_query) {
                  die("QUERY FAILED " . mysqli_error($connection));
               }

               $count = mysqli_num_rows($search_query); 

               if($count == 0){
                echo "<br> <p class='alert alert-danger'>Sorry, No Result  :(</p>"; 
               } else {
                echo "<br> <p class='alert alert-info'>Search Result: </p>";
                 while ($row = mysqli_fetch_assoc($search_query)) {
               
         ?> 

              <!-- Title -->
              <h1 class="mt-4"><?php echo $row['post_title']; ?></h1>

              <!-- Author -->
              <p class="lead">
                by
                <a href="#"><?php echo $row['post_author']; ?></a>
              </p>

              <hr>

              <!-- Date/Time -->
              <p>Posted on <?php echo $row['post_date']; ?></p>

              <hr>
              <!-- Preview Image -->
              <img src="images/<?php echo $row['post_image'] ;?>" class ="img-fluid rounded">

              <hr>

              <!-- Post Content -->
              <p><?php echo $row['post_content']; ?></p>
              <a href="post.php?p_id=<?php echo $row['post_id'];?>"class="btn btn-primary">
                Read More >> 
                <span class="glyphicaon glyphicaon-chevron-right"></span>

             </a>
             <hr>


              <?php }  // end of posts (while()) ?>
              
            <?php 

                }  // end of else $count == 0
                }  else {
                  header("location: index.php"); die; 
                }  // end of else if isset($_POST['submit'])  
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

