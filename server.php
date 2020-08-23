<?php


session_start();

$username ="";
$errors ="";

$errors =array();


//connecting to database

$db=mysqli_connect('localhost','root','','todo') or die("Database Connection Error !!!!!");

//signup

if(isset($_POST['signup'])){

$username = mysqli_real_escape_string($db,$_POST['username']);
$email = mysqli_real_escape_string($db,$_POST['email']);
$password = mysqli_real_escape_string($db,$_POST['password']);

//form validation
if(empty($email)){array_push($errors, "Email is Required");}
if(empty($username)){array_push($errors, "Username is Required");}
if(empty($password)){array_push($errors, "Password is Required");}

//checking for spaces in username
$check_username = str_replace(' ', '', $username);
if($username!=$check_username)
	{array_push($errors, "Username should not contain any space");}


//User Validation
$user_qry="SELECT *FROM users WHERE username='$username' or email='$email' LIMIT 1";
if($rs=mysqli_query($db,$user_qry) and count($errors)==0)
{
	$user=mysqli_fetch_array($rs);
	if($user['username']===$username){array_push($errors, "Username Already Exist");}
	if($user['email']===$email){array_push($errors, "This Email Id already has a registered username");}	
}

//registering the user
if(count($errors)==0){
	$password=md5($password,1); //for encrypting the password
	$qry="INSERT INTO users (username, email, password) VALUES ('$username','$email','$password')";
	$qry_table = "CREATE TABLE `todo`.`".$username."` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `work` VARCHAR(400) NOT NULL , `done` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
	mysqli_query($db,$qry_table);
	mysqli_query($db,$qry);

	$_SESSION['username']=$username;
	$_SESSION['success']="You are logged in";

	header('location:index.php');

}
}

//sign-in

if(isset($_POST['signin'])){
	$username = mysqli_real_escape_string($db,$_POST['username']);
	$password = mysqli_real_escape_string($db,$_POST['password']);

	//form validation
	if(empty($username)){array_push($errors, "Username is Required");}
	if(empty($password)){array_push($errors, "Password is Required");}

	if(count($errors)==0){
		$password=md5($password,1);
		$qry="SELECT *FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$rs=mysqli_query($db,$qry);
		if(mysqli_num_rows($rs)){
		$_SESSION['username']=$username;
		$_SESSION['success']=" logged in succesfully";
		header('location:index.php');
	}else
	{
		array_push($errors, "Wrong usename/password combination ");
	}
	}


	}

//for adding more task
	
if(isset($_POST['addbtn'])){

	$new = mysqli_real_escape_string($db,$_POST['add']);
	if(!empty($new)){
	$qry11="INSERT INTO ".$_SESSION['username']."(work,done) VALUES ('$new','false')";
	mysqli_query($db,$qry11);
}
}

?>