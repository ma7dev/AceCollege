<?php
  require_once 'init.php';
  $user = $_GET['userID'];
  $url = "../views/joinNewCourse.php?userID=$user";
  $course = $_GET['courseID'];
  $query = "DELETE FROM Enrollment WHERE uID=$user AND cID=$course" ;
  if(mysqli_query($conn, $query)){
    echo "<script>window.location = '$url'</script>";
    exit;
  } else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
  }
?>
