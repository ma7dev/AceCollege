<?php
		require_once 'init.php';
// Assign the input to the proper variable.
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
// Get other values and change password by salt.
		$query = "(SELECT (MAX(ID)+1) From Users)";
		$result = mysqli_query ($conn, $query) ;
		$uID = mysqli_fetch_row($result);
		$salt = bin2hex(openssl_random_pseudo_bytes(9));
		$password = sha1($password.$salt);
// Insert the value
    $query = "INSERT INTO Users VALUES ('$uID[0]', '$email', '$name', '$birthday' , '$password', '$salt')" ;
    if(mysqli_query($conn, $query)){
      $_SESSION['user_id'] = $uID[0];
			 $url = "../views/todos.php?date=inbox-opt";
			echo "<script>window.location = '$url'</script>";
    } else{
      echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    };
	?>
