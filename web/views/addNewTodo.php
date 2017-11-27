<?php

	require_once '../app/init.php';
	$user = $_SESSION['user_id'];
  $courses = "SELECT Courses.cID, Courses.Department, Courses.CourseCode  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.uID = $user";
	$coursesResult = mysqli_query($conn, $courses);
	if (!$coursesResult) {
		die("Query to show fields from table failed");
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Todo list - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/main.css">
	<link rel="stylesheet" href="../public/css/addNewTodo.css">
</head>
<body>
  <div id="site-header">
		<div id="header-content">
			<div id="logo">
				<a href="todos.php?"><img class="icon" src="../public/icons/spade.svg" alt=""></a>
			</div>
	    <div id="navbar">
				<a href="addNewTodo.php"><img class="icon" src="../public/icons/plus.svg" alt="" style="margin-right:200px;"></a>
				<img class="icon" src="../public/icons/whmcs.svg" alt="">
	    </div>
	  </div>
		</div>
  <div id="site-content">
    <form action="../app/insertTask.php?" method="post">
	    <div>
	        <label for="title">Title: </label>
	        <input type="text" name="title" id="title" required>
	    </div>
	    <div>
	        <label for="dateAssigned">Date Assigned:</label>
	        <input type="date" name="dateAssigned" id="dateAssigned" required>
	    </div>
	    <div>
	        <label for="tag">Tag:</label> <br>
	        <input type="radio" name="tag" value="personal" required checked> Personal<br>
					<?php while($coursesRow = mysqli_fetch_row($coursesResult)) { ?>
	            <input type="radio" name="tag" value="<?php echo $coursesRow[0]?>"> <?php echo "$coursesRow[1]-$coursesRow[2]"?><br>
	        <?php } ?>
	    </div>
	    <div>
	        <label for="description">Description:</label>
	        <input type="text" name="description" id="description">
	    </div>
	    <div>
	        <label for="magnitude">Magnitude (1-4):</label><input type="number" name="magnitude" min="1" max="4" value="4" required>
	    </div>
	    <input type="submit" value="Submit">
		</form>
  </div>
</body>
</html>
