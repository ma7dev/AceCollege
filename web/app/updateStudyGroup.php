<?php
		require_once '../app/init.php';
		$user = $_SESSION['user_id'];
		$url = "../views/studygroup.php?";
// Assign the input to the proper variable.
    $sgID = $_GET['sgID'];
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$dateAssigned = mysqli_real_escape_string($conn, $_POST['dateAssigned']);
		$tag = mysqli_real_escape_string($conn, $_POST['tag']);
		$description = mysqli_real_escape_string($conn, $_POST['description']);
		$location = mysqli_real_escape_string($conn, $_POST['location']);
// Open the table to insert
		$query = "UPDATE StudyGroups SET Title = '$title' , Description='$description', uID='$user',cID='$tag', DateAssigned='$dateAssigned', Location='$location' WHERE sgID = '$sgID';" ;
		if(mysqli_query($conn, $query)){
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
?>
