<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "account";

$conn = new mysqli($server, $user, $password, $db);
if($conn->connect_error){
  die("Error Connecting to the db");
}else{
//  echo "The connection was made";
}
