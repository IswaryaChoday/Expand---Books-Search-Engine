<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');
    $user_id = $_SESSION['user_id'];
    $data = $_GET['book_id'];
    // $username =$_SESSION[''];
    $sql = "DELETE FROM savedbooks WHERE id='$data'";
    $result = mysqli_query($link, $sql);
      //echo '<pre>', $total = $query['hits']['total']['value'], '</pre>';
      // $variables['total'] = $total;
        // echo '<pre>', print_r($results), '</pre>';
         //echo '<pre>', print_r($query['hits']['total']['value']), '</pre>';

?>
