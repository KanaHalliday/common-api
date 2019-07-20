<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

//include connect.php page for database connection
 Include('connect.php');

session_start();
$_POST = json_decode(file_get_contents('php://input'), true);

if(isset($_POST) && !empty($_POST)) {
  $username = $_POST['firstname'];
  $password = $_POST['lastname'];

  

  if($username == 'admin' && $password == 'admin') {
    $_SESSION['user'] = 'admin';
    ?>
{
  "success": true,
  "secret": "This is the secret no one knows but the admin"
}
    <?php
  } else {
    ?>
{
  "success": false,
  "message": "Invalid credentials"
}
    <?php
  }
} else {
  //var_dump($_POST)
  ?>
{
  "success": false,
  "message": "Only POST access accepted"
}
  <?php
}
?>

