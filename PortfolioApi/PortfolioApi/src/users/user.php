<?php // for single data fetch
include '../../config/connection.php';

header('Content-Type: application/json');
header('Access-control-Allow-Origin: *');//access any of page but * use for own webiste access 

$data = json_decode(file_get_contents("php://input"), true);// true gives associate array and php://input gives access any site/devices.
$user_id = intval($data['uid']);//intval for integer

      $sql = "SELECT users.user_id, users.first_name, users.last_name, users.email, roles.role_name 
      FROM users 
      LEFT JOIN roles ON roles.role_id = users.role_id
      WHERE users.user_id = {$user_id}";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

// check single query
if(mysqli_num_rows($result) > 0){
    
 $output = mysqli_fetch_all($result, MYSQLI_ASSOC);// key use  for convert in associate array
 echo json_encode($output);

}else{
   echo json_encode(array('message' =>'No Record Found.', 'status' =>False));

}



?>