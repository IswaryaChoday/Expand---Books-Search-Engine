<?php

require_once 'init.php';
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
if (!empty($_POST)) {
	if(isset($_POST['title'], $_POST['authors'], $_POST['isbn'])) {

		$title = $_POST['title'];
		$authors = $_POST['authors'];
		$isbn = explode(',', $_POST['isbn']);

		$indexed = $es->index([
			'index' => 'book',
			'type' => '_doc',
			'body' => [
				'title' => $title,
				'authors' => $authors,
				'isbn' => $isbn
				]
			]);
      echo "<br><br><div class='alert alert-success'> Success! The Book has been indexed.</div>";
			// $message = "Added successfully!";
      // echo "<script type='text/javascript'>alert('$message');</script>";
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Add | ES</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
 		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
  <style>
      h1 {
        font-family: 'Arvo', serif;
        font-size: 59px;
        position: relative;
        right: -130px;
      }
  </style>
  </head>
  <body>
		<!--Navigation Bar-->
		<nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
			<div class="container-fluid">
						 <div class="navbar-header">
							 <a href="mainpageloggedin.php" class="navbar-brand">Expand</a>
							 <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
									 <span style="color:blue" class="sr-only">Toggle navigation</span>
									 <span class="icon-bar"></span>
									 <span class="icon-bar"></span>
									 <span class="icon-bar"></span>
							 </button>
							</div>
									 <div class="navbar-collapse collapse"id="navbarCollapse">
									 <ul class="nav navbar-nav">
										 <li><a href="profile.php">Profile</a></li>
										 <!-- <li><a href="#">Help</a></li> -->
										 <li class="active"><a href="add.php">Add Books</a></li>
										 <li><a href="favourite.php">Favorites</a></li>
										 <li><a href="mainpageloggedin.php">Home</a></li>
									 </ul>
									 <ul class="nav navbar-nav navbar-right">
											 <li><a href="#">Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
										 <li><a href="index.php?logout=1">Log out</a></li>
									 </ul>
									</div>
			</div>
		</nav>
			<!-- Body of the add -->
<div class="row vertical-center-row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
          <br><br><br><br><br><br><br><br>
            <h1>Expand</h1><p>
        </div>
    </div>
</div>
<br><br><br>
<form action="add.php" method="post" autocomplete="off">
<div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
        	<span class="input-group-addon green" id="sizing-addon2">Title</span>
		<input type="text" name="title" class="form-control" placeholder="Book Name" aria-describedby="sizing-addon2"><p>
		<p>
 	</div>
</div>
  <div class="container">
    <div class="row">
    </div>
  </div>
<p>
<br>
<div class="col-lg-4 col-lg-offset-4">
	<div class="input-group">
                <span class="input-group-addon green" id="sizing-addon2">Authors</span>
                <input type="text" name="authors" class="form-control" placeholder="Author Name" aria-describedby="sizing-addon2">
        </div>
</div>
  <div class="container">
    <div class="row">
    </div>
  </div>

<p>
<br>

<div class="col-lg-4 col-lg-offset-4">
    <div class="input-group">
		<span class="input-group-addon green" id="sizing-addon2">ISBN</span>
		<input type="text" name="isbn" class="form-control" placeholder="ISBN Number" aria-describedby="sizing-addon2">
       </div>
    </div>
</div>
  <div class="container">
    <div class="row">
    </div>
  </div>
<p>
<br>
<div class="row vertical-center-row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="center-block">
		<center
    		<br><input type="submit" class="btn btn-success" value="Submit">
		</center>
    	</form>
	<br>
      </div>
    </div>
  </div>
	<!-- Footer -->
	<div class="footer">
			<div class="container">
					<p>expand.com Copyright &copy;<?php $today = date("Y"); echo $today?>.</p>
			</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="index.js"></script>
  </body>
</html>
