<?php

	require_once '../app/init.php';
	// This will changed to loged in user ID.
	$user = 0;
	$table = Tasks;
	$query = "SELECT tID, Title, Completion, DateAssigned  FROM $table WHERE $table.uID = $user";
	$result = mysqli_query($conn, $query);
	if (!$result) {
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
					<li class="data-opt active"><img class="icon" src="../public/icons/inbox.svg" alt=""> Inbox</li>
					<li class="data-opt"><img class="icon" src="../public/icons/calendar.svg" alt=""> Today</li>
					<li class="data-opt"><img class="icon" src="../public/icons/calendar-alt.svg" alt=""> Next 7 Days</li>
					<li class="data-opt"><img class="icon" src="../public/icons/calendar-alt.svg" alt=""> Entire Term</li>
				</ul>
				<hr>
				<div id="tags-opt">
					<label class="tag-opt">Personal
	  				<input type="checkbox">
					  <span class="tag-checkmark"></span>
					</label>
					<label class="tag-opt">CS-361
					  <input type="checkbox">
					  <span class="tag-checkmark"></span>
					</label>
					<label class="tag-opt">CS-340
					  <input type="checkbox">
					  <span class="tag-checkmark"></span>
					</label>
					<label class="tag-opt">MTH-351
					  <input type="checkbox">
					  <span class="tag-checkmark"></span>
					</label>
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
			      <li class="<?php echo $row[0] ?>">
							<button class="complete-btn completed"><img class="icon" src="../public/icons/check-circle.svg" alt=""></button>
							<span class="item-details">
								<span class="item-title"><?php echo $row[1]?>,</span>
								<span class="item-completion"><?php echo $row[2]?>,</span>
								<span class="item-date"><?php echo $row[3]?></span>
							</span>
							<span class="right-actions">
								<button class="edit-btn"><img class="icon" src="../public/icons/pencil.svg" alt=""></button>
								<button class="remove-btn"><img class="icon" src="../public/icons/trash.svg" alt=""></button>
							</span>
			      </li>
					<?php }?>
		    </ul>
			</div>
		</div>
  </div>
	<div id="edit">

	</div>
  <div id="site-footer">

  </div>
</body>
</html>
