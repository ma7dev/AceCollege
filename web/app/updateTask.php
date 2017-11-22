<?php
		require_once '../app/init.php';
    $url = '../views/todos.php';
// Assign the input to the proper variable.
    $tID = $_GET['name'];
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$description = mysqli_real_escape_string($conn, $_POST['description']);
		$dateAssigned = mysqli_real_escape_string($conn, $_POST['dateAssigned']);
		$magnitude = mysqli_real_escape_string($conn, $_POST['magnitude']);
		$completion = mysqli_real_escape_string($conn, $_POST['completion']);
		$tag = mysqli_real_escape_string($conn, $_POST['tag']);
// Open the table to insert
		$query = "UPDATE Tasks SET Title = '$title', Description = '$description', DateAssigned = '$dateAssigned', Magnitude = '$magnitude', tag = '$tag' WHERE tID = '$tID';" ;
		if(mysqli_query($conn, $query)){
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
	?>
