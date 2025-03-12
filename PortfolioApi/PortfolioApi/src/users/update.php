<?php
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null || !isset($data['user_id'])) {
    echo json_encode(["message" => $data === null ? "Invalid JSON input" : "Missing user_id", "status" => false]);
    exit();
}

$user_id = intval($data['user_id']);
$update_fields = array_filter([
   'first_name' => $data['fname'],
    'last_name' => $data['lname'],
    'email' => $data['email'],
    'password' => password_hash($data['password'], PASSWORD_BCRYPT),
    'access_token' => $data['access_token'],
    'created_by' => intval($data['created_by'])
]);

if (empty($update_fields)) {
    echo json_encode(["message" => "No fields provided for update", "status" => false]);
    exit();
}
$transaction = dbUpdate($conn, 'users', $update_fields, "user_id = $user_id");

echo json_encode(["message" => $transaction ? "User record updated successfully" : "User record not updated: " . mysqli_error($conn), "status" => (bool)$transaction]);
?>
