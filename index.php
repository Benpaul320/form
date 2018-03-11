<?php
include_once('include/config.php');

if(isset($_POST['submit'])){
  $username = $conn->escape_string($_POST['username']);
  $email = $conn->escape_string($_POST['email']);
  $firstName = $conn->escape_string($_POST['firstName']);
  $lastName = $conn->escape_string($_POST['lastName']);
  $password = $conn->escape_string($_POST['password']);

  if(empty($username) || empty($email) || empty($firstName) || empty($lastName || empty($password))){
    echo "Please fill out the fields";
    exit();
  }else{
    $sql = "SELECT * FROM users WHERE email='$email' AND username='$username' LIMIT 1";
    $query = $conn->query($sql);
    $row= mysqli_num_rows($query);
    if($row > 0){
      echo "Username or Email already used";
      exit();
    }else{
      $hash_pass = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users(username, email, firstname, lastname, password) VALUES ('$username', '$email', '$firstName', '$lastName', '$hash_pass')";
      $query = $conn->query($sql);
      if($query === TRUE){
        header("Location: profile.php");
      }else{
        echo "Error while signing";
        exit();
      }
    }
  }
}

?>

<!doctype html>
<html>
<head>
  <title>
    Registration Form
  </title>
  <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
  <div id="form_wrapper">
    <form action="#" method="POST" id="form">
      <label for="username">Username</label>
      <input type="text" name="username" id="username"/>
      <label for="email">Email</label>
      <input type="email" name="email" id="email"/>
      <label for="firstName">First Name</label>
      <input type="text" name="firstName" id="firstName"/>
      <label for="lastName">Last Name</label>
      <input type="text" name="lastName" id="lastName"/>
      <label for="password">Password </label>
      <input type="password" name="password" id="password"/>
      <input type="submit" name="submit" value="Register"/>
    </form>
  </div>
</body>
</html>
