<?php
	require_once '../app/init.php';
	// This will changed to loged in user ID.
	$user = $_SESSION['user_id'];
  $coursesIn = "SELECT Courses.cID, Courses.Title, Courses.Department, Courses.CourseCode  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.uID = $user";
  $coursesResultIn = mysqli_query($conn, $coursesIn);
	if (!$coursesResultIn) {
		die("Query to show fields from table failed");
	}
	$coursesOut = "SELECT DISTINCT Courses.cID, Courses.Title, Courses.Department, Courses.CourseCode  FROM Courses, Enrollment WHERE Courses.cID NOT IN (
    SELECT Courses.cID  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.uID = $user
  )";
	$coursesResultOut = mysqli_query($conn, $coursesOut);
	if (!$coursesResultOut) {
		die("Query to show fields from table failed");
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Join Course - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/main.css">
	<link rel="stylesheet" href="../public/css/joinCourse.css">
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
    <?php if($coursesResultOut != NULL){ ?>
    <ul>
        <?php while($coursesRowOut = mysqli_fetch_row($coursesResultOut)) { ?>
          <li class="enroll-opt" id="<?php echo $coursesRowOut[0]?>">
            <span class="course-title"><?php echo "$coursesRowOut[1]"?></span>
            <span class="course-code"><?php echo "$coursesRowOut[2]-$coursesRowOut[3]"?></span>
            <button type="button" name="button" class="enroll-btn">Enroll</button>
          </li>
        <?php } ?>
    </ul>
    <hr>
    <?php } ?>
    <?php if($coursesResultIn != NULL){ ?>
      <ul>
        <?php while($coursesRowIn = mysqli_fetch_row($coursesResultIn)) { ?>
          <li class="enrolled-opt" id="<?php echo $coursesRowIn[0]?>">
            <span class="course-title"><?php echo "$coursesRowIn[1]"?></span>
            <span class="course-code"><?php echo "$coursesRowIn[2]-$coursesRowIn[3]"?></span>
            <button type="button" name="button" class="enrolled-btn">Enrolled</button>
          </li>
        <?php } ?>
      </ul>
    <?php } ?>
  </div>
  <script type="text/javascript">
    var ernollBtn = document.querySelectorAll(".enroll-btn");
    for (var i = 0; i < ernollBtn.length; i++) {
       ernollBtn[i].addEventListener('click', function(){
        var ernollBtnByID = $(this).closest('li').attr('id');
        window.location.href = "../app/enrollCourse.php?courseID=" +ernollBtnByID;
       });
    }
    var ernolledBtn = document.querySelectorAll(".enrolled-btn");
    for (var i = 0; i < ernolledBtn.length; i++) {
       ernolledBtn[i].addEventListener('click', function(){
        var ernolledBtnByID = $(this).closest('li').attr('id');
        window.location.href = "../app/leaveCourse.php?courseID=" +ernolledBtnByID;
       });
    }
  </script>
</body>
</html>
