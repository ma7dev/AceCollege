<?php
		require_once '../app/init.php';
	  $user = $_SESSION['user_id'];
	  $url = "../views/todos.php?";
// Assign the input to the proper variable.
		$title = mysqli_real_escape_string($conn, $_POST['Title']);
		$description = mysqli_real_escape_string($conn, $_POST['Description']);
		$department = mysqli_real_escape_string($conn, $_POST['Department']);
    $department =  strtoupper($department);
		$courseCode = mysqli_real_escape_string($conn, $_POST['CourseCode']);
// Get the other values
		$query = "(SELECT (MAX(cID)+1) From Courses)";
		$result = mysqli_query($conn, $query) ;
		$tID = mysqli_fetch_row($result);

// Open the table to insert
		$query = "INSERT INTO Courses VALUES ('$tID[0]', '$title' , '$description', '$department','$courseCode')" ;
		if(mysqli_query($conn, $query)){
      $enroll = "INSERT INTO Enrollment VALUES ('$user', '$tID[0]')" ;
      if(mysqli_query($conn, $enroll)){
        echo "<script>window.location = '$url'</script>";
      } else{
        echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
	?>
