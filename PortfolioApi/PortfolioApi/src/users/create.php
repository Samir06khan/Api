<?php
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    echo json_encode(["message" => "Invalid JSON input", "status" => false]);
    exit(); // Check if JSON is valid
}

if (!isset($data['fname'], $data['lname'], $data['email'], $data['password'], $data['access_token'], $data['created_by'])) {
    echo json_encode(["message" => "Missing required fields", "status" => false]);
    exit(); // Check if required fields are provided
}

$transaction = dbInsert($conn, 'users', [
    'first_name' => $data['fname'],
    'last_name' => $data['lname'],
    'email' => $data['email'],
    'password' => password_hash($data['password'], PASSWORD_BCRYPT),
    'access_token' => $data['access_token'],
    'created_by' => intval($data['created_by'])
]);

if ($transaction) {
    echo json_encode(["message" => "User record inserted.", "status" => true]);
    exit();
} else {
    echo json_encode(["message" => "User record not inserted: " . mysqli_error($conn), "status" => false]);
    exit();
}

?>
