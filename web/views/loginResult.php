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
				echo "Welcome $tuple[3]!<br>";
				$_SESSION['user_id'] = $tuple[4];
			}
			else {
				echo "Wrong password";
			}
		}
	?>
  </div>

  <div id="site-footer">

  </div>
</body>
</html>
