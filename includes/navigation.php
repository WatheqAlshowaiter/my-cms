  <?php ob_start(); ?>    
  <?php session_start(); ?>
  <?php require 'admin/functions.php'; ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?=BASE_URL;?>">CMS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <?php 
              $query = "SELECT * FROM categories"; 
              $select_all_catgs = mysqli_query($connection, $query);

              while ($row = mysqli_fetch_assoc($select_all_catgs)) {
                $cat_id = $row['cat_id']; 
                $cat_title = $row['cat_title']; 

                        $category_class = '';

                        $registration_class = '';
                        $login_class = '';

                        $contact_class = '';
                        

                        $pageName = basename($_SERVER['PHP_SELF']);

                        $registration = 'registration.php';

                        $contact = 'contact.php';

                        $login = 'login.php';

                        if(isset($_GET['cat_id']) && $_GET['cat_id'] == $cat_id)
                        {
                            $category_class = 'active';
                        }
                        elseif ($pageName == $registration) 
                        {
                            $registration_class = 'active';
                        }

                        elseif ($pageName == $contact) 
                        {
                            $contact_class = 'active';
                        }
                        elseif ($pageName == $login) 
                        {
                            $login_class = 'active';
                        }

                echo "<li class='nav-item'>
                <a href='".BASE_URL."/category/{$cat_id}' class='nav-link  $category_class'>{$cat_title}</a>
                </li>";
                // echo "<li><a href='category.php?cat_id={$cat_id}' class='text-white'> {$cat_title}</a></li>";
              

              } // end while 
             ?>
             <?php 
              // for editing posts directly 
             
              if ($_SESSION['role'] && isset($_GET['p_id'])) {
                 $the_post_id = $_GET['p_id'];
                  echo "<li class='nav-item'><a class='nav-link active' href='".BASE_URL."/admin/posts.php?source=edit_post&p_id=$the_post_id'>Edit Post</a></li>";
              }


              ?>

              <?php if (isLoggedIn()): ?>
                  <li class="nav-item"><a class="nav-link" href="<?=BASE_URL;?>/admin/logout.php">logout</a></li>
             
              <?php else: ?>
                 <li class="nav-item"><a class="nav-link <?php echo $login_class; ?>" href="<?=BASE_URL;?>/login.php">login</a></li>
                 <li class="nav-item"><a class="nav-link <?php echo $registration_class; ?>" href="<?=BASE_URL;?>/registration">Register</a></li>
                
            <?php endif; ?>


 

            <li class="nav-item"><a class="nav-link <?php echo $contact_class ?>" href="<?=BASE_URL;?>/contact">Contact</a></li>

           
         <!-- if you are logged in, show this links -->
              <?php if (isset($_SESSION['role'])): ?>
                   <li class="nav-item active">
                     <a class="nav-link" href="admin/">Dashboard
                <span class="sr-only">(current)</span>
                    </a>
                   </li>
              <?php endif ?>
             
           <!-- <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>