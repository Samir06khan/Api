<?php // for single data fetch
include '../../config/connection.php';

header('Content-Type: application/json');
header('Access-control-Allow-Origin: *');//access any of page but * use for own webiste access 

$data = json_decode(file_get_contents("php://input"), true);// true gives associate array and php://input gives access any site/devices.
$cer_id = isset($_GET['cer_id']) ? intval($_GET['cer_id']) : 0 ;//intval for integer

      $sql = "SELECT * FROM certificates
              WHERE cer_id = {$cer_id}";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

// check single query
if(mysqli_num_rows($result) > 0){
    
 $output = mysqli_fetch_all($result, MYSQLI_ASSOC);// key use  for convert in associate array
 echo json_encode($output);

}else{
   echo json_encode(array('message' =>'Certificate Not Added .', 'status' =>False));

}

?>