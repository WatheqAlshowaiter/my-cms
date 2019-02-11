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
            <li class="breadcrumb-item active">Admin</li>
            <li class="breadcrumb-item active">Comments</li>
          </ol>
          
         <!-- display posts -->
         <?php 
              if (isset($_GET['source'])) {
                $source = $_GET['source']; 
              }else {
                $source = ''; 
              }

              switch ($source) {
                // for test 
                case 'add_post':
                  include 'includes/add_post.php'; 
                  break;
                 case 'edit_post':
                  require 'includes/edit_post.php'; 
                  break; 
                
                default:
                  include 'includes/view_all_comments.php'; 
                  break;
              }
          ?>


            </div>

          <!-- /.container-fluid -->
        </div>

        <!-- <table>sdf</table>  Here -->



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
