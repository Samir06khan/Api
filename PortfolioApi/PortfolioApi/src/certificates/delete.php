<?php
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null) {
    echo json_encode(["message" => "Invalid JSON input", "status" => false]);
    exit(); // Check if JSON is valid
}

if (!isset($data['cer_id'])) {
    echo json_encode(["message" => "Missing cer_id", "status" => false]);
    exit(); // Check if required fields are provided
}
$cer_id = intval($data['cer_id']);

$transaction = dbDelete($conn, 'certificates', "cer_id = $cer_id");

if ($transaction) {
    echo json_encode(["message" => "Certificate Record Deleted.", "status" => true]);
} else {
    echo json_encode(["message" => "Certificate Record Not Deleted: " . mysqli_error($conn), "status" => false]);
}
?>
