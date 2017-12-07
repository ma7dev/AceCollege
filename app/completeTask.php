<?php
  require_once 'init.php';
  $user = $_SESSION['user_id'];
  $url = "../views/todos.php?date=inbox-opt";
  $tID = $_GET['taskID'];
  $query = "UPDATE Tasks SET Completion = 'Y' WHERE uID = $user AND tID = $tID" ;
  if(mysqli_query($conn, $query)){
    echo "<script>window.location = '$url'</script>";
    exit;
  } else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
  }
?>
