<?php
	require_once '../app/init.php';
	$user = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add a Course - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/main.css">
	<link rel="stylesheet" href="../public/css/course.css">
</head>
<body>
  <div id="site-header">
		<div id="header-content">
			<div id="logo">
				<a href="todos.php?"><img class="icon" src="../public/icons/spade.svg" alt=""></a>
			</div>
	    <div id="navbar">
				<a href="addNewTodo.php?"><img class="icon" src="../public/icons/plus.svg" alt="" style="margin-right:200px;"></a>
				<img class="icon" src="../public/icons/whmcs.svg" alt="">
	    </div>
	  </div>
		</div>
  <div id="site-content">
		<br>
		<h1>Add a Course</h1>
    <form action="../app/insertCourse.php?" method="post" autocomplete="off">
	    <div>
	        <label for="Title">Title: </label>
	        <input type="text" name="Title" id="Title" required>
	    </div>
	    <div>
	        <label for="Description">Description(optional):</label>
	        <input type="text" name="Description" id="Description">
	    </div>
	    <div>
	        <label for="Department">Department:</label>
	        <input type="text" name="Department" id="Department" required>
	    </div>
	    <div>
	        <label for="CourseCode">Course Code:</label>
	        <input type="number" name="CourseCode" id="CourseCode" required>
	    </div>
	    <input type="submit" value="Submit">
		</form>
  </div>
</body>
</html>
