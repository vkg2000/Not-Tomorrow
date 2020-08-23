<?php include ('server.php') ?>
<?php

if(!isset($_SESSION['username'])){
	$_SESSION['msg']="You must be login first";
	header('location:signin.php');
}

?>


<!DOCTYPE html>
<html>
<head>
  <title>Not Tomorrow</title>
  <link rel="icon" href="images/logo.png" type="image/icon type">
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!--fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Pangolin&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">

     <link rel="stylesheet" href="style.css">
</head>
<body style="background-image: url('images/back2.jpg');">
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" href="index.php">
    <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    <span class="font1">&nbspNot Tomorrow</span>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">
    </ul>

      <a href="https://github.com/vkg2000/Not-Tomorrow" target="_blank"><button class="btn btn-link my-2 my-sm-0" type="submit">For More Details</button></a>
      &nbsp
       <a href="signout.php"><button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Sign Out</button></a>
  </div>
</nav>


  <div class="container">
  <div class="row">
    <div class="col-sm">
  <?php
	 $db=mysqli_connect('localhost','root','','todo') or die("Database Connection Error !!!!!");
	 $qry="SELECT *FROM ".$_SESSION['username'];
	 $rs=mysqli_query($db,$qry);

  ?>
<div class="list-group">
	<h1 class="list-group-item list-group-item-action list-group-item-dark"><span class="todohead">To Do</span><span class="userinbox font1"><?php echo($_SESSION['username']) ?></span></h1>
	<?php while($row=mysqli_fetch_array($rs)) :?>
		<p class="list-group-item list-group-item-action list-group-item-light work">
      <span class="item-<?php if($row[2]) echo'done'; else echo ''?>"><?php echo $row[1];?>
      <?php if($row[2]) :?><a href="clear.php?as=clear&item=<?php echo $row[0]; ?>"><button class="boxbutton" name="donebtn"><img src="images/clear-24px.svg"></button> </a><?php endif ?>
      </span>
      <?php if(!$row[2]): ?>
      <a href="done.php?as=done&item=<?php echo $row[0]; ?>"><button class="boxbutton" name="donebtn"><img src="images/done-24px.svg"></button> </a>
      <?php endif ?>   
 </p>
	<?php endwhile ?>
  <form action ="index.php" method="post" >
  <input style ="margin-top: 10px;" type="text" name="add" class="list-group-item list-group-item-action list-group-item-light work" placeholder="Add New Task">
  <button style ="margin-top: 5px;"  type="submit" name="addbtn" class="btn btn-secondary btn-lg btn-block">ADD</button>
</form>
</div>
	</div>
  </div>
</div>
</body>
</html>