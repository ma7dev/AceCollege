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
			window.location.href ="studygroup.php?date=<?php echo $dateSort ?>";
		</script>
	<?php }
	$tagsSortAfter = NULL;
	$currentDate = GETDATE();
	$dateCondition ='';
	if($dateSort == 'inbox-opt'){
		$dateCondition = '';
	}
	elseif($dateSort == 'today-opt') {
		$dateCondition = ' AND datediff(StudyGroups.DateAssigned, CURRENT_TIMESTAMP) = 0';
	}
	else {
		$dateCondition = ' AND (datediff(StudyGroups.DateAssigned, CURRENT_TIMESTAMP) < 7
		AND (datediff(StudyGroups.DateAssigned, CURRENT_TIMESTAMP) >=0))';
	}
	$tagsForSort = explode(",", $tagsSort);
	$tagConditions = NULL;
	if(count($tagsForSort) != 0){
		for($i = 0; $i < count($tagsForSort); $i++) {
			$tagsForSort[$i] = explode("-opt", $tagsForSort[$i]);
			if ($i == 0) {
				$tagConditions = "StudyGroups.cID = '" . $tagsForSort[$i][0] . "'";
			}
			else {
				$tagConditions = $tagConditions . " OR StudyGroups.cID = '" . $tagsForSort[$i][0] . "'";
			}
		}
	}
	else{
		$tagConditions = "StudyGroups.cID=NULL";
	}
	$query = "SELECT DISTINCT StudyGroups.sgID, StudyGroups.uID, StudyGroups.Title, StudyGroups.DateAssigned, StudyGroups.cID, StudyGroups.Location, StudyGroups.Description FROM StudyGroups, Invite WHERE ($tagConditions) $dateCondition AND (Invite.uID = $user OR StudyGroups.uID = $user)";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failedsss");
	}
	$courses = "SELECT Courses.Department, Courses.CourseCode, Courses.cID  FROM Courses, Enrollment WHERE Courses.cID = Enrollment.cID AND Enrollment.uID = $user";
	$coursesResult = mysqli_query($conn, $courses);
	if (!$coursesResult) {
		die("Query to show fields from table failed");
	}

	echo $user ;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Study Groups - AceCollege</title>
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
				<a href="studygroup.php?"><img class="icon" src="../public/icons/spade.svg" alt=""></a>
			</div>
	    <div id="navbar">
				<a href="addNewStudyGroup.php?"><img class="icon" src="../public/icons/plus.svg" alt="" style="margin-right:200px;"></a>
				<img id="settings-btn" class="icon" src="../public/icons/whmcs.svg" alt="">
				<ul class="dropdown-content" style="list-style:none;">
					<li id="editInfo-btn">Edit Personal Information</li>
					<li id="logout-btn">Logout</li>
				</ul>
	    </div>
	  </div>
		</div>
  <div id="site-content">
		<div id="secondary">
			<div id="secondary-content">
				<a href="todos.php?">Go to To-do List Page</a>
				<ul id="date-opt">
					<li class="data-opt" id="inbox-opt"><img class="icon" src="../public/icons/inbox.svg" alt=""> Inbox</li>
					<li class="data-opt" id="today-opt"><img class="icon" src="../public/icons/calendar.svg" alt=""> Today</li>
					<li class="data-opt" id="next-opt"><img class="icon" src="../public/icons/calendar-alt.svg" alt=""> Next 7 Days</li>
				</ul>
				<hr>
				<div id="tags-opt">
					<?php while($coursesRow = mysqli_fetch_row($coursesResult)) { ?>
					<label class="tag-opt" id="<?php echo $coursesRow[2]?>-opt"><?php echo "$coursesRow[0]-$coursesRow[1]"?>
					  <input type="checkbox">
					  <span class="tag-checkmark"></span>
					</label>
				<?php } ?>
				<ul class="dropdown-content" style="list-style:none;">
					<li id="joinNewCourse-btn">Join an Exciting Course</li>
					<li id="addNewCourse-btn">Add a Course</li>
				</ul>
				</div>
			</div>
		</div>
		<div id="primary">
			<div id="primary-content">
		    <ul id="display-studygroup">
					<?php if($tagsSort!=NULL){ ?>
						<?php while($row = mysqli_fetch_row($result)) { ?>
				      <li class="studygroup-item">
								<span class="item-details">
									<span class="item-title"><?php echo $row[2]?></span>
									<?php
											$getTag = "SELECT Courses.Department, Courses.CourseCode   FROM Courses WHERE Courses.cID = $row[4]";
											$getTagName = mysqli_query($conn, $getTag);
											$getTagName = mysqli_fetch_row($getTagName);
									?>
									<span class="item-tag "><?php echo "$getTagName[0]-$getTagName[1]" ?></span>
									<?php $time = strtotime($row[3]) ?>
									<?php if(date('Y',$time) == date("Y")){?>
										<span class="item-date"><?php echo date('m/d',$time)?></span>
									<?php }else{?>
										<span class="item-date"><?php echo date('m/d/Y',$time)?></span>
									<?php }?>
								</span>
								<span class="item-description ">
									<span><?php echo $row[6] ?></span>
								</span>
								<span class="item-rest ">
									<span>
										<?php echo $row[5] ?>
									</span>
								</span>
								<button class="list-btn"><img class="icon" src="../public/icons/ellipsis-h.svg" alt=""></button>
								<ul class="dropdown-content" id="<?php echo $row[0] ?>">
									<?php if($user == $row[1]) { ?>
										<li class="edit-btn">Edit Study Group</li>
										<li class="remove-btn">Remove Study Group</li>
									<?php }else{?>
										<?php
											$getStatus = "SELECT Invite.status FROM Invite WHERE Invite.sgID = $row[0] AND Invite.uID = $user";
											$getStatusName = mysqli_query($conn, $getStatus);
											if (!$getStatusName) {
												die("Query to show fields from table failedsaas");
											}
											$getStatusName = mysqli_fetch_row($getStatusName);
										?>
										<?php if($getStatusName[0] == 0 || $getStatusName[0] == 1){ ?>
											<li class="join-btn">Join Study Group</li>
										<?php }else if($getStatusName[0] == 2){?>
											<li class="leave-btn">Leave Study Group</li>
										<?php }?>
									<?php }?>
									<li class="invite-btn">Invite Someone</li>
								</ul>
				      </li>
						<?php }?>
			    </ul>
				<?php }?>
			</div>
		</div>
  </div>
	<script type="text/javascript">
		var removeBtn = document.querySelectorAll(".remove-btn");
		for (var i = 0; i < removeBtn.length; i++) {
	    removeBtn[i].addEventListener('click', function(){
				var removeByID = $(this).closest('ul').attr('id');
				window.location.href = "../app/deleteStudyGroup.php?sgID=" +removeByID;
	    });
		}

		var editBtn = document.querySelectorAll(".edit-btn");
		for (var i = 0; i < editBtn.length; i++) {
		   editBtn[i].addEventListener('click', function(){
				var editByID = $(this).closest('ul').attr('id');
				window.location.href = "editStudyGroup.php?sgID=" +editByID;
		   });
		}

		var joinBtn = document.querySelectorAll(".join-btn");
		for (var i = 0; i < joinBtn.length; i++) {
		   joinBtn[i].addEventListener('click', function(){
				var joinBtnByID = $(this).closest('ul').attr('id');
				window.location.href = "../app/enrollStudyGroup.php?sgID=" +joinBtnByID;
		   });
		}

		var leaveBtn = document.querySelectorAll(".leave-btn");
		for (var i = 0; i < leaveBtn.length; i++) {
		   leaveBtn[i].addEventListener('click', function(){
				var leaveBtnByID = $(this).closest('ul').attr('id');
				window.location.href = "../app/leaveStudyGroup.php?sgID=" +leaveBtnByID;
		   });
		}

		var inviteBtn = document.querySelectorAll(".invite-btn");
		for (var i = 0; i < inviteBtn.length; i++) {
		   inviteBtn[i].addEventListener('click', function(){
				var inviteBtnByID = $(this).closest('ul').attr('id');
				window.location.href = "inviteStudyGroup.php?sgID=" +inviteBtnByID;
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
					var urlWanted = "studygroup.php?date=" +dateOptBtnByID+"&tags=<?php echo $tagsSortAfter[0] ?>";
					<?php for($i = 1; $i < count($tagsSortAfter); $i++){ ?>
			      var tags = "<?php echo $tagsSortAfter[$i] ?>";
						urlWanted = urlWanted + "," + tags;
					<?php } ?>
					window.location.href = urlWanted;
				<?php }else if(($tagsSort != NULL && $tagsSort != "")){ ?>
					var urlWanted = "studygroup.php?date=" +dateOptBtnByID+"&tags=<?php echo $tagsSort ?>";
					window.location.href = urlWanted;
				<?php }else{ ?>
					var urlWanted = "studygroup.php?date=" +dateOptBtnByID;
					window.location.href = urlWanted;
				<?php } ?>
		   });
		}
		var dateSelected = document.getElementById("<?php echo $dateSort ?>");
		dateSelected.classList.add('active');

		var editInfoBtn = document.getElementById("editInfo-btn");
		editInfoBtn.addEventListener('click', function(){
		var urlWanted = "editInfo.php?";
			 window.location.href = urlWanted;
		});

		var logoutBtn = document.getElementById("logout-btn");
		logoutBtn.addEventListener('click', function(){
			 var urlWanted = "../app/logout.php";
			 window.location.href = urlWanted;
		});
		 
		var joinCourseBtn = document.getElementById("joinNewCourse-btn");
		joinCourseBtn.addEventListener('click', function(){
			 var urlWanted = "joinNewCourse.php?";
			 window.location.href = urlWanted;
		});
		 
		var addCourseBtn = document.getElementById("addNewCourse-btn");
		addCourseBtn.addEventListener('click', function(){
			 var urlWanted = "addNewCourse.php?";
			 window.location.href = urlWanted;
		});


		var tagOptBtn = document.querySelectorAll(".tag-opt");
		for (var i = 0; i < tagOptBtn.length; i++) {
		  tagOptBtn[i].addEventListener('click', function(){
		  var tagsOptBtnByID = $(this).attr('id');
			var date = "<?php echo $dateSort ?>";
			var removed = false;
			<?php if(strpos($tagsSort, ',')){ ?>
				<?php $tagsSortAfter = explode(",", $tagsSort); ?>
			<?php } ?>
			<?php if(is_array($tagsSortAfter)){ ?>
				var goalFind = "<?php echo $tagsSortAfter[0] ?>";
				if(goalFind == tagsOptBtnByID){
					var urlWanted = "studygroup.php?date=" +date+"&tags=<?php echo $tagsSortAfter[1] ?>";
					<?php for($i = 2; $i < count($tagsSortAfter); $i++){ ?>
				     var tags = "<?php echo $tagsSortAfter[$i] ?>";
						urlWanted = urlWanted + "," + tags;
					<?php } ?>
					window.location.href = urlWanted;
				}
			  	else {
					var urlWanted = "studygroup.php?date=" +date+"&tags=<?php echo $tagsSortAfter[0] ?>";
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
					urlWanted = "studygroup.php?date=" +date;
				}
				else {
					urlWanted = "studygroup.php?date=" +date+"&tags=<?php echo $tagsSort ?>,"+tagsOptBtnByID;
				}
				window.location.href = urlWanted;
			<?php }else { ?>
				var urlWanted = "studygroup.php?date=" +date+"&tags="+tagsOptBtnByID;
				window.location.href = urlWanted;
			<?php } ?>
		 });
		}
		console.log( <?php echo "$getStatusName[0]" ?> )
	</script>
</body>
</html>
