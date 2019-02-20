<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>

    <!-- Navigation -->
    <?php include("includes/navigation.php"); ?>

<?php //echo "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/post.php?p_id="; ?>
    <?php 
        if (isset($_POST['liked'])) {
            // from AJAx request 
            $post_id =  $_POST['post_id'];
            $user_id = $_POST['user_id']; 
            //1. select post
            $query = "select * from posts where post_id = $post_id"; 
            $postResult = mysqli_query($connection, $query); 
            $post = mysqli_fetch_array($postResult);  
            $likes = $post['likes']; 
 
            //2. update post with likes 
            mysqli_query($connection, "UPDATE posts set likes = $likes+1 where post_id = $post_id"); 
            
            //3. create likes for post   
            mysqli_query($connection, "INSERT into likes(user_id,post_id) values ($user_id, $post_id)"); 
            exit(); 

        }

        if (isset($_POST['unliked'])) {
            
            // from AJAx request 
            $post_id =  $_POST['post_id'];
            $user_id = $_POST['user_id']; 
            // //1. select post
            $query = "select * from posts where post_id = $post_id"; 
            $postResult = mysqli_query($connection, $query); 
            $post = mysqli_fetch_array($postResult);  
            $likes = $post['likes']; 
 
            // // //2. update post with likes (decrementing)
            mysqli_query($connection, "UPDATE posts set likes=$likes-1 where post_id = $post_id"); 
            
            // // //3. create likes for post   
            mysqli_query($connection, "DELETE from likes where post_id=$post_id and user_id=$user_id"); 
            exit();

        }

     ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 

                // new thing.. 
                if(isset($_GET['p_id']))
                {
                   $the_get_post_id = $_GET['p_id'];

                   $view_query = "UPDATE posts set post_views_count = post_views_count + 1 WHERE post_id = $the_get_post_id";
                   $send_query = mysqli_query($connection, $view_query);

                   if(!$send_query)
                   {
                        die("Query failed " . mysqli_error($connection));
                   }

                   if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin')
                   {
                        $query = "SELECT * FROM posts WHERE post_id = $the_get_post_id";
                   }
                   else
                   {
                    $query = "SELECT * FROM posts WHERE post_id = $the_get_post_id AND post_status = 'published'";
                   }
                
            
                
                $result = mysqli_query($connection, $query);

                if(mysqli_num_rows($result) < 1)
                {
                    echo "<h2 class='text-center text-danger'>No posts</h2>";
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
                    <!-- Posts -->
                    
                </h1>
                <br>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="/diaz/mine/cms2/images/<?php echo $post_image; ?>" alt="">


                <p><?php echo $post_content; ?></p>
                

                <hr>

            <?php
                }
            ?>

            <!-- likes thums up  -->
            <div class="row">
                <div class="col"> 
                    <p class="float-right"><a class="like" href="#"> <span class="far fa-thumbs-up"></span> like</a></p>
                </div>
               
            </div>
            <div class="row">
                <div class="col"> 
                    <p class="float-right"><a class="unlike" href="#"> <span class="far fa-thumbs-down"></span> unlike</a></p>
                </div>
               
            </div>
              <div class="row">
                <div class="col"> 
                    <p class="float-right"> likes: 10</p>
                    <!-- <i class="far fa-thumbs-up"></i> -->
                </div>
               
            </div>

            <!-- Blog Comments -->

            <?php
            
                if(isset($_POST['create_comment']))
                {
                    $the_get_post_id = $_GET['p_id'];

                    $comment_author = mysqli_real_escape_string($connection, trim($_POST['comment_author']));
                    $comment_email  = mysqli_real_escape_string($connection, trim($_POST['comment_email']));
                    $commet_content = mysqli_real_escape_string($connection, trim($_POST['comment_content']));

                    if(!empty($comment_author) && !empty($comment_email) && !empty($commet_content))
                    {
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, 
                                comment_content, comment_status, comment_date) VALUES($the_get_post_id, 
                                '$comment_author', '$comment_email', '$commet_content', 'unapproved', now())";

                        $result = mysqli_query($connection, $query);

                        if(!$result)
                        {
                            die("Query failed " . mysqli_error($connection));
                        }

                        // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 
                        //         WHERE post_id = $the_get_post_id";
                        // $increasing_commet_count = mysqli_query($connection, $query);
                    }
                    else
                    {
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }

                    

                    

                    

                    


                }

            ?>

                 <!--   Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" name="comment_email" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="comment_content">Content</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>

                        <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                
                    $query = "SELECT * FROM comments WHERE comment_post_id = $the_get_post_id AND 
                            comment_status = 'approved' ORDER BY comment_id DESC";
                    $show_comment_based_on_approval = mysqli_query($connection, $query);

                    if (!$show_comment_based_on_approval) 
                    {
                        die("Query failed " . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_array($show_comment_based_on_approval)) 
                    {
                        $comment_date = $row['comment_date'];
                        $comment_author = $row['comment_author'];
                        $commet_content = $row['comment_content'];
                ?>
                    <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $commet_content; ?>
                    </div>
                </div>
                <?php
                    } } }
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

        <hr>
            </div>


<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    $(document).ready(function(){
        var post_id = <?php echo $the_get_post_id; ?>;
        var user_id = 35; // for ali user (admin)
         // for like 
         $('.like').click(function(){
            $.ajax({
                url: "/diaz/mine/cms2/post.php?p_id=<?php echo $the_get_post_id; ?>", 
                type: 'post', 
                data: {
                     'liked'  : 1, 
                     'post_id':post_id, 
                     'user_id':user_id 
                }
            });
         }); 
         // for unlike 
          $('.unlike').click(function(){
            $.ajax({
                url: "/diaz/mine/cms2/post.php?p_id=<?php echo $the_get_post_id; ?>", 
                type: 'post', 
                data: {
                     'unliked'  : 1, 
                     'post_id':post_id, 
                     'user_id':user_id 
                }
            });
         }); 
    });  

</script>




