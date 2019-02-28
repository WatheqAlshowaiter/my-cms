<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>

    <!-- Navigation -->
    <?php include("includes/navigation.php"); ?>

    <?php// include 'admin/functions.php'; ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <br>

            <?php 

                if(isset($_GET['cat_id']))
                {
                    $the_get_category_id = $_GET['cat_id'];

                    if(is_admin($_SESSION['username']))
                    {
                        $query = "SELECT * FROM posts WHERE cat_id = $the_get_category_id";
                    }
                   else
                   {
                        $query = "SELECT * FROM posts WHERE cat_id = $the_get_category_id AND post_status = 'published'";
                   }
                
            
                
                $result = mysqli_query($connection, $query);

                if(mysqli_num_rows($result) < 1)
                {
                    echo "<p class='alert alert-danger'>there is no posts</p>";
                }
                else
                {

                

                while($row = mysqli_fetch_array($result))
                {
                    $post_id            = $row['post_id'];
                    $post_category_id   = $row['post_category_id'];
                    $post_title         = $row['post_title'];
                    $post_author        = $row['post_user'];
                    $post_date          = $row['post_date'];
                    $post_image         = $row['post_image'];
                    $post_content       = $row['post_content'];
                    $post_tags          = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status        = $row['post_status'];
            ?>

                <h1 class="page-header">
                    <!-- Page Heading -->
                    <!-- <small>Secondary Text</small> -->
                </h1>

                <!-- First Blog Post -->
                <h1>
                    <a href="<?=BASE_URL?>/post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title; ?></a>
                </h1>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <hr>
                <p>Posted on <?php echo $row['post_date']; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $row['post_id']?>"> 
              <img src="../images/<?php echo imagePlaceholder($post_image);?>" class ="img-fluid rounded"> 
          </a>
                <hr>
                <p><?php echo substr($row['post_content'], 0, 100); ?></p>
                <a class="btn btn-primary" href="#">Read More >> <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php
                 } // end   while($row = mysqli_fetch_array($result))

                  } //else if(mysqli_num_rows($result) < 1)


              } // end if isset($_GET['category']))
              else
                {
                    header("Location: index.php");
                }
            ?>

                

                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php"); ?>

        </div>
        <!-- /.row -->
</div>
        <hr>

<?php include("includes/footer.php"); ?>