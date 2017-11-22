<?php
  require_once 'init.php';
  $url = '../views/todos.php';
// Assign the input to the proper variable.
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $dateAssigned = mysqli_real_escape_string($conn, $_POST['dateAssigned']);
// Get the other values
  $user = 0;
  $query = "(SELECT (MAX(tID)+1) From Tasks)";
  $result = mysqli_query ($conn, $query) ;
  $tID = mysqli_fetch_row($result);
// Open the table to insert
  $query = "INSERT INTO Tasks VALUES ('$tID[0]', NULL, 'N', '$title' , '$dateAssigned', 4, '$user', 'personal')" ;
  if(mysqli_query($conn, $query)){
    echo "Record added successfully.";
    echo "<script>window.location = '$url'</script>";
    exit;
  } else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
  }
?>
