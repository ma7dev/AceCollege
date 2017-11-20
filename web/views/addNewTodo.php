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
    <form action="../app/insertTask.php" method="post">
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
        <input type="radio" name="tag" value="Personal" checked required> Personal<br>
        <input type="radio" name="tag" value="CS-361"> CS-361<br>
        <input type="radio" name="tag" value="CS-340"> CS-340<br>
        <input type="radio" name="tag" value="CS-372"> CS-372<br>
        <input type="radio" name="tag" value="MTH-351"> MTH-351
    </div>
    <div>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" required>
    </div>
    <div>
        <label for="magnitude">Magnitude (1-4):</label><input type="number" name="quantity" min="1" max="4" required>
    </div>
    <input type="submit" value="Submit">

    <br></br>
</form>
  </div>
  <div id="site-footer">

  </div>
</body>
</html>
