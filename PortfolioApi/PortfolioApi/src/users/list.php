<?php // all data fetch  read data
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$users = dbSelect($conn, 'users');

if ($users) {
    echo json_encode(["message" => "Users fetched successfully", "status" => true, "data" => $users]);
} else {
    echo json_encode(["message" => "No users found", "status" => false]);
}
?>
