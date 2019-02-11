<?php include 'includes/admin_header.php'; ?>
<?php 

            if (!is_admin($_SESSION['username'])) {
              header("Location: index.php");
              exit();
              // var_dump($_SESSION);
            }

 ?>

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
            <li class="breadcrumb-item active">Posts</li>
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
                case 'add_user':
                  include 'includes/add_user.php'; 
                  break;
                 case 'edit_user':
                  require 'includes/edit_user.php'; 
                  break; 
                
                default:
                  include 'includes/view_all_users.php'; 
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
