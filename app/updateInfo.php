<?php
		require_once '../app/init.php';
	  $user = $_SESSION['user_id'];
	  $url = "../views/todos.php?date=inbox-opt";
// Assign the input to the proper variable.
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
// Open the table to insert
		$query = "UPDATE Users SET Email = '$email', Name = '$name', Birthday = '$birthday' WHERE ID = '$user';" ;
		if(mysqli_query($conn, $query)){
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
	?>
