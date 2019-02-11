

              <table class="table table-bordered table-hover">
               <thead>
                 <tr>
                   <th>Id</th>
                   <th>User Name</th>
                   <th>First Name</th>
                   <th>Last Name</th>
                   <th>Email</th>
                   <th>Role</th>
                   <th>Admin</th>
                   <th>Subscriber</th>
                   <th>Edit</th>
                   <th>Delete</th>
                 <!--   <th>Edit</th>
                   <th>Delete</th> -->
                 </tr>
               </thead>
               <tbody>
                  <?php 
                 $query = "SELECT * FROM users"; 
                 $select_all_users = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_users)) {
                  $user_id = $row['user_id']; 
                  $user_name = $row['user_name'];
                  $user_firstname = $row['user_firstname']; 
                  $user_lastname = $row['user_lastname'];
                  $user_email = $row['user_email'];
                  $user_image = $row['user_image'];
                  $user_role = $row['user_role'];


                  // to display Category by id 
                  // $query = "SELECT * FROM categories WHERE cat_id = $cat_id"; 
                  // $category_query = mysqli_query($connection, $query); 

                  //  while($row = mysqli_fetch_assoc($category_query)){

                  //   $cat_title_by_id = $row["cat_title"]; 
                  // }

                  echo "<tr>";
                  echo "<td>{$user_id}</td>";
                  echo "<td>$user_name</td>";
                  echo "<td>{$user_firstname}</td>";
                  echo "<td>{$user_lastname}</td>";
                  echo "<td>{$user_email}</td>";
                  // echo "<td> <img width='100' src='../images/$post_image' alt='$post_image'></td>";
                  // echo "<td>{$user_image}</td>";
                  // echo "<td>{$post_tags}</td>";
                  // echo "<td>{$post_comment_count}</td>";
                  echo "<td>{$user_role}</td>";
                  echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
                  echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
                  echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
                  echo "<td><a href='users.php?delete=$user_id 'onclick=\"return confirm('Are you sure?');\" >Delete</a></td>";
                  
                  
                  echo "</tr>";
                }
               ?>
               </tbody>
              </table>

                 <!-- Change Role to admin -->
                <?php 

                if (isset($_GET['change_to_admin'])) {
                      
                    $user_to_admin = $_GET['change_to_admin'];

                     $query = "UPDATE users SET user_role = 'admin' where user_id = $user_to_admin"; 

                     $change_to_admin_query = mysqli_query($connection, $query); 

                     if (!$change_to_admin_query) {
                      echo "Qeury Failed: " . mysqli_error($connection); 
                     }else {
                         header("Location: users.php"); 
                     }

                }

               ?>

                <!-- Change Role to Subscriber -->
                <?php 

                if (isset($_GET['change_to_sub'])) {
                      
                    $user_to_sub = $_GET['change_to_sub'];

                     $query = "UPDATE users SET user_role = 'subscriber' where user_id = $user_to_sub"; 

                     $change_to_sub_query = mysqli_query($connection, $query); 

                     if (!$change_to_sub_query) {
                      echo "Qeury Failed: " . mysqli_error($connection); 
                     }else {
                         header("Location: users.php"); 
                     }

                }

               ?>


              <!-- DELETING users   -->
              <?php 

                if (isset($_GET['delete'])) {
                      
                      if ($_SESSION['role'] === 'admin') {
                           $user_to_delete = $_GET['delete'];

                           $query = "DELETE FROM users WHERE user_id = $user_id LIMIT 1"; 

                           $delete_query = mysqli_query($connection, $query); 

                           if (!$delete_query) {
                            echo "Qeury Failed: " . mysqli_error($connection); 
                           }else {
                               header("Location: users.php"); 
                           }
                      }


                }

               ?>