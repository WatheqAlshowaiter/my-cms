   <form action="" method="post">
                <div class= "form-group">
                  <label for="cat_title">Edit Category</label>

                  <?php 

                  // we have changed to mysqli prepare statment 
                    if (isset($_GET['edit'])) {

                    $cat_id_edit = $_GET['edit']; 

                   $stmt = mysqli_prepare($connection, "SELECT cat_id, cat_title FROM categories WHERE cat_id = ?"); 
                   
                  mysqli_stmt_bind_param($stmt,'i', $cat_id_edit); 
                  mysqli_stmt_execute($stmt);
                  mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);

                   // $edit_query = mysqli_query($connection, $query); 

                   while(mysqli_stmt_fetch($stmt)){

                    // $cat_title_edit = $row["cat_title"]; 
                  
              ?>

              <input value="<?php if(isset($cat_title)){echo $cat_title;}?>" class="form-control" type="text" name="cat_title">

            <?php 
                 } // end while   
                }// end if 

              ?> 

              <?php 
                // Updating Query 
               if (isset($_POST['edit_category'])) {
                      $cat_title = $_POST['cat_title']; 
                      $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? LIMIT 1");
                      mysqli_stmt_bind_param($stmt,"si", $cat_title,$cat_id); 
                      mysqli_stmt_execute($stmt); 
                      

                       // $update_query = mysqli_query($connection, $query);
                      redirect("categories.php"); 

                  }


               ?>
                </div>
                <div class="form-group">
                   <input class="btn btn-primary" type="submit" name="edit_category" value="Edit Category">
                </div>
              </form>