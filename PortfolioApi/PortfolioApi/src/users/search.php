<?php
include '../../config/connection.php'; 
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

if (!isset($_GET['query'])) {
    echo json_encode(["message" => "Missing search query", "status" => false]);
    exit();
}

if (!$conn) {
    die(json_encode(["error" => "Database connection failed"]));
}

$query = mysqli_real_escape_string($conn, $_GET['query']);
$searchColumns = ['first_name', 'last_name', 'email'];
$users = dbSelect($conn, 'users', '*', "first_name LIKE '%$query%' OR last_name LIKE '%$query%' OR email LIKE '%$query%'");

if ($users) {
    echo json_encode(["message" => "Users found", "status" => true, "data" => $users]);
} else {
    echo json_encode(["message" => "No users found", "status" => false]);
}
?>
