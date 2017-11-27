<?php

	require_once '../app/init.php';
	// This will changed to loged in user ID.
	$user = $_GET['userID'];
  $sgID = $_GET['sgID'];
	$query = "SELECT sgID, Title, Description, uID, cID, DateAssigned, Location  FROM StudyGroups WHERE sgID = $sgID";
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
  <title>Todo list - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/main.css">
	<link rel="stylesheet" href="../public/css/studygroup.css">
</head>
<body>
  <div id="site-header">
		<div id="header-content">
			<div id="logo">
				<a href="studygroup.php?userID=<?php echo $user ?>"><img class="icon" src="../public/icons/spade.svg" alt=""></a>
			</div>
	    <div id="navbar">
				<a href="addNewStudyGroup.php"><img class="icon" src="../public/icons/plus.svg" alt="" style="margin-right:200px;"></a>
				<img class="icon" src="../public/icons/whmcs.svg" alt="">
	    </div>
	  </div>
		</div>
  <div id="site-content">
    <form action="../app/updateStudyGroup.php?userID=<?php echo $user ?>&sgID=<?php echo $sgID ?>" method="post">
    <div>
        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="<?php echo $print[1] ?>" required>
    </div>
    <div>
        <label for="dateAssigned">Date Assigned:</label>
        <input type="date" name="dateAssigned" id="dateAssigned" value="<?php echo $print[5] ?>" required>
    </div>
    <div>
        <label for="tag">Course:</label> <br>
        <?php while($coursesRow = mysqli_fetch_row($coursesResult)) { ?>
          <?php if($print[4] == $coursesRow[0]){ ?>
            <input type="radio" name="tag" value="<?php echo $coursesRow[0]?>" checked required> <?php echo "$coursesRow[1]-$coursesRow[2]"?><br>
          <?php }else{ ?>
            <input type="radio" name="tag" value="<?php echo $coursesRow[0]?>"> <?php echo "$coursesRow[1]-$coursesRow[2]"?><br>
          <?php } ?>
        <?php } ?>
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" value="<?php echo $print[2] ?>">
    </div>
    <div>
			<label for="location">Location:</label>
			<input type="text" name="location" id="location" placeholder="LINC 361" value="<?php echo $print[6] ?>" required>
    </div>
    <input type="submit" value="Submit">

    <br></br>
    </form>
  </div>
</body>
</html>
