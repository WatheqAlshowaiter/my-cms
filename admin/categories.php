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
            <li class="breadcrumb-item active">Category</li>
          </ol>
          
          <div class="row">
             <div class="col-sm-4">
                <?php 
                  // Inserting categories 
                   insert_categories(); 
                ?>
            </div>
          </div>
         



            <!-- Adding Category -->
            <!-- <div class="container"> -->
               <div class="row">

              <div class="col-sm-4">
              <form action="" method="post">
                <div class= "form-group">
                  <label for="cat_title">Category Name</label>
                  <input class="form-control" type="text" name="cat_title" id="cat_title">
                </div>
                <div class="form-group">
                   <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                </div>
              </form>

              <!-- Editing / Updating Category  -->
              <?php 
                if (isset($_GET['edit'])) {
                  include 'includes/update_categories.php'; 
                }

               ?>
             

         

          </div> <!-- end the div for adding and editing categories--> 


              <div class="col-sm-4 text-center">
                <table class="table table-bordered table-hover">
                 <thead>
                   <tr>
                     <th>Id</th>
                     <th>Category title</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php 
                    // Select all categories 
                    select_all_categories(); 
               ?>

               <?php 
                //Delete Categoreis  
               delete_categoreis(); 

                ?>
                 </tbody>
                </table>
             </div>
            </div>
            <!-- </div> -->
           
         
          <!-- /.container-fluid -->
        </div>



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
