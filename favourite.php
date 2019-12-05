<?php
               session_start();
               require('connection.php');
              $user_id=$_SESSION['email'];
                $userLoginQuery = "SELECT * FROM `savedbooks` WHERE `user_id`= '$user_id' ";
               $result = $link->query($userLoginQuery);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                  $title = $row['title'];
                  $bookId = $row['id'];

               ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Search | Online Books Search</title>
  <meta name="description" content="search-results">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="styling.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="index.js"></script>
		<script type="text/javascript" src="result.js"></script>
    <script type="text/javascript" src="remove.js"></script>
      <style>
          h1 {
            font-family: Arvo, serif;
            text-align: center;
            font-size: 59px;
            position: relative;
            right: -130px;
          }
          .blue{
              background-color: #479bc7;
          }
      </style>
</head>
<!--Navigation Bar-->
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
                 <li><a href="add.php">Add Books</a></li>
                 <li class="active"><a href=#>Favorites</a></li>
                 <li><a href="mainpageloggedin.php">Home</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                   <li><a href="#">Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
                 <li><a href="index.php?logout=1">Log out</a></li>
               </ul>
              </div>
  </div>
</nav>
<!--
<br>
<div class="row vertical-center-row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
					  <br><br><br><br><br><br>
            <center><h1>Expand</h1><p></center>
        </div>
    </div>
</div>
<div class="container">
   <div class="row" style="text-align: center">
   <h2> My Favourites: </h2>
   </div>
 </div> -->
<br>
<br>
<br>
<br>
<br>
<br>
<!-- Favourite books -->
<div class="row" style="text-align: center">
        <div class="container">
          <div class="panel panel-success">
                      <div class="panel-heading">
                        <h2 class="panel-title">
                          <a href="#" target="_blank"></a><p>
                            <a href=<?php
														$output=('http://localhost/Web-Programming/singlebook.php?book_id='.$bookId);
														// $output = ('https://www.google.com/search?q='.$r['_source']['title']);
														echo($output);
													?> target="_blank"><br>
                            <?php echo $title;?></a>
                      </p></h2></div>
                        <br><br>
                          <b>Author</b><p>
                          <?php echo $row['authors'];?></p><p></p><br>

                              <b>Average Rating</b><p>
                              <?php echo $row['average_rating'];?></p><p></p><br>
                              <input class="btn green remove" id="<?php echo $row['id']; ?>" name="Delete" type="submit" value="Delete">
                <?php }}?>
                <!-- <a class="btn blue" href="mainpageloggedin.php">Back</a> -->
          </div>
        </div>
    </div>
