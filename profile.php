<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');

$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}else{
    echo "There was an error retrieving the username and email from the database";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="styling.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
      <style>
        #container{
            margin-top:100px;
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
        tr{
          cursor:pointer;
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
                     <li class="active"><a href="profile.php">Profile</a></li>
                     <!-- <li><a href="#">Help</a></li> -->
                     <li><a href="add.php">Add Books</a></li>
                     <li><a href="favourite.php">Favorites</a></li>
                     <li><a href="#">Home</a></li>
                   </ul>
                   <ul class="nav navbar-nav navbar-right">
                       <li><a href="#">Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
                     <li><a href="index.php?logout=1">Log out</a></li>
                   </ul>
                  </div>
      </div>
    </nav>
      <!-- Container class -->
        <div class="container" id="container">
          <div class="row">
            <div class="col-md-offset-3 col-md-6">
              <h2>General Account Settings:</h2>
              <div class="table-responsive">
                  <table class="table table-hover table-condensed table-bordered">
                      <tr data-target="#updateusername" data-toggle="modal">
                          <td>Username</td>
                          <td><?php echo $username; ?></td>
                      </tr>
                      <tr data-target="#updateemail" data-toggle="modal">
                          <td>Email</td>
                          <td><?php echo $email ?></td>
                      </tr>
                      <tr data-target="#updatepassword" data-toggle="modal">
                          <td>Password</td>
                          <td>hidden</td>
                      </tr>
                  </table>

              </div>
            </div>
          </div>
        </div>

  <!--Update username-->
        <form method="post" id="updateusernameform">
          <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                      &times;
                    </button>
                    <h4 id="myModalLabel">
                      Edit Username:
                    </h4>
                </div>
                <div class="modal-body">

                    <!--update username message from PHP file-->
                    <div id="updateusernamemessage"></div>


                    <div class="form-group">
                        <label for="username" >Username:</label>
                        <input class="form-control" type="text" name="username" id="username" maxlength="30" value="<?php echo $username; ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn green" name="updateusername" type="submit" value="Submit">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                  </button>
                </div>
            </div>
        </div>
      </div>
        </form>

        <!--Update Email Form-->
        <form method="post" id="updateemailform">
          <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                      &times;
                    </button>
                    <h4 id="myModalLabel">
                      Enter new email:
                    </h4>
                </div>
                <div class="modal-body">

                    <!--Update email message from PHP file-->
                    <div id="updateemailmessage"></div>


                    <div class="form-group">
                        <label for="email" >Email:</label>
                        <input class="form-control" type="email" name="email" id="email" maxlength="50" value="<?php echo $email ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn green" name="updateusername" type="submit" value="Submit">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                  </button>
                </div>
            </div>
        </div>
        </div>
        </form>

        <!--Update Password Form-->
        <form method="post" id="updatepasswordform">
          <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button class="close" data-dismiss="modal">
                      &times;
                    </button>
                    <h4 id="myModalLabel">
                      Update your Password:
                    </h4>
                </div>
                <div class="modal-body">
                    <!--Update password message from PHP file-->
                    <div id="updatepasswordmessage"></div>
                    <div class="form-group">
                        <label for="currentpassword" class="sr-only">Your current password:</label>
                        <input class="form-control" type="password" name="currentpassword" id="currentpassword" maxlength="30" placeholder="Your current Password">
                    </div>
                    <div class="form-group">
                        <label for="password" class="sr-only">Enter new Password:</label>
                        <input class="form-control" type="password" name="password" id="password" maxlength="30" placeholder="Enter new Password">
                    </div>
                    <div class="form-group">
                        <label for="password2" class="sr-only">Confirm new Password:</label>
                        <input class="form-control" type="password" name="password2" id="password2" maxlength="30" placeholder="Confirm new Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="rememberme" id="rememberme">
                          Remember me
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn green" name="updateusername" type="submit" value="Update">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
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
    <script src="profile.js"></script>
</body>
</html>
