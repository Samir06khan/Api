<?php //All data fetch read 
include '../../config/connection.php';

header('Content-Type: application/json');
header('Access-control-Allow-Origin: *');//access any of page but * use for own webiste access 


$sql = "SELECT * FROM users
        INNER JOIN roles 
        ON roles.role_id = users.role_id"; 
        

$result = mysqli_query($conn, $sql) or die("SQL Query Failed");

// check single query
if(mysqli_num_rows($result) > 0){
    
 $output = mysqli_fetch_all($result, MYSQLI_ASSOC);// key use  for convert in associate array
 echo json_encode($output);

}else{
   echo json_encode(array('message' =>'No Record Found.', 'status' =>False));

}
?>