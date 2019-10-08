<?php
$link = mysqli_connect("localhost", "admin", "monarchs", "onlinebooks");
if(mysqli_connect_error()){
    die('ERROR: Unable to connect:' . mysqli_connect_error());
    // echo "<script>window.alert('Hi!')</script>";
}
    ?>
