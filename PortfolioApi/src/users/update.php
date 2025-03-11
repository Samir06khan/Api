<?php
include '../../config/connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    echo json_encode(["message" => "Invalid JSON input", "status" => false]);
    exit();// Check if JSON is valid
}

if (!isset($data['fname'], $data['lname'], $data['email'], $data['password'], $data['access_token'], $data['created_by'])) {
    echo json_encode(["message" => "Missing required fields", "status" => false]);
    exit();// Check if required fields are provided
}
$user_id = intval($data['uid']);
$first_name = $data['fname'];
$last_name = $data['lname'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_BCRYPT); 
$access_token = $data['access_token'];
$created_by = intval($data['created_by']);


$sql = "UPDATE users SET first_name='{$first_name}' , last_name='{$last_name}', email='{$email}', password='{$password}',
        access_token='{$access_token}', created_by='{$created_by}' WHERE user_id = {$user_id}"; 

if (mysqli_query($conn, $sql)) {
    echo json_encode(["message" => "User record Updated.", "status" => true]);
} else {
    echo json_encode(["message" => "User record not Updated." . mysqli_error($conn), "status" => false]);
}

mysqli_close($conn);

?>
