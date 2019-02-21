        <div class="col-md-4">

          <?php 

          if (isset($_POST['login'])) {
              if (ifItisMethod('post')) {
                   if (isset($_POST['username']) && isset($_POST['password'])) {
                    login_user($_POST['username'], $_POST['password']); 
                   }else{
                    redirect('index'); 
                   }
                 }     

            }


           ?>

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <form action="/diaz/mine/cms2/search.php" method="post">
              <div class="input-group">
                <input name = "search" type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button name="submit" class="btn btn-secondary" type="submit">Go!</button>
                </span>
              </div>
              </form>
            </div>
          </div>

       
          <!-- try things Wedget -->
          <div class="card my-4">
          
          <?php if (isset($_SESSION['role'])): ?>
            <!-- <h4>Your are logged in as <?php //echo $_SESSION['username']; ?> </h4> -->
            <!-- <a class='btn btn-primary'href="admin/logout.php"></a> -->
            <h5 class="card-header">You are logged in as <big><?php echo $_SESSION['username']; ?></big></h5>
            <div class="card-body">
   
                <span class="input-group-btn">
                  <a class='btn btn-primary'href="/diaz/mine/cms2/admin/logout.php">Logout</a>
                </span>
              </div>
              </form>
            </div>
           
           <?php else: ?>
           
            <h5 class="card-header">Login </h5>
            <div class="card-body">
              <form  method="post">
              <div class="form-group">
                <input name = "username" type="text" class="form-control" placeholder="Enter the user name">
              </div>
               <div class="input-group">
                <input name = "password" type="password" class="form-control" placeholder="Enter the password">
                <span class="input-group-btn">
                  <button name="login" class="btn btn-primary" type="submit">Submit</button>
                </span>
              </div>
                 <a class='d-block small'href="forgot.php?forgot=<?php echo uniqid(); ?>">forget password?</a>
              </form>
            </div>
          </div>

           <?php endif ?>
          <!-- Categories Widget -->
          <?php 
              $query = "SELECT * FROM categories limit 8"; 
              $select_catgs_sidebar = mysqli_query($connection, $query);

             ?>
          <div class="card my-4  text-white bg-secondary mb-3">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <?php 

                      while ($row = mysqli_fetch_assoc($select_catgs_sidebar)) {
                        $cat_id = $row['cat_id']; 
                        $cat_title = $row['cat_title']; 
                        echo "<li><a href='/diaz/mine/cms2/category/{$cat_id}' class='text-white'> {$cat_title}</a></li>";
                      }
                     ?>
                    
                  </ul>
                </div>
                <!-- <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">JavaScript</a>
                    </li>
                    <li>
                      <a href="#">CSS</a>
                    </li>
                    <li>
                      <a href="#">Tutorials</a>
                    </li>
                  </ul>
                </div> -->
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <?php include 'includes/widget.php'; ?>

        </div>