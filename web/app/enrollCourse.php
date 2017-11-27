<?php
  require_once 'init.php';
  $user = $_GET['userID'];
  $url = "../views/joinNewCourse.php?userID=$user";
  $course = $_GET['courseID'];
  $query = "INSERT INTO Enrollment VALUES ('$user', '$course')" ;
  if(mysqli_query($conn, $query)){
    echo "<script>window.location = '$url'</script>";
    exit;
  } else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
  }
?>
