<?php
		require_once '../app/init.php';
    $url = '../views/todos.php';
// Assign the input to the proper variable.
		$tID = $_GET['name'];
// Open the table to insert
		$query = "DELETE FROM Tasks WHERE tID = $tID" ;
		if(mysqli_query($conn, $query)){
			echo "The task is deleted.";
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
		echo "WORKING!!!";
	?>
