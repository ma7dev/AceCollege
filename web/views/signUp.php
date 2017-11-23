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
    <form action="../app/signUpResult.php" method="post">
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

    <input type="submit" value="Submit">

    <br></br>




</form>

  </div>

  <div id="site-footer">

  </div>
</body>
</html>
