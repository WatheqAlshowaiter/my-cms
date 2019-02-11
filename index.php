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
              // for Pagination 

              $per_page = 3; // Nunmber of posts per page 

              if (isset($_GET['page'])) {
                $page = $_GET['page']; 
              }else {
                $page= ""; 
              }

              if ($page == "" || $page == 1) {
                $page_1 = 0; 
              }else {
                // this is if you want 5 items in each page. you can modify it 
                $page_1 = ($page * $per_page) - $per_page; 
              }

             if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
             {
                 $post_query_count = "SELECT * from posts "; 

                 $query = "SELECT * FROM posts order by post_id desc limit $page_1, $per_page" ; 
             }
             else
             {
                $post_query_count = "SELECT * from posts where post_status = 'published' "; 

                 $query = "SELECT * FROM posts where post_status ='published' order by post_id desc limit $page_1, $per_page" ; 
             }

              // $post_query_count = "SELECT * from posts where post_status = 'published' "; 
              $find_count = mysqli_query($connection, $post_query_count); 
              $count = mysqli_num_rows($find_count);

              $count = ceil($count / $per_page); // to make it always int  


             // $query = "SELECT * FROM posts where post_status ='published' order by post_id desc limit $page_1, $per_page" ; // 5 items from the page 
              $select_all_posts = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_assoc($select_all_posts)) {
                $post_status = $row['post_status']; 
                 
               ?> 

          <!-- Title -->
          <h1 class="mt-4">
            <!-- <?php echo $row['post_title']; ?> -->
              <a href="post/<?php echo $row['post_id']?>"> <?php echo $row['post_title']; ?></a>
            </h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="author_post.php?author=<?php echo $row['post_user']; ?>&p_id=<?php echo $row['post_id']?>"><?php echo $row['post_user']; ?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $row['post_date']; ?></p>

          <hr>
          <!-- Preview Image -->
          <a href="post.php?p_id=<?php echo $row['post_id']?>">
             <img src="images/<?php echo $row['post_image'] ;?>" class ="img-fluid rounded">
          </a>
         
 <!--          <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> -->

          <hr>

          <!-- Post Content -->
          <p><?php echo substr($row['post_content'], 0, 100); ?></p>
          <a href="post.php?p_id=<?php echo $row['post_id']?>"class="btn btn-primary">
            Read More >> 
            <span class="glyphicaon glyphicaon-chevron-right"></span>

          </a>
          <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicin</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

          <blockquote class="blockquote">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">Someone famous in
              <cite title="Source Title">Source Title</cite>
            </footer>
          </blockquote>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p> -->

          <hr>

          <!-- Comments Form -->
          <!-- <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <textarea class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div> -->

          <!-- Single Comment -->
        <!--   <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
          </div> -->

          <!-- Comment with nested comments -->
         <!--  <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0">Commenter Name</h5>
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Commenter Name</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

              <div class="media mt-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                  <h5 class="mt-0">Commenter Name</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </div>

            </div>
          </div> -->


          <?php 

          }  // end of while loop of posts  

              // if there no posts at all!
             // if ($post_status !== 'published') {
             //  echo "<br>";
             //  echo "<h2 class='text-center alert alert-danger'>There is no posts </h2>";
             //  }


          ?>


          <!--  -->
          <!-- the pagination  -->
          <ul class="pagination">          
          <?php 
              for ($i=1; $i <= $count ; $i++) { 
                if ($i == $page) {
                  echo "<li class='page-item active'><a  class='page-link' href='index.php?page=$i'>$i</a></li>";
                }else {
                  echo "<li class='page-item'><a  class='page-link' href='index.php?page=$i'>$i</a></li>";
                }
                
              }

           ?>
          </ul>
        </div>

        <!-- Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

