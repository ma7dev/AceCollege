<?php

	require_once '../app/init.php';
// This will changed to loged in user ID.	
$user = 0;

	$table = Tasks;
	$query = "SELECT tID, Title, Completion  FROM $table WHERE $table.uID = $user";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Query to show fields from table failed");
	}
	// get number of columns in table
		$fields_num = mysqli_num_fields($result);
		echo "<h1>Table: $table </h1>";
		echo "<table border='1'><tr>";
	// printing table headers
		for($i=0; $i<$fields_num; $i++) {
			$field = mysqli_fetch_field($result);
			echo "<td><b>$field->name</b></td>";
		}
		echo "</tr>\n";
		while($row = mysqli_fetch_row($result)) {
			echo "<tr>";
			// $row is array... foreach( .. ) puts every element
			// of $row to $cell variable
			foreach($row as $cell)
				echo "<td>$cell</td>";
			echo "</tr>\n";
		}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Todo list - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../public/css/main.css">
</head>
<body>
  <div id="site-header">
    <div id="logo">
      <h1>AceCollege</h1>
    </div>
    <div id="navbar">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Todo List</a></li>
        <li><a href="#">Study Group</a></li>
      </ul>
    </div>
  </div>
  <div id="site-content">
    <h1>ToDo List</h1>

    <ul id="site-todos">
      <li>
        <span class="item">Pick up shopping</span>
        <a href="#" class="done-btn">Mark as done</a>
      </li>
    </ul>
    <form id="item-add" action="add.php" method="post">
      <input type="text" name="name" id="input" placeholder="Type a new item here." autocomplete="off" required>
      <input type="submit" id="submit" value="Add">
    </form>
  </div>

  <div id="site-footer">

  </div>
</body>
</html>
