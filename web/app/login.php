<?php
		require_once 'init.php';
// Assign the input to the proper variable.
		$email = mysqli_real_escape_string($conn, $_POST['uID']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
// Find the data from the table and assign the data to $tuple.
		$query = "SELECT Email, Password, Salt, Name,ID FROM Users WHERE Email = '$email'" ;
		$result = mysqli_query($conn, $query);
		$tuple = mysqli_fetch_array($result);
		if ($tuple[0] != $email) {
			echo "Wrong ID";
		}
// Password checking
		else {
			if ($tuple[1] == sha1($password.$tuple[2])) {
				$_SESSION['user_id'] = $tuple[4];
				 $url = "../views/todos.php?userID=". $tuple[4] ."&date=inbox-opt";
        echo "<script>window.location = '$url'</script>";
        exit;
			}
			else {
				echo "Wrong password";
			}
		}
	?>
