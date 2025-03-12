<?php // single
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

if (!isset($_GET['user_id']) || empty($_GET['user_id'])) {
    echo json_encode(["message" => "Missing or invalid user_id", "status" => false]);
    exit();
}
$user_id = intval($_GET['user_id']);
$condition = "user_id = $user_id";
$user = dbSelectOne($conn, 'users', '*', $condition);

if ($user) {
    echo json_encode(["status" => true, "user" => $user]);
} else {
    echo json_encode(["message" => "User not found", "status" => false]);
}

mysqli_close($conn);
?>
