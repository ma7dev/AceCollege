<?php
  require_once 'init.php';
  $user = $_SESSION['user_id'];
  $url = "../views/studygroup.php?";
  $studyGroup = $_GET['sgID'];
  $query = "UPDATE Invite SET status = 2 WHERE uID = $user AND sgID = $studyGroup" ;
  if(mysqli_query($conn, $query)){
    echo "<script>window.location = '$url'</script>";
    exit;
  } else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
  }
?>
