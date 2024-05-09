<?php
$servername = "localhost";
$database = "Masters";
$user = "root";
$password = "";

$db = mysqli_connect($servername, $user, $password, $database);
if(!$db){
    echo("<script>console.log('gg " . $data . "');</script>");
    die("Connection failed: " . mysqli_connect_error());
    
}
