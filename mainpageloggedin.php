<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Books</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="styling.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />

      <style>
        #container{
            margin-top:120px;
        }
        #allBooks, #Notepad, #done{
            display: none;
        }
        .buttons{
            margin-bottom: 20px;
        }
        textarea{
          width: 100%;
          max-width: 100%;
          font-size: 16px;
          line-height: 1.5em;
          border-left-width: 20px;
          border-color: #479bc7;
          color: black;
          background-color: #E0FFFF;
          padding: 10px;
        }
      </style>
  </head>
  <body>
      <!--Navigation Bar-->
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
               <div class="navbar-header">
                 <a href="mainpageloggedin.php" class="navbar-brand">Search Engine</a>
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
                       <li><a href="#">Help</a></li>
                       <li><a href="#">Contact us</a></li>
                       <li class="active"><a href="#">My Books</a></li>
                     </ul>
                     <ul class="nav navbar-nav navbar-right">
                         <li><a href="#">Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
                       <li><a href="index.php?logout=1">Log out</a></li>
                     </ul>
                    </div>
        </div>
      </nav>

        <div class="container" id="container">
          <div class="row">
            <div class="col-md-offset-3 col-md-6">
              <div class="buttons">
                <button id="addBooks" type="button" class="btn btn-info btn-lg">Add Books</button>
                <button id="edit" type="button" class="btn btn-info btn-lg pull-right">Edit</button>
                <button id="done" type="button" class="btn green btn-lg pull-right">Done</button>
                <button id="allBooks" type="button" class="btn btn-info btn-lg">All Books</button>
              </div>
              <br>
              <center><h1><font size="15">Expand</font></h1></center>
              <center><p>Discover Amazing Books</p></center>
              <div id ="Notepad">
                <textarea rows="10">
                </textarea>
               </div>
               <div id="notes" class="notes">
                 <!-- Ajax call to php -->
               </div>
            </div>
          </div>
        </div>

        <!-- Search form -->
        <br><br><br><br><br><br>
        <div class="search-container">
        	<div class="row">
                   <div id="custom-search-input">
                                    <div class="input-group col-md-12">
                                        <input type="text" class="  search-query form-control" placeholder="Search" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" type="button">
                                                <span class=" glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
        	</div>
        </div>

        <!--Footer-->
        <div class="footer">
            <div class="container">
                <p>expand.com Copyright &copy;<?php $today = date("Y"); echo $today?>.</p>
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="javascript.js"></script> -->
</body>
</html>
