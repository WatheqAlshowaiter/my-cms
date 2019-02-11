<?php include 'includes/admin_header.php'; ?>
<?php 
	
	if (isset($_POST['delete'])) {
	 $post_to_delete = $_GET['delete'];

	 $query = "DELETE FROM posts WHERE post_id = $post_to_delete LIMIT 1"; 

	 $delete_query = mysqli_query($connection, $query); 

	 if (!$delete_query) {
	 	echo "Qeury Failed: " . mysqli_error($connection); 
	 }else {
	 		 header("Location: posts.php?deleted=true"); 
	 }


	}


 ?>