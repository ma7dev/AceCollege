<!DOCTYPE html>
<html>
<head>
  <title>Add Todo List - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../public/css/main.css">
</head>
<body>
  <div id="site-header">
    <div id="logo">
      <h1>AceCollege</h1>
    </div>
    <div id="navbar">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Todo List</a></li>
        <li><a href="#">Study Group</a></li>
      </ul>
    </div>
  </div>
  <div id="site-content">
	<?php

		require_once '../app/init.php';

// Assign the input to the proper variable.
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$birthday = mysqli_real_escape_string($conn, $_POST['birthday']);
		$status = mysqli_real_escape_string($conn, $_POST['status']);

		
// Get other values and change password by salt.

		$query = "(SELECT Count(ID) From Users)";
		$result = mysqli_query ($conn, $query) ;
		$uID = mysqli_fetch_row($result);

		$salt = bin2hex(openssl_random_pseudo_bytes(9));
		$password = sha1($password.$salt);


// Input check
		
		$check = 0;
		
		// Check the empty input.
		if($name == "" || $password == "" || $email == "" || $birthday == ""){$check = 1;}
		
		// Check email is not in Users.

		$query = "SELECT Email FROM Users ";
		$result = mysqli_query($conn, $query);

		$fields_num = mysqli_num_fields($result);

		while($row = mysqli_fetch_row($result)) {
			if ($row[0] == $email) 
				$check = 2;
		}

// Insert the value

		$query = "INSERT INTO Users VALUES ('$uID[0]', '$email', '$name', '$birthday' , '$password', '$salt', '$status', '0')" ;

		if(mysqli_query($conn, $query)){
			echo "Sign Up is Completed";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}



	?>
  </div>

  <div id="site-footer">

  </div>
</body>
</html>

