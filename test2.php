<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include 'includes/navigation.php'; ?>
<?php

echo loggedInUserId(); 

if (userLikedThisPost(17)) {
	echo "user liked this post";
}else {
		echo "user doesn't liked this post";

}

