<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

//include connect.php page for database connection
Include('connect.php');

//session_start();
$_POST = json_decode(file_get_contents('php://input'), true);

if(isset($_POST) && !empty($_POST)) {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $contact_number = $_POST['contact_number'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  

  // To protect MySQL injection (more detail about MySQL injection)
  
  $myfirstname = stripslashes($firstname);
  $mylastname = stripslashes($lastname);
  $mycontact_number = stripslashes($contact_number);
  $myemail = stripslashes($email);
  $mypassword = stripslashes($password);

  $myfirstname = mysql_real_escape_string($firstname);
  $mylastname = mysql_real_escape_string($lastname);
  $mycontact_number = mysql_real_escape_string($contact_number);
  $myemail = mysql_real_escape_string($email);
  $mypassword = mysql_real_escape_string($password);

  // Encrypt password using md5
  $encpassword = md5($mypassword);

  // See if that user name is an identical match to another user in the system
    $sql = mysql_query("SELECT user_id FROM users WHERE email='$email' LIMIT 1");
	$userMatch = mysql_num_rows($sql); // count the output amount
    if ($userMatch > 0) {

        ?>
        {
          "success": false,
          "secret": "Sorry you tried to register a duplicate email into the system "
        }
    <?php
    
    }

    // Add this service into the database now
	$sql = mysql_query("INSERT INTO user_info (firstname, lastname, contact_number, email, registration_date) 
    VALUES('$myfirstname','$mylastname', '$mycontact_number','$myemail', CURDATE())") or die (mysql_error());

    // Add sign-in credentials to the database now
    $sql = mysql_query("INSERT INTO users (username, password) 
    VALUES('$myemail', '$encpassword')") or die (mysql_error());

    ?>

    {
    "success": true,
    "message": "valid credentials"
    }
    
    <?php
  
  
}
  ?>
    



