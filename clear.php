<?php
		session_start();
		$db=mysqli_connect('localhost','root','','todo') or die("Database Connection Error !!!!!");
		$curr_id=$_GET['item'];
		$qry_done="DELETE FROM ".$_SESSION['username']." WHERE id= $curr_id";
		mysqli_query($db,$qry_done);
		header('location:index.php');

?>