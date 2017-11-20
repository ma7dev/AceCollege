<?php
		require_once '../app/init.php';
    $url = '../views/todos.php';
// Assign the input to the proper variable.
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$description = mysqli_real_escape_string($conn, $_POST['description']);
		$dateAssigned = mysqli_real_escape_string($conn, $_POST['dateAssigned']);
		$magnitude = mysqli_real_escape_string($conn, $_POST['magnitude']);
		$tag = mysqli_real_escape_string($conn, $_POST['tag']);
// Get the other values
    $user = 0;
		$query = "(SELECT Count(tID) From Tasks)";
		$result = mysqli_query ($conn, $query) ;
		$tID = mysqli_fetch_row($result);
// Open the table to insert
		$query = "INSERT INTO Tasks VALUES ('$tID[0]', '$description', 'N', '$title' , '$dateAssigned', '$magnitude', '$user', '$tag')" ;
		if(mysqli_query($conn, $query)){
			echo "Record added successfully.";
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
		echo "WORKING!!!";
	?>
