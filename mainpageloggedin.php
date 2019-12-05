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
            margin-top:0px;
        }
        #allBooks, #Notepad, #done{
            display: none;
        }
        .buttons{
            margin-bottom: 20px;
        }
        .jumbotron{
            background-color: transparent;
            text-align: center;
            letter-spacing: 2.5px;
            padding: 0px;
            margin-top: 150px;
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
  <script>
var recognition = new webkitSpeechRecognition();
recognition.onresult = function(event) {
  var saidText = "";
  for (var i = event.resultIndex; i < event.results.length; i++) {
    if (event.results[i].isFinal) {
      saidText = event.results[i][0].transcript;
    } else {
      saidText += event.results[i][0].transcript;
    }
  }
  // Update Textbox value
  document.getElementById('speechText').value = saidText;

  // Search Posts
  searchPosts(saidText);
}
function startRecording(){
  recognition.start();
}
</script>
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
                       <li><a href="add.php">Add Books</a></li>
                       <li><a href="favourite.php">Favorites</a></li>
                       <li class="active"><a href="#">Home</a></li>
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
                <!-- <button id="addBooks" type="button" class="btn btn-info btn-lg">Add Books</button> -->
                <!-- <button id="edit" type="button" class="btn btn-info btn-lg pull-right">Edit</button> -->
                <button id="done" type="button" class="btn green btn-lg pull-right">Done</button>
                <button id="allBooks" type="button" class="btn btn-info btn-lg">All Books</button>
              </div>
              <br>
              <!-- <center><h1><font size="15">Expand</font></h1></center> -->
              <!-- <center><p>Discover Amazing Books</p></center> -->
              <div class="jumbotron" id="myContainer">

                  <h1>Expand</h1>
                  <p>Discover Amazing Books</p>

                  <!-- <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">Sign up-It's free</button> -->

              </div>
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
        <br><br><br>
        <div class="search-container">
           <form action="display2.php" method="get" autocomplete="off">
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
          <center><a href="#advancedsearchModal" data-toggle="modal"><font color="black">Advanced Search</font></a></center>
        </div>

        <!--Advanced Search  Form-->
        <form method="get" action="advance.php" id="advancedsearchform">
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

                    <!--Advanced Search message from PHP file-->
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
                    <!-- speech  -->
                    <div class="form-group">
                        <label for="q" class="sr-only">Search by Speech</label>
                        <input class="form-control" type="text" name="q" id="speechText" placeholder="Search by Speech" maxlength="30">
                    </div>
                    <!-- original speech  -->
                    <div class="search-container">
                    <form action="display2.php" method="get" autocomplete="on">
                      <div class='wrap'>
                      <!-- Search box-->
                      <div class="search">
                      <!-- <input type='text' class='searchTerm' id='speechText' name='q'> -->
                      <!-- <input class="searchTerm" type="text" name="q" id="speechText" placeholder="Search by Speech" maxlength="30"> -->
                      <center>
                      <input type='button' id='start' value='Start Recording' onclick='startRecording();'>
                      <button type="submit" class="searchButton"> Go
                            <i class="fa fa-search" placeholder="Search by Speech"></i>
                         </button> &nbsp;
                    </center>
                    </div>
                    </div>
                    <!-- Search Result -->
                    <div class="container"></div>
                    </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <center><input class="btn green" name="search" type="submit" value="Search"></center>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script src="javascript.js"></script> -->
</body>
</html>
