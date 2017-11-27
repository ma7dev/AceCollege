<?php
  require_once 'init.php';
  $user = $_GET['userID'];
  $url = "../views/studygroup.php?userID=$user";
  $studyGroup = $_GET['sgID'];
  $query = "UPDATE Invite SET status = 0 WHERE uID = $user AND sgID = $studyGroup" ;
  if(mysqli_query($conn, $query)){
    echo "<script>window.location = '$url'</script>";
    exit;
  } else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
  }
?>
