<?php

	require_once '../app/init.php';
	// This will changed to loged in user ID.
	$user = 0;
	$table = Tasks;
  $tID = $_GET['name'];
	$query = "SELECT tID, Title, DateAssigned, tag, Description, Magnitude  FROM $table WHERE tID = $tID";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
  $print = mysqli_fetch_row($result);
  $courses = "SELECT Courses.cID, Courses.Department, Courses.CourseCode  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.StudentID = $user";
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
				<a href="todos.php"><img class="icon" src="../public/icons/spade.svg" alt=""></a>
			</div>
	    <div id="navbar">
				<a href="addNewTodo.php"><img class="icon" src="../public/icons/plus.svg" alt="" style="margin-right:200px;"></a>
				<img class="icon" src="../public/icons/whmcs.svg" alt="">
	    </div>
	  </div>
		</div>
  <div id="site-content">
    <form action="../app/updateTask.php?name=<?php echo $tID ?>" method="post">
    <div>
        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="<?php echo $print[1] ?>" required>
    </div>
    <div>
        <label for="dateAssigned">Date Assigned:</label>
        <input type="date" name="dateAssigned" id="dateAssigned" value="<?php echo $print[2] ?>" required>
    </div>
    <div>
        <label for="tag">Tag:</label> <br>
        <?php if($print[3] == "personal"){?>
          <input type="radio" name="tag" value="personal" checked required> Personal<br>
        <?php }else{?>
          <input type="radio" name="tag" value="personal"> Personal<br>
        <?php } ?>
        <?php while($coursesRow = mysqli_fetch_row($coursesResult)) { ?>
          <?php if($print[3] == $coursesRow[0]){ ?>
            <input type="radio" name="tag" value="<?php echo $coursesRow[0]?>" checked required> <?php echo "$coursesRow[1]-$coursesRow[2]"?><br>
          <?php }else{ ?>
            <input type="radio" name="tag" value="<?php echo $coursesRow[0]?>"> <?php echo "$coursesRow[1]-$coursesRow[2]"?><br>
          <?php } ?>
        <?php } ?>
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?php echo $print[4] ?>">
    </div>
    <div>
        <label for="magnitude">Magnitude (1-4):</label><input type="number" name="magnitude" min="1" max="4" value="<?php echo $print[5] ?>"  required>
    </div>
    <input type="submit" value="Submit">

    <br></br>
    </form>
  </div>
</body>
</html>
