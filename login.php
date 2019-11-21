<?php
//Start session
session_start();
//Connect to the database
include("connection.php");
//Check user inputs
    //Define error messages
$missingEmail = '<p><stong>Please enter your email address!</strong></p>';
$missingPassword = '<p><stong>Please enter your password!</strong></p>';
$captchaerrormsg='<p><strong>Please check the reCAPTCHA</strong></p>';
$errors='';
    //Get email and password
    //Store errors in errors variable
if(empty($_POST["loginemail"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["loginemail"], FILTER_SANITIZE_EMAIL);
}
//Get Captcha
if(empty($_POST['g-recaptcha-response'])){
  $errors .= $captchaerrormsg;
}else{
    $responseKey = $_POST['g-recaptcha-response'];
}
if(empty($_POST["loginpassword"])){
    $errors .= $missingPassword;
}else{
    $password = filter_var($_POST["loginpassword"], FILTER_SANITIZE_STRING);
}

if($errors){
    //print error message
    $resultMessage = '<div class="alert alert-danger">' . $errors .'</div>';
    echo $resultMessage;
    exit;
}
// ReCaptcha
if(isset($_POST['g-recaptcha-response'])) {

  $responseKey = $_POST['g-recaptcha-response'];

  if(!$responseKey){
    $errors .= $captchaerrormsg;
  }

	$secretKey = "6LcrAMIUAAAAAPD0A-T2P53yd4txgJ2na95r2zor";
	$userIP = $_SERVER['REMOTE_ADDR'];

	$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$responseKey."&remoteIP=".$userIP;
	$response = file_get_contents($url);
	$response = json_decode($response,true);

  if(intval($response["success"]) !== 1) {
   // echo '<h2>Error using captcha</h2>';

  }
else{
    //else: No errors
    //Prepare variables for the query
    $email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);
$password = hash('sha256', $password);
        //Run query: Check combinaton of email & password exists
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
        //If email & password don't match print error
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Wrong Username or Password</div>';
}
else {
    //log the user in: Set session variables
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION['user_id']=$row['user_id'];
    $_SESSION['username']=$row['username'];
    $_SESSION['email']=$row['email'];

    if(empty($_POST['rememberme'])){
        //If remember me is not checked
        echo "success";
    }else{
        //Create two variables $authentificator1 and $authentificator2
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        //2*2*...*2
        $f2authentificator2 = openssl_random_pseudo_bytes(20);
        //Store them in a cookie
        function f1($a, $b){
            $c = $a . "," . bin2hex($b);
            return $c;
        }
        $cookieValue = f1($authentificator1, $f2authentificator2);
        setcookie(
            "rememberme",
            $cookieValue,
            time() + 1296000
        );

        //Run query to store them in rememberme table
        function f2($a){
            $b = hash('sha256', $a);
            return $b;
        }
        $f2authentificator2 = f2($f2authentificator2);
        $user_id = $_SESSION['user_id'];
        $expiration = date('Y-m-d H:i:s', time() + 1296000);

        $sql = "INSERT INTO rememberme
        (`authentificator1`, `f2authentificator2`, `user_id`, `expires`)
        VALUES
        ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
        $result = mysqli_query($link, $sql);
        if(!$result){
            echo  '<div class="alert alert-danger">There was an error storing data to remember you next time.</div>';
        }else{
            echo "success";
        }
    }
}
    }
  }
?>
