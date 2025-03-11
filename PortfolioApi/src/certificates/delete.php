<?php
include '../../config/connection.php';

header('Content-Type: application/json');
header('Access-control-Allow-Origin: *');//access any of page but * use for own webiste access 
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);// true gives associate array and php://input gives access any site/devices.
$cer_id = isset($data['cer_id']) ? intval($data['cer_id']) : 0 ;


$sql = "DELETE FROM certificates WHERE cer_id = {$cer_id}";


// check single query
if(mysqli_query($conn, $sql)){
    echo json_encode(array('message' =>'Delete Certificate Record.', 'status' =>True));

}else{
   echo json_encode(array('message' =>'No Certificate Delete.', 'status' =>False));

}

?>