<?php
		require_once 'init.php';
		$_SESSION['user_id'] = NULL ;
		$url = "../views/index.php";
		echo "<script>window.location = '$url'</script>";
	?>
