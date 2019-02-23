<?php

function imagePlaceholder($image=''){
  if(!$image){
    return 'images/cartoon.jpg'; 
  }else {
    return $image; 
  }
}

// ======= Database Helpers ====// 
function redirect($location){
  header("Location: $location"); 
  exit; 
}

function confirm_query($query){
  global $connection; 
 if (!$query) {
       die("Query Failed: ". mysqli_error($connection)); 
     } 
}

function query($query){
  global $connection; 
  $result =  mysqli_query($connection,$query); 
  confirm_query($result); 
  return $result; 
}

function fetchRecord ($result){
  return mysqli_fetch_array($result); 
}

// ======= End  Database Helpers ====// 

// ======= Authentication Helpers ====// 

function is_admin(){
  global $connection; 

  if(isLoggedIn()){
    $query = "SELECT user_role from users where user_id=".$_SESSION['user_id'].""; 
    $result = query($query); 
    // confirm_query($result); // because it is embeded in query function 
    $row = fetchRecord($result); 
    if ($row['user_role'] == 'admin') {
      return true; 
    }else {
      return false; 
    }
  }
  return false; 
}

// ======= End Authentication Helpers ====// 

// ======= General Helpers ====// 
function get_user_name(){
  return isset($_SESSION['username'])? $_SESSION['username'] : null; 
}

// ======= General Helpers ====// 

// excaping frpm SQL injection 
function escape($string){
  global $connection; 
  return mysqli_real_escape_string($connection, $string);
}

function users_online(){

    if (isset($_GET['onlineusers'])) {
       global $connection;

       if (!$connection) {
         session_start(); 
         include('../includes/db.php'); 
       }
      $session= session_id(); 
      $time = time(); 
      $time_out_in_seconds = 30; // seconds you want user to remain
      $time_out = $time - $time_out_in_seconds; 

      $query = "SELECT * from users_online where session = '$session'"; 
      $send_query = mysqli_query($connection, $query);
      $count = mysqli_num_rows($send_query);
      if ($count == NULL ) {
        mysqli_query($connection, "INSERT into users_online (session, time) values ('$session','$time')"); 
      }else{
        // if there user online 
        mysqli_query($connection, "UPDATE users_online set time = '$time' WHERE session = '$session'"); 
      }

      $users_online_query = mysqli_query($connection, "SELECT * from users_online where time > '$time_out'"); 
      echo $count_users = mysqli_num_rows($users_online_query );
    }
    
}

// call the function 
users_online(); 

function insert_categories(){

global $connection; 
  // Inserting categories 
	if ($_POST['submit']) {
	$cat_title = $_POST['cat_title']; 

	if (empty($cat_title)){
 		echo "<p class='alert alert-danger'>The Category title should not be empty</p>";
	} else {
	  $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?)"); 
	  // $query .="VALUES ('{$cat_title}') "; 
    mysqli_stmt_bind_param($stmt, "s",$cat_title );
    mysqli_stmt_execute($stmt);

	  // $catgs_query = mysqli_query($connection, $query); 

 	 if (!$stmt) {
    	echo "Qeury failed: " . mysqli_error($connection);
	  }
	}
 }
}

function select_all_categories(){
	global $connection; 

	$query = "SELECT * FROM categories"; 
	$select_all_catgs = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($select_all_catgs)) {
    $cat_id = $row['cat_id']; 
    $cat_title = $row['cat_title']; 
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}' onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
    echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
    echo "</tr>";
  }
}


function delete_categoreis(){ 
global $connection; 
      if (isset($_GET['delete'])) {
          $cat_to_delete = $_GET['delete']; 
          $query = "DELETE FROM categories WHERE cat_id = {$cat_to_delete} LIMIT 1"; 
          
          $delete_catgs = mysqli_query($connection, $query);
          header("Location: categories.php"); 

          }
}

// this is the function that count the table (posts, commments, ...)
function recordCount($table){

  global $connection; 

  $query = "SELECT * FROM $table";
  $select_all_table_query = mysqli_query($connection, $query); 
  $table_count = mysqli_num_rows($select_all_table_query); 
  confirm_query($table_count);

  return $table_count; 
}

// chech the status of tables to make the google charts 
function checkStatus($table, $column, $status){
  global $connection; 

     $query = "SELECT * FROM $table WHERE $column ='$status' ";
     $select_all_query = mysqli_query($connection, $query); 
      
      return mysqli_num_rows($select_all_query);

}




function user_exists($username){
  global $connection; 

  $query = "SELECT user_name from users where user_name = '$username'"; 
  $result = mysqli_query($connection, $query); 
  confirm_query($result); 
  if (mysqli_num_rows($result) > 0) {
    return true; 
  }else {
    return false; 
  }
}

function email_exists($email){
  global $connection; 

  $query = "SELECT user_email from users where user_email = '$email'"; 
  $result = mysqli_query($connection, $query); 
  confirm_query($result); 
  if (mysqli_num_rows($result) > 0) {
    return true; 
  }else {
    return false; 
  }
}

function register_user($username , $email, $password){
      global $connection;
    
       $username = mysqli_real_escape_string($connection, $username); 
       $email    = mysqli_real_escape_string($connection, $email); 
       $password = mysqli_real_escape_string($connection, $password); 

       // new and easier way for encrrpting password 
       $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>10)); 


       $query  = "INSERT INTO users (user_name, user_email, user_password, user_role) "; 
       $query .= " Values('$username', '$email', '$password', 'subscriber')";
       $regiser_user_query = mysqli_query($connection, $query); 

       confirm_query($regiser_user_query); 

       echo $message = "Your registration has been submitted"; 


}   // endf function 

function login_user ($username, $password){
    global $connection;
    $username = trim($username);
    $password = trim($password); 

    $username = mysqli_real_escape_string($connection, $username); 
    $password = mysqli_real_escape_string($connection, $password); 

    $query = "SELECT * FROM users where user_name = '{$username}'"; 

    $user_select_query = mysqli_query($connection, $query); 

    if (!$user_select_query) {
      die('query failed ' . mysqli_error($connection)); 
    }

    while ($row = mysqli_fetch_array($user_select_query)) {
      $db_user_id = $row['user_id'];
      $db_user_name = $row['user_name'];
      $db_user_password = $row['user_password'];
      $db_user_firstname = $row['user_firstname'];
      $db_user_lastname = $row['user_lastname'];
      $db_user_email = $row['user_email'];
      $db_user_role = $row['user_role'];

          if (password_verify($password, $db_user_password)){
      $_SESSION['user_id'] = $db_user_id; 
      $_SESSION['username'] = $db_user_name; 
      $_SESSION['firstname'] = $db_user_firstname; 
      $_SESSION['lastname'] = $db_user_lastname; 
      $_SESSION['role'] = $db_user_role; 
      redirect("/diaz/Mine/CMS2/admin/"); 
    }else {
      return false;
    }
    }

    // old way of dealing with password 
    // $password = crypt($password, $db_user_password); // reverse crypt so we can login 

    // if ($username !==  $db_user_name || $password !== $db_user_password) {
    //  header("Location: ../index.php"); 
    //  // the entering one 

    // }

}

 // new helper functions 
 function ifItisMethod($mehtod=null){
  if ($_SERVER['REQUEST_METHOD'] == strtoupper($mehtod)) {
    return true; 
  }
  return false; 
 }

 function isLoggedIn(){
    if (isset($_SESSION['role'])) {
      return true; 
    }
    return false; 
}

function loggedInUserId(){
  if (isLoggedIn()) {
    $username = $_SESSION['username']; 
    $result = query("SELECT * from users where user_name='$username'"); 
    confirm_query($result); 
    $usernameNum = mysqli_fetch_array($result); 

    return mysqli_num_rows($result) >= 1 ? $usernameNum['user_id'] : false; 
    // if (mysqli_num_rows($result)>=1) {
    //   return $usernameNum['user_id'];
    // }
  }
  return false;
}

function userLikedThisPost($post_id=''){
  $result = query("SELECT * from likes where user_id = ".loggedInUserId()." AND post_id=$post_id"); 
  confirm_query($result); 

  return mysqli_num_rows($result) >= 1 ? true : false; 
}


// function loggedInUserId(){
//   global $connection; 
//   if (isLoggedIn()) {
//     $username = $_SESSION['username']; 
//     $result = mysqli_query($connection,"SELECT * from users where user_name='$username'"); 
//     $user  = mysqli_fetch_array($result);
//     if (mysqli_num_rows($result)>=1) {
//           return $user['user_id']; 
//     }
//   }
//   return false; 
// }

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
  if (isLoggedIn()) {
    redirect($redirectLocation); 
  }
}
