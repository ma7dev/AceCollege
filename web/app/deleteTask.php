<?php
		require_once '../app/init.php';
	  $user = $_SESSION['user_id'];
	  $url = "../views/todos.php?";
// Assign the input to the proper variable.
		$tID = $_GET['task'];
// Open the table to insert
		$query = "DELETE FROM Tasks WHERE tID = $tID" ;
		if(mysqli_query($conn, $query)){
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
		echo "WORKING!!!";
	?>
