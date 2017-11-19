<!DOCTYPE html>
<html>
<head>
  <title>Add Todo List - AceCollege</title>
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
    <form action="insertTask.php" method="post">
    <p>
        <label for="title">Title: </label>
        <input type="text" name="title" id="title">
    </p>
    <p>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description">
    </p>

    <p>
        <label for="dateAssigned">Date Assigned:</label>
        <input type="text" name="dateAssigned" id="dateAssigned">
    </p>
    <p>
        <label for="magnitude">Magnitude:</label>
        <input type="text" name="magnitude" id="magnitude">
    </p>
    <p>
        <label for="tag">Tag:</label>
        <input type="text" name="Tag" id="Tag">
    </p>

    <input type="submit" value="Submit">

    <br></br>

</form>

  </div>

  <div id="site-footer">

  </div>
</body>
</html>