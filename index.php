<?php

header('Access-Control-Allow-Headers: *');
session_start();
// include('connection.php');

//logout
include('logout.php');

//remember me
include('rememberme.php');

require_once 'init.php';

//Title search
if(isset($_GET['q'])) {

	$q =trim(strip_tags($_GET['q']));
	$query = $es->search([
		'body' => [
		    'query' => [
		        'bool' => [
			    'should' => [
			        'match' => ['title' => $q]
		        ]
		    ]
                ]
	    ]
	]);
	if($query['hits']['total'] >=1 ) {
		$results = $query['hits']['hits'];
	}
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search Engine</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="styling.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
		<script src='https://www.google.com/recaptcha/api.js'></script>

		<script type="text/javascript">
function AlertIt() {
var answer = confirm ("Please login to use the advanced search feature.")
if (answer)
window.location="http://localhost/Web-Programming/index.php";
}
</script>
  </head>
  <body>
      <!--Navigation Bar-->
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
               <div class="navbar-header">
                 <a href="http://localhost/Web-Programming/mainpageloggedin.php" class="navbar-brand">Expand</a>
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
                     <ul class="nav navbar-nav navbar-right">
                       <li><a href="#loginModal" data-toggle="modal">Login</a></li>
                     </ul>
                    </div>
        </div>
      </nav>
      <!--Jumbotron with Sign up Button-->
        <div class="jumbotron" id="myContainer">

            <h1>Expand</h1>
            <p>Discover Amazing Books</p>

            <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">Sign up-It's free</button>

        </div>
        <!-- Search form -->
        <br><br><br>
        <div class="search-container">
          <form action="display.php" method="get" autocomplete="off">
        	<div class="row">
                   <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="text" name="q" class="search-query form-control" placeholder="Search">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" type="submit" value="search">
                                                <span class=" glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                  </div>
        	</div>
        </form>
        </div>

        <!-- Advanced Search -->
        <div class="advanced-search">
          <br>
          <center><a href="javascript:AlertIt();" data-toggle="modal"><font color="black">Advanced Search</font></a></center>
        </div>


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

        <!--Advanced Search  Form-->
        <!-- <form method="get" action="advance.php" id="advancedsearchform">
          <div class="modal" id="advancedsearchModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                      &times;
                    </button>
                    <h4 id="myModalLabel">
                      Search your books by :
                    </h4>
                </div>
                <div class="modal-body">


                    <div id="signupmessage"></div>

                    <div class="form-group">
                        <label for="title" class="sr-only">Title:</label>
                        <input class="form-control" type="text" name="title" id="title" placeholder="Title" maxlength="300">
                    </div>
                    <div class="form-group">
                        <label for="author" class="sr-only">Author:</label>
                        <input class="form-control" type="text" name="author" id="author" placeholder="Author" maxlength="50q0">
                    </div>
                    <div class="form-group">
                        <label for="isbn" class="sr-only">ISBN:</label>
                        <input class="form-control" type="text" name="isbn" id="isbn" placeholder="ISBN" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="average_rating" class="sr-only">Rating</label>
                        <input class="form-control" type="text" name="average_rating" id="average_rating" placeholder="Rating" maxlength="30">
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn green" name="search" type="submit" value="Search">
                </div>
            </div>
        </div>
        </div>
        </form> -->


        <!--Forgot Password? Form-->
        <form method="post" id="forgotpasswordform">
          <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                      &times;
                    </button>
                    <h4 id="myModalLabel">
                      Forgot Password? Enter your email address:
                    </h4>
                </div>
                <div class="modal-body">
                    <!--forgot password message from PHP file-->
                    <div id="forgotpasswordmessage"></div>
                    <div class="form-group">
                        <label for="forgotemail" class="sr-only">Email:</label>
                        <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn green" name="forgotpassword" type="submit" value="Submit">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                  </button>
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="signupModal" data-toggle="modal">
                    Register
                  </button>
                </div>
            </div>
        </div>
        </div>
        </form>

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
