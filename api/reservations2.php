<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

//include connect.php page for database connection
Include('connect.php');
session_start();


// get the HTTP method, path and body of the request
$date = $_REQUEST['date'];


$booked_slots = array ();
$available_slots = [];

        // To protect MySQL injection (more detail about MySQL injection)
        $mydate = stripslashes($date);
      

        $sql="SELECT timeslots FROM reservations WHERE reservation_date='$mydate'";
        $result=mysql_query($sql);

        while ($row = mysql_fetch_array($result)) {
            array_push($booked_slots, $row[timeslots]);
        }

        $available_slot = 4;
        $endtime = 12;  
            while ($available_slot < $endtime) {

                if (!in_array($available_slot, $booked_slots)){

                        array_push($available_slots, $available_slot);                
                            
                    }
                $available_slot ++;
            }
            
            echo json_encode(['data'=>$available_slots]);
           
        //  print_r($available_slots);
        //    foreach($available_slots as $key => $value) {
        //     echo json_encode($value);
        //     }
  
?>

