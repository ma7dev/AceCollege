<?php
	require_once '../app/init.php';
	$dateSort = $_GET['date'];
	$tagsSort = $_GET['tags'];
	if(($dateSort == NULL || $dateSort == "") || ($tagsSort == NULL || $tagsSort == "")){
		$dateSort = "inbox-opt";
		$tagsSort = "personal-opt";?>
		<script type="text/javascript">
			window.location.href ="todos.php?date=<?php echo $dateSort ?>&tags=<?php echo $tagsSort ?>";
		</script>
	<?php }
	$tagsSortAfter = NULL;

	// Variables for sorting.

	$currentDate = GETDATE();
	$dateCondition ;
	if($dateSort == 'inbox-opt'){
		$dateCondition = '';
	}
	elseif($dateSort == 'today-opt') {
		$dateCondition = ' AND datediff(Tasks.DateAssigned, CURRENT_TIMESTAMP) = 0';
	}
	else {
		$dateCondition = ' AND datediff(Tasks.DateAssigned, CURRENT_TIMESTAMP) < 7';
	}

	$tagsForSort = explode(",", $tagsSort);
	$tagConditions ;
	for($i = 0; $i < count($tagsForSort); $i++) {
		$tagsForSort[$i] = explode("-opt", $tagsForSort[$i]);
		if ($i == 0) {
			$tagConditions = "Tasks.tag = '" . $tagsForSort[$i][0] . "'";		
		}
		else {
			$tagConditions = $tagConditions . " OR Tasks.tag = '" . $tagsForSort[$i][0] . "'";
		}
	}
	// This will changed to loged in user ID.
	$user = 0;
// $user = $_SESSION['user_id'];
	$query = "SELECT tID, Title, Magnitude, DateAssigned, tag  FROM Tasks WHERE Tasks.uID = $user AND Tasks.Completion = 'N'$dateCondition AND ($tagConditions)";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	$courses = "SELECT Courses.Department, Courses.CourseCode, Courses.cID  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.StudentID = $user";
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
				<a href="todos.php"><img class="icon" src="../public/icons/spade.svg" alt=""></a>
			</div>
			<div id="navbar">
				<a href="addNewTodo.php"><img class="icon" src="../public/icons/plus.svg" alt="" style="margin-right:200px;"></a>
				<img class="icon" src="../public/icons/whmcs.svg" alt="">
			</div>
		</div>
	</div>
	<div id="site-content">
		<div id="secondary">
			<div id="secondary-content">
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
				</div>
			</div>
		</div>
		<div id="primary">
			<div id="primary-content">
				<form id="item-add" action="../app/addQuickTask.php" method="post">
					<div id="item-input">
						<input id="input-title" type="text" name="title" placeholder="Quick Add Task" autocomplete="off" required>
						<input id="input-date" type="date" name="dateAssigned" placeholder="Schedule" autocomplete="off" required>
					</div>
					<button type="submit" id="submit" value="add">Add Task</button>
				</form>
		    <ul id="display-todos">
					<?php while($row = mysqli_fetch_row($result)) { ?>
			      <li class="todos-item">
							<button class="complete-btn item-<?php echo $row[2]?>"></button>
							<span class="item-details">
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
								<?php $time = strtotime($row[3]) ?>
								<?php if(date('Y',$time) == date("Y")){?>
									<span class="item-date"><?php echo date('m/d',$time)?></span>
								<?php }else{?>
									<span class="item-date"><?php echo date('m/d/Y',$time)?></span>
								<?php }?>
							</span>
							<button class="list-btn"><img class="icon" src="../public/icons/ellipsis-h.svg" alt=""></button>
							<ul class="dropdown-content" id="<?php echo $row[0] ?>">
								<li class="edit-btn">Edit Task</li>
								<li class="remove-btn">Remove Task</li>
							</ul>
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
				var removeByID = $(this).closest('ul').attr('id');
				window.location.href = "../app/deleteTask.php?name=" +removeByID;
		    });
		}
		var editBtn = document.querySelectorAll(".edit-btn");
		for (var i = 0; i < editBtn.length; i++) {
			editBtn[i].addEventListener('click', function(){
				var editByID = $(this).closest('ul').attr('id');
				window.location.href = "editTask.php?name=" +editByID;
			});
		}


		//replace selected date option with the value of the date in the url
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
				<?php }else { ?>
					var urlWanted = "todos.php?date=" +dateOptBtnByID+"&tags=<?php echo $tagsSort ?>";
					window.location.href = urlWanted;
				<?php } ?>
			});
		}
		var dateSelected = document.getElementById("<?php echo $dateSort ?>");
		dateSelected.classList.add('active');

		var tagOptBtn = document.querySelectorAll(".tag-opt");
		var tagOptCheck = 0;
		for (var i = 0; i < tagOptBtn.length; i++) {
			tagOptBtn[i].addEventListener('click', function(){
				if (tagOptCheck == 0) {
					tagOptCheck = 1;
				}
				else {
					tagOptCheck = 0;
					var tagsOptBtnByID = $(this).attr('id');
					var tagsSelected = document.getElementById(tagsOptBtnByID);
					var getTargetChild = tagsSelected.childNodes;
					var date = "<?php echo $dateSort ?>";
					<?php if(strpos($tagsSort, ',')){ ?>
						<?php $tagsSortAfter = explode(",", $tagsSort); ?>
					<?php } ?>
					var urlWanted = "todos.php?date=" + date + "&tags=";
					var j = 0 ;
					if(getTargetChild[1].checked == false){
						<?php if(is_array($tagsSortAfter)){ ?>
							<?php for($i = 0; $i < count($tagsSortAfter); $i++){ ?>
								var tag = "<?php echo $tagsSortAfter[$i] ?>" ;
								if (tagsOptBtnByID === tag) {}
								else {
									if (j == 0) {
										j++;
										urlWanted = urlWanted + tag;
									}
									else {
										urlWanted = urlWanted + "," + tag;
									}
								}
							<?php } ?>
						<?php } ?>
					}
					else {		
						urlWanted = urlWanted + "<?php echo $tagsSort ?>" + "," + tagsOptBtnByID;
					}					
				}
				window.location.href = urlWanted;
			});
		}
		
		// mark the checkmark as blue based on the url varbiales
		<?php if(strpos($tagsSort, ',')){ ?>
		  <?php $tagsSortAfter = explode(",", $tagsSort); ?>
		<?php } ?>
		<?php if(is_array($tagsSortAfter)){ ?>
		  <?php for($i = 0; $i < count($tagsSortAfter); $i++){ ?>
		    var tagsSelected = document.getElementById("<?php echo $tagsSortAfter[$i] ?>");
		    console.log(tagsSelected);
		    var getTargetChild = tagsSelected.childNodes;
		    getTargetChild[1].checked = true;
		  <?php } ?>
		<?php }else { ?>
		  var tagsSelected = document.getElementById("<?php echo $tagsSort ?>");
		  console.log(tagsSelected);
		  var getTargetChild = tagsSelected.childNodes;
		  getTargetChild[1].checked = true;
		<?php } ?>
	</script>
</body>
</html>
