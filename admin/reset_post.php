<?php include 'includes/admin_header.php'; ?>
<?php 
	
	if (isset($_GET['p_id'])) {
	
	 $post_to_reset = $_GET['p_id'];

	 $query = "UPDATE posts SET post_views_count = 0 where post_id = $post_to_reset LIMIT 1"; 

	 $reset_query = mysqli_query($connection, $query); 

	 if (!$reset_query) {
	 	echo "Qeury Failed: " . mysqli_error($connection); 
	 }else {
	 		 header("Location: posts.php?reseted=true"); 
	 }


	}else {
		header("location: posts.php"); 
	}


 ?>