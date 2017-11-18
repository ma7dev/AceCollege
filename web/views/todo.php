<?php

require_once '../app/init.php';

$query = "SELECT * FROM Tasks"

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
