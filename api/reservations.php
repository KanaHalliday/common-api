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

    $booked_slots = array ();
    $available_slots = array ();

    if(isset($_POST) && !empty($_POST)) {
        $date = $_POST['date'];

        // To protect MySQL injection (more detail about MySQL injection)
        $mydate = stripslashes($date);

        $sql="SELECT timeslots FROM reservations WHERE reservation_date='$mydate'";
        $result=mysql_query($sql);

        while ($row = mysql_fetch_array($result)) {
            array_push($booked_slots, $row[timeslots]);
        }
        //print_r($booked_slots);
        $available_slot = 6;
        $endtime = 24;  
            while ($available_slot < $endtime) {

                if (!in_array($available_slot, $booked_slots)){

                        array_push($available_slots, $start);
                        //echo ($start);
                        
                            
                    }
                $available_slot ++;
            }
           
          //  print_r($available_slots);

          ?>
        {
          "success": false,
          "secret": "Sorry you tried to register a duplicate email into the system "
        }
    <?php
           
    }
?>

