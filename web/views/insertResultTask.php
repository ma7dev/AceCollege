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
		echo "$tID[0]";

// Open the table to insert

		$query = "INSERT INTO Tasks VALUES ('$tID[0]', '$description', 'N', '$title' , '$dateAssigned', '$magnitude', '$user', '$tag')" ;

		if(mysqli_query($conn, $query)){
			echo "Record added successfully.";
		} else{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
		}

		echo "WORKING!!!";
	?>
  </div>

  <div id="site-footer">

  </div>
</body>
</html>

