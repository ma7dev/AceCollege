<?php
		require_once '../app/init.php';
	  $user = $_GET['userID'];
	  $url = "../views/studygroup.php?userID=$user";
// Assign the input to the proper variable.
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$dateAssigned = mysqli_real_escape_string($conn, $_POST['dateAssigned']);
		$tag = mysqli_real_escape_string($conn, $_POST['tag']);
		$description = mysqli_real_escape_string($conn, $_POST['description']);
		$location = mysqli_real_escape_string($conn, $_POST['location']);
// Get the other values
		$query = "(SELECT (MAX(sgID)+1) From StudyGroups)";
		$result = mysqli_query($conn, $query) ;
		$tID = mysqli_fetch_row($result);

// Open the table to insert
		$query = "INSERT INTO StudyGroups VALUES ('$tID[0]', '$title' , '$description', '$user','$tag', '$dateAssigned', '$location')" ;
		if(mysqli_query($conn, $query)){
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
	?>
