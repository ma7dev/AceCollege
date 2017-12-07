<?php
	require_once '../app/init.php';
	$user = $_SESSION['user_id'];
	$query = "SELECT ID, Email, Name, Birthday, Password  FROM Users WHERE ID = $user";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
  $print = mysqli_fetch_row($result);
  $courses = "SELECT Courses.cID, Courses.Department, Courses.CourseCode  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.uID = $user";
	$coursesResult = mysqli_query($conn, $courses);
	if (!$coursesResult) {
		die("Query to show fields from table failed");
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Information - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/main.css">
	<link rel="stylesheet" href="../public/css/user.css">
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
    <form action="../app/updateInfo.php?" method="post">
    <div>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" value="<?php echo $print[1] ?>" required>
    </div>
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $print[2] ?>" required>
    </div>
    <div>
        <label for="birthday">Birthday(optional):</label>
        <input type="date" name="birthday" id="birthday" value="<?php echo $print[3] ?>">
    </div>
    <input type="submit" value="Submit">

    <br></br>
    </form>
  </div>
</body>
</html>
