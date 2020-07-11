<?php
session_start();
require('connection.php');

$user_id=$_SESSION['email'];
header('Access-Control-Allow-Headers: *');
require_once 'init.php';
if(isset($_GET['book_id'])) {
	$data = $_GET['book_id'];
	// $user =$_SESSION['email'];

	$query = $es->search([
			'index'=> 'book',
		'type' => '_doc',
		'body' => [
			 'query' => [
								'match'  => ['_id' => $data],

			 ]

		]

 ]);
 if($query['hits']['total'] >= 1){
		$results = $query ['hits']['hits'];

		foreach($results as $r) {

			 $authors=$r['_source']['authors'];
			 $average_rating=$r['_source']['average_rating'];
			 $title=$r['_source']['title'];
			 $isbn=$r['_source']['isbn'];
			 $isbn13=$r['_source']['isbn13'];
			 $language_code=$r['_source']['language_code'];
			 $ratings_count=$r['_source']['ratings_count'];
			 $text_reviews_count=$r['_source']['text_reviews_count'];
		}
	}
}
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

  <style>
      h1 {
        font-family: Arvo, serif;
        text-align: center;
        font-size: 59px;
        position: relative;
        right: -130px;
      }
  </style>

</head>
<body>
<!-- Navigation bar -->
<?php
if(!isset($_SESSION['user_id'])){
 ?>
 <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
	 <div class="container-fluid">
					<div class="navbar-header">
						<a href="http://52.73.241.4/Expand-Books-Search-Engine/mainpageloggedin.php" class="navbar-brand">Expand</a>
						<button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
								<span style="color:blue" class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
					 </div>
								<div class="navbar-collapse collapse"id="navbarCollapse">
								<ul class="nav navbar-nav">
									<li class="active"><a href="mainpageloggedin.php">Home</a></li>
									<!-- <li><a href="add.php">Add Books</a></li> -->
									<!-- <li><a href="#">Help</a></li> -->
									<!-- <li><a href="#">Contact us</a></li> -->
								</ul>
								<!-- <ul class="nav navbar-nav navbar-right">
									<li><a href="#loginModal" data-toggle="modal">Login</a></li>
									<li><a href="#signupModal" data-toggle="modal">Sign up-It's free</a></li>
								</ul> -->
							 </div>
	 </div>
 </nav>
<?php
} else {
	?>
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
 <?php
}
?>

<br>
<br>
<br>
<br>
<br>
	<div id="listId">
		<ul class="list">
				<div class="row" style="text-align: center">
					<div class="container">
						<div class="panel panel-success">
												<div class=panel-heading>
													<h2 class=panel-title>
														<b>Title:</b><p>
																<?php
										echo $title; ?><p></p>
												</div>

														<b>Authors:</b><p>
																<?php
										echo $authors; ?><p></p><br>
														<b>Average Rating:</b><p>
																<?php echo $average_rating; ?><p></p><br>
														<b>DocId:</b>
															<center>
																	<?php echo $data; ?>
															</center>
														<br>
														<b>Isbn:</b>
															<center>
																	<?php echo $isbn; ?>
															</center>
														<br>
														<b>Isbn13:</b>
															<center>
																	<?php echo $isbn13; ?>
															</center>
														<br>
														<b>Language Code:</b>
															<center>
																	<?php echo $language_code; ?>
															</center>
														<br>
														<b>Ratings count:</b>
															<center>
																	<?php echo $ratings_count; ?>
															</center>
														<br>
														<b>Text Reviews count:</b>
															<center>
																	<?php echo $text_reviews_count; ?>
															</center>
														<br>
										</div>
									</div>
								</div>
		</ul>
	</div>
	<br><br>
				<!--Footer-->
				<div class="footer">
						<div class="container">
								<p>expand.com Copyright &copy;<?php $today = date("Y"); echo $today?>.</p>
						</div>
				</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script>
			  function search_book(event) {
			  // console.log(event);
			  // var xmlHttp = new XMLHttpRequest();
			  // xmlHttp.open( "GET", event, false ); // false for synchronous request
			  // xmlHttp.send( null );
			  // alert (xmlHttp.responseText);

			  }
			  </script>
			  </body>
			  </html>
