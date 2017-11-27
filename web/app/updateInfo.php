<?php
		require_once '../app/init.php';
	  $user = $_GET['userID'];
	  $url = "../views/todos.php?userID=". $user ."&date=inbox-opt";
// Assign the input to the proper variable.
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
		$passwordNew = mysqli_real_escape_string($conn, $_POST['passwordNew']);
// Open the table to insert
		$query = "UPDATE Users SET Email = '$email', Name = '$name', Birthday = '$birthday', Password = '$passwordNew' WHERE ID = '$user';" ;
		if(mysqli_query($conn, $query)){
      echo "<script>window.location = '$url'</script>";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}
	?>
