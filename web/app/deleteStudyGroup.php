<?php
		require_once '../app/init.php';
	  $user = $_GET['userID'];
	  $url = "../views/studygroup.php?userID=$user";
// Assign the input to the proper variable.
		$tID = $_GET['sgID'];
// Open the table to insert
		$query = "DELETE FROM StudyGroups WHERE sgID = $tID" ;
		if(mysqli_query($conn, $query)){
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
	?>
