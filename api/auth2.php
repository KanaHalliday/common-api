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
  $username = $_POST['username'];
  $password = $_POST['password'];

  

  // To protect MySQL injection (more detail about MySQL injection)
  $myusername = stripslashes($username);
  $mypassword = stripslashes($password);
  $myusername = mysql_real_escape_string($username);
  $mypassword = mysql_real_escape_string($password);

  $sql="SELECT * FROM Users WHERE user_name='$myusername' and password='$mypassword'";
  $result=mysql_query($sql);

  // Mysql_num_row is counting table row
  $count=mysql_num_rows($result);

  //if($username == 'admin' && $password == 'admin') {
    if($count==1){
    $_SESSION['user'] = $username ;
    ?>
{
  "success": true,
  "secret": "This is the secret no one knows but the admin (logged) "
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

