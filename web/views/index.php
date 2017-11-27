<!DOCTYPE html>
<html>
<head>
  <title>Home - AceCollege</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="../public/css/main.css">
	<link rel="stylesheet" href="../public/css/home.css">
</head>
<body>
  <div id="site-header">

  </div>
  <div id="site-content">
    <form action="../app/signup.php" method="post" autocomplete="off">
    	<h2> Sign Up </h2>
    	<p>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="" placeholder="john@gmail.com" required>
        </p>
    	<p>
            <label for="password">Password:</label>
            <input pattern=".{6,}" title="6 characters minimum" type="password" name="password" id="password" value="" placeholder="password"  required>
        </p>
    	<p>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="" placeholder="John Doe"   required>
        </p>
        <p>
            <label for="birthday">Birthday(optional):</label>
            <input type="date" name="birthday" value=""   id="birthday">
        </p>
        <input type="submit" value="Submit">
        <br></br>
    </form>
    <form action="../app/login.php" method="post" autocomplete="off">
      <h2>Login</h2>
    <p>
        <label for="uID">Email: </label>
        <input type="email" name="uID" id="uID"  value="" placeholder="john@gmail.com"  required>
    </p>
    <p>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" value="" placeholder="password"   required>
    </p>
    <input type="submit" value="Submit">
    <br></br>
    </form>
  </div>
</body>
</html>
