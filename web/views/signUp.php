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
    <form action="signUpResult.php" method="post">
	<h2> Sign Up </h2>

	<p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
    </p>

	<p>
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
    </p>
	<p>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
    </p>
    <p>
        <label for="birthday">Birthday:</label>
        <input type="text" name="birthday" id="birthday">
    </p>
	<p>
        <label for="status">Status:</label>
        <input type="radio" name="status" id="status" value="Y" checked="checked"> Student
		<input type="radio" name="status" id="status" value="N"> Supervisor
    </p>

    <input type="submit" value="Submit">

    <br></br>

</form>

  </div>

  <div id="site-footer">

  </div>
</body>
</html>