<?php
header('Access-Control-Allow-Headers: *');
require_once 'init.php';
if(isset($_GET['q'])) {
	$q = strip_tags($_GET['q']);
        echo "<script>console.log('Debug Objects: " . $q . "' );</script>";
	$from =0;
	$size = 10;
	$query = $es->search([
		'index' => 'book',
		'from' => 0,
		'size'=> 1000,
		'type' => '_doc',
		'body' => [
		    'query' => [
			        'multi_match' => ['query' => $q,
							       'fields' => ['title', 'authors']]
		    ]
			]
	]);
	if($query['hits']['total'] >=1 ) {
		$results = $query['hits']['hits'];
	}
	$total=$query['hits']['total']['value'];
}

function highlightWords($text,$word) {
	$text = preg_replace('#'. preg_quote($word) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $text);
	return $text;
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
		<script src='https://www.google.com/recaptcha/api.js'></script>
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
<!-- Pagination -->
<script type="text/javascript">
  $(document).ready(function(){
    var options={
      valueNames:['title','authors'],
      page:10,
      pagination: true
    }
    var listObj = new List('listId',options);
  });
</script>

<body>
	<!--Navigation Bar-->
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
								 </ul>
								 <ul class="nav navbar-nav navbar-right">
									 <li><a href="#loginModal" data-toggle="modal">Login</a></li>
									 <li><a href="#signupModal" data-toggle="modal">Sign up-It's free</a></li>
								 </ul>
								</div>
		</div>
	</nav>
	<!--Sign up Form-->
	<form method="post" id="signupform">
		<div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button class="close" data-dismiss="modal">
								&times;
							</button>
							<h4 id="myModalLabel">
								Sign up today and Discover our Amazing Books!
							</h4>
					</div>
					<div class="modal-body">

							<!--Sign up message from PHP file-->
							<div id="signupmessage"></div>

							<div class="form-group">
									<label for="username" class="sr-only">Username:</label>
									<input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
							</div>
							<div class="form-group">
									<label for="email" class="sr-only">Email:</label>
									<input class="form-control" type="email" name="email" id="email" placeholder="Email Address" maxlength="50">
							</div>
							<div class="form-group">
									<label for="password" class="sr-only">Choose a password:</label>
									<input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
							</div>
							<div class="form-group">
									<label for="password2" class="sr-only">Confirm password</label>
									<input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm password" maxlength="30">
							</div>

					</div>
					<div class="modal-footer">

						<!-- ReCaptcha implementation -->
						<center><div class="g-recaptcha" data-sitekey="6LcrAMIUAAAAAC07CUDRIHIgqKoiq-nfnP_c5CL-"></div></center>
						<br>
						<center><input class="btn green" name="signup" type="submit" value="Sign up">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Cancel
					</button></center>
						<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
					</div>
			</div>
	</div>
	</div>

	</form>
	<!--Login Form-->
	<form method="post" id="loginform">
		<div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button class="close" data-dismiss="modal">
								&times;
							</button>
							<h4 id="myModalLabel">
								Login:
							</h4>
					</div>
					<div class="modal-body">

							<!--Login message from PHP file-->
							<div id="loginmessage"></div>


							<div class="form-group">
									<label for="loginemail" class="sr-only">Email:</label>
									<input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="50">
							</div>
							<div class="form-group">
									<label for="loginpassword" class="sr-only">Password</label>
									<input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
							</div>
							<div class="checkbox">
									<label>
											<input type="checkbox" name="rememberme" id="rememberme">
										Remember me
									</label>
											<a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">
									<font color ="green">Forgot Password?</font>
									</a>
							</div>

					</div>
					<div class="modal-footer">
						<center><div class="g-recaptcha" data-sitekey="6LcrAMIUAAAAAC07CUDRIHIgqKoiq-nfnP_c5CL-"></div></center>
						<br>
						<center><input class="btn green" name="login" type="submit" value="Login">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Cancel
					</button><center>
					</div>
			</div>
	</div>
	</div>
	</form>
<br>
<div class="row vertical-center-row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
					  <br><br><br><br><br><br>
            <center><h1>Expand</h1><p></center>

        </div>
    </div>
</div>

<br>
<br>
<form action="display.php" method="get" autocomplete="on">
<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="input-group">
          <input type="text" name="q" class="search-query form-control" value="<?php echo $q; ?>" placeholder= "<?php echo $q ?>">
          <span class="input-group-btn">
              <button class="btn btn-danger" type="submit" value="search">
                  <span class=" glyphicon glyphicon-search"></span>
              </button>
          </span>
        </div>
    </div>

</div>
</form>
<br>

<br>
 <div class="container">
    <div class="row" style="text-align: center">
    <h2> Search Results: </h2>
		<?php
		echo "Number of results found :".$total; ?>
    </div>
  </div>


	<div id="listId">
		<ul class="list">
			<?php echo $total ?>

			<?php
			for ($i=0; $i < $total; $i++) {
				?>
				<div class="row" style="text-align: center">
					<div class="container">
						<div class="panel panel-success">
												<div class=panel-heading>
													<h2 class=panel-title>
														<a href="<?php
														$output=('http://52.73.241.4/Expand-Books-Search-Engine/singlebook.php?book_id='.$results[$i]['_id']);
														// $output=('https://www.goodreads.com/book/auto_complete?format=json&q='.$results[$i]['_source']['isbn13']);
														// $output = ('https://www.google.com/search?q='.$r['_source']['title']);
														echo($output);
													?>"
													ONCLICK=search_book('<?php echo $output; ?>') target="_blank"><p><br>
															<?php $title1= !empty($q)?highlightWords($results[$i]['_source']['title'],$q):$results[$i]['_source']['title'];
															echo $title1;?>
														</a>
												</div>
													<br><br>
														<b>Authors:</b><p>
																<?php $authors= !empty($q)?highlightWords($results[$i]['_source']['authors'],$q):$results[$i]['_source']['authors'];
																echo $authors; ?><p></p><br>
														<b>Average Rating:</b><p>
																<?php echo $results[$i]['_source']['average_rating']; ?><p></p><br>
														<b>DocId:</b>
															<center>
																	<?php echo $results[$i]['_id']; ?>
															</center>
														<br>

														<!-- <input class="btn green saved" method="POST" id=<?php echo $results[$i]['_id']; ?> name="saved" type="submit" value="Save"> -->
													<!-- <button type="button" class="btn btn-default" data-dismiss="modal"> -->
										</div>
									</div>
								</div>
							<?php
						}
							 ?>

		</ul>
		<center><ul class="pagination"></ul></center>
	</div>
	<br><br>
				<!--Footer-->
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
