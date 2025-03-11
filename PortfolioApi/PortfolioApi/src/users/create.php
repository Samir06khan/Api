<?php
include '../../config/connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    echo json_encode(["message" => "Invalid JSON input", "status" => false]);
    exit();// Check if JSON is valid
}

if (!isset($data['fname'], $data['lname'],$data['email'], $data['password'], $data['access_token'], $data['created_by'])) {
    echo json_encode(["message" => "Missing required fields", "status" => false]);
    exit();// Check if required fields are provided
}


$first_name = $data['fname'];
$last_name = $data['lname'];
$role_id= intval($data['rid']);
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_BCRYPT); 
$access_token = $data['access_token'];
$created_by = intval($data['created_by']);

$check_role_query = "SELECT COUNT(*) AS count FROM roles WHERE role_id = $role_id";
$role_result = mysqli_query($conn, $check_role_query);
$role_row = mysqli_fetch_assoc($role_result);

$sql = "INSERT INTO users (first_name, last_name, role_id, email, password, access_token, created_by) 
        VALUES ('$first_name', '$last_name', '$role_id', '$email', '$password', '$access_token', '$created_by')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["message" => "User record inserted.", "status" => true]);
} else {
    echo json_encode(["message" => "User record not inserted: " . mysqli_error($conn), "status" => false]);
}

mysqli_close($conn);

?>
