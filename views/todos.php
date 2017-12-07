<?php
	require_once '../app/init.php';
	$dateSort = $_GET['date'];
	$tagsSort = $_GET['tags'];
	$user = $_SESSION['user_id'];
	if($user == NULL || $user == "" ){ ?>
		<script type="text/javascript">
			window.location.href ="index.php";
		</script>
	<?php }
	if(($dateSort == NULL && $dateSort == "") && ($tagsSort == NULL && $tagsSort == "")){
		$dateSort = "inbox-opt";?>
		<script type="text/javascript">
			window.location.href ="todos.php?date=<?php echo $dateSort ?>";
		</script>
	<?php }
	$tagsSortAfter = NULL;
	$currentDate = GETDATE();
	$dateCondition ='';
	if($dateSort == 'inbox-opt'){
		$dateCondition = '';
	}
	elseif($dateSort == 'today-opt') {
		$dateCondition = ' AND datediff(Tasks.DateAssigned, CURRENT_TIMESTAMP) = 0';
	}
	else {
		$dateCondition = ' AND (datediff(Tasks.DateAssigned, CURRENT_TIMESTAMP) < 7
		AND (datediff(Tasks.DateAssigned, CURRENT_TIMESTAMP) >=0))';
	}
	$tagsForSort = explode(",", $tagsSort);
	$tagConditions = NULL;
	if(count($tagsForSort) != 0){
		for($i = 0; $i < count($tagsForSort); $i++) {
			$tagsForSort[$i] = explode("-opt", $tagsForSort[$i]);
			if ($i == 0) {
				$tagConditions = "Tasks.tag = '" . $tagsForSort[$i][0] . "'";
			}
			else {
				$tagConditions = $tagConditions . " OR Tasks.tag = '" . $tagsForSort[$i][0] . "'";
			}
		}
	}
	else{
		$tagConditions = "Tasks.tag=NULL";
	}
	$query = "SELECT tID, Title, Magnitude, DateAssigned, tag  FROM Tasks WHERE Tasks.uID = $user AND Tasks.Completion = 'N' $dateCondition AND ($tagConditions)";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failedqqqq");
	}
	$courses = "SELECT Courses.Department, Courses.CourseCode, Courses.cID  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.uID = $user";
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
	<link rel="stylesheet" href="../public/css/todos.css">
</head>
<body>
  <div id="site-header">
		<div id="header-content">
			<div id="logo">
				<a href="todos.php?"><img class="icon" src="../public/icons/spade.svg" alt=""></a>
			</div>
	    <div id="navbar">
				<a href="addNewTodo.php?"><img class="icon" src="../public/icons/plus.svg" alt="" style="margin-right:200px;"></a>
				<div class="dropdown">
				  <span class="dropbtn click-btn"><img id="settings-btn" class="icon" src="../public/icons/whmcs.svg" alt=""></span>
				  <div class="dropdown-content">
				    <a class="click-btn" href="editInfo.php">Edit Personal Information</a>
				    <a class="click-btn" href="../app/logout.php">Logout</a>
				  </div>
				</div>
	    </div>
	  </div>
		</div>
  <div id="site-content">
		<div id="secondary">
			<div id="secondary-content">
				<span id="switch-btn" class="click-btn"><a href="studygroup.php">Go to Study Group List Page</a></span>
				<ul id="date-opt">
					<li class="data-opt" id="inbox-opt"><img class="icon" src="../public/icons/inbox.svg" alt=""> Inbox</li>
					<li class="data-opt" id="today-opt"><img class="icon" src="../public/icons/calendar.svg" alt=""> Today</li>
					<li class="data-opt" id="next-opt"><img class="icon" src="../public/icons/calendar-alt.svg" alt=""> Next 7 Days</li>
				</ul>
				<hr>
				<div id="tags-opt">
					<label class="tag-opt" id="personal-opt">Personal
	  				<input type="checkbox">
					  <span class="tag-checkmark"></span>
					</label>
					<?php while($coursesRow = mysqli_fetch_row($coursesResult)) { ?>
					<label class="tag-opt" id="<?php echo $coursesRow[2]?>-opt"><?php echo "$coursesRow[0]-$coursesRow[1]"?>
					  <input type="checkbox">
					  <span class="tag-checkmark"></span>
					</label>
				<?php } ?>
				<br>
				<ul class="dropdown-content" style="list-style:none;">
					<li id="joinNewCourse-btn" class="click-btn">Join an Exciting Course</li><br>
					<li id="addNewCourse-btn" class="click-btn">Add a Course</li>
				</ul>
				</div>
			</div>
		</div>
		<div id="primary">
			<div id="primary-content">
				<form id="item-add" action="../app/addQuickTask.php?" method="post">
					<div id="item-input">
						<input id="input-title" type="text" name="title" placeholder="Quick Add Task" autocomplete="off" required>
						<input id="input-date" type="date" name="dateAssigned" placeholder="Schedule" autocomplete="off" required>
					</div>
					<button type="submit" id="submit" value="add">Add Task</button>
				</form>
		    <ul id="display-todos">
					<?php while($row = mysqli_fetch_row($result)) { ?>
			      <li class="todos-item" id="<?php echo $row[0]?>">
							<button class="complete-btn item-<?php echo $row[2]?>"></button>
							<span class="item-details">
								<?php $time = strtotime($row[3]) ?>
								<?php if(date('Y',$time) == date("Y")){?>
									<span class="item-date"><?php echo date('m/d',$time)?></span>
								<?php }else{?>
									<span class="item-date"><?php echo date('m/d/Y',$time)?></span>
								<?php }?>
								<span class="item-title"><?php echo $row[1]?></span>
								<?php
									if($row[4] != 'personal'){
										$getTag = "SELECT Courses.Department, Courses.CourseCode   FROM Courses WHERE Courses.cID = $row[4]";
										$getTagName = mysqli_query($conn, $getTag);
										$getTagName = mysqli_fetch_row($getTagName);
								?>
									<span class="item-tag "><?php echo "$getTagName[0]-$getTagName[1]" ?></span>
								<?php } else {?>
									<span class="item-tag "><?php echo $row[4] ?></span>
								<?php } ?>
							</span>
							<div class="dropdown">
							  <span class="dropbtn click-btn"><img class="icon" src="../public/icons/ellipsis-h.svg" alt=""></span>
							  <div class="dropdown-content" id="<?php echo $row[0] ?>">
							    <a class="click-btn edit-btn" href="#">Edit Task</a>
							    <a class="click-btn remove-btn" href="#">Remove Task</a>
							  </div>
							</div>
			      </li>
					<?php }?>
		    </ul>
			</div>
		</div>
  </div>
	<script type="text/javascript">
		var removeBtn = document.querySelectorAll(".remove-btn");
		for (var i = 0; i < removeBtn.length; i++) {
	    removeBtn[i].addEventListener('click', function(){
				var removeByID = $(this).closest('div').attr('id');
				window.location.href = "../app/deleteTask.php?taskID=" +removeByID;
	    });
		}

		var editBtn = document.querySelectorAll(".edit-btn");
		for (var i = 0; i < editBtn.length; i++) {
		   editBtn[i].addEventListener('click', function(){
				var editByID = $(this).closest('div').attr('id');
				window.location.href = "editTask.php?taskID=" +editByID;
		   });
		}

		var completeBtn = document.querySelectorAll(".complete-btn");
		for (var i = 0; i < completeBtn.length; i++) {
			completeBtn[i].addEventListener('click', function(){
				var completeByID = $(this).closest('li').attr('id');
				window.location.href = "../app/completeTask.php?taskID=" +completeByID;
			});
	    }

		<?php if(($tagsSort != NULL || $tagsSort != "")){ ?>
			<?php if(strpos($tagsSort, ',')){ ?>
			  <?php $tagsSortAfter = explode(",", $tagsSort); ?>
			<?php } ?>
			<?php if(is_array($tagsSortAfter)){ ?>
			  <?php for($i = 0; $i < count($tagsSortAfter); $i++){ ?>
			    var tagsSelected = document.getElementById("<?php echo $tagsSortAfter[$i] ?>");
			    var getTargetChild = tagsSelected.childNodes;
			    getTargetChild[1].checked = true;
			  <?php } ?>
			<?php }else { ?>
			  var tagsSelected = document.getElementById("<?php echo $tagsSort ?>");
			  var getTargetChild = tagsSelected.childNodes;
			  getTargetChild[1].checked = true;
			<?php } ?>
		<?php } ?>

		var dateOptBtn = document.querySelectorAll(".data-opt");
		for (var i = 0; i < dateOptBtn.length; i++) {
		   dateOptBtn[i].addEventListener('click', function(){
				var dateOptBtnByID = $(this).attr('id');
				<?php if(strpos($tagsSort, ',')){ ?>
					<?php $tagsSortAfter = explode(",", $tagsSort); ?>
				<?php } ?>
				<?php if(is_array($tagsSortAfter)){ ?>
					var urlWanted = "todos.php?date=" +dateOptBtnByID+"&tags=<?php echo $tagsSortAfter[0] ?>";
					<?php for($i = 1; $i < count($tagsSortAfter); $i++){ ?>
			      var tags = "<?php echo $tagsSortAfter[$i] ?>";
						urlWanted = urlWanted + "," + tags;
					<?php } ?>
					window.location.href = urlWanted;
				<?php }else if(($tagsSort != NULL && $tagsSort != "")){ ?>
					var urlWanted = "todos.php?date=" +dateOptBtnByID+"&tags=<?php echo $tagsSort ?>";
					window.location.href = urlWanted;
				<?php }else{ ?>
					var urlWanted = "todos.php?date=" +dateOptBtnByID;
					window.location.href = urlWanted;
				<?php } ?>
		   });
		}
		var dateSelected = document.getElementById("<?php echo $dateSort ?>");
		dateSelected.classList.add('active');

		var tagOptBtn = document.querySelectorAll(".tag-opt");
		for (var i = 0; i < tagOptBtn.length; i++) {
			tagOptBtn[i].addEventListener('click', function(){
   				var tagsOptBtnByID = $(this).attr('id');
				var date = "<?php echo $dateSort ?>";
				var removed = false;
				<?php if(strpos($tagsSort, ',')){ ?>
					<?php $tagsSortAfter = explode(",", $tagsSort); ?>
				<?php } else {?>

				console.log("tagsSort=<?php echo $tagsSort ?>");
				<?php } ?>

				<?php if(is_array($tagsSortAfter)){ ?>
					var goalFind = "<?php echo $tagsSortAfter[0] ?>";
					if(goalFind == tagsOptBtnByID){
						var urlWanted = "todos.php?date=" +date+"&tags=<?php echo $tagsSortAfter[1] ?>";
						console.log(urlWanted);
						<?php for($i = 2; $i < count($tagsSortAfter); $i++){ ?>
					     var tags = "<?php echo $tagsSortAfter[$i] ?>";
							urlWanted = urlWanted + "," + tags;
						<?php } ?>
						console.log(urlWanted);
						window.location.href = urlWanted;
					}
					else {
						var urlWanted = "todos.php?date=" +date+"&tags=<?php echo $tagsSortAfter[0] ?>";
						<?php for($i = 1; $i < count($tagsSortAfter); $i++){ ?>
							var goalFind = "<?php echo $tagsSortAfter[$i] ?>";
							if(goalFind != tagsOptBtnByID){
						     var tags = "<?php echo $tagsSortAfter[$i] ?>";
								urlWanted = urlWanted + "," + tags;
							}
							else {
								removed = true;
							}
						<?php } ?>
							if(removed != true){
								urlWanted = urlWanted + "," + tagsOptBtnByID;
							}
							window.location.href = urlWanted;
					}
					
				<?php }else if(($tagsSort != NULL && $tagsSort != "")){ ?>
					var goalFind = "<?php echo $tagsSort ?>";
					var urlWanted = "";
					if(goalFind == tagsOptBtnByID){
						urlWanted = "todos.php?date=" +date;
					}
					else {
						urlWanted = "todos.php?date=" +date+"&tags=<?php echo $tagsSort ?>,"+tagsOptBtnByID;
					}
					window.location.href = urlWanted;

					
				<?php }else { ?>
					var urlWanted = "todos.php?date=" +date+"&tags="+tagsOptBtnByID;
					window.location.href = urlWanted;
				<?php } ?>


				window.location.href = urlWanted;
			});
		 var joinCourseBtn = document.getElementById("joinNewCourse-btn");
		 joinCourseBtn.addEventListener('click', function(){
			 var urlWanted = "joinNewCourse.php";
			 window.location.href = urlWanted;
		 });
		 var addCourseBtn = document.getElementById("addNewCourse-btn");
		 addCourseBtn.addEventListener('click', function(){
			 var urlWanted = "addNewCourse.php";
			 window.location.href = urlWanted;
		 });
	 }
		var switchBtn = document.getElementById("switch-btn");
		switchBtn.addEventListener('click', function(){
			var urlWanted = "studygroup.php";
			window.location.href = urlWanted;
		});
	</script>
</body>
</html>
