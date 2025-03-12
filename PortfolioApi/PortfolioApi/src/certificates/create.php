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
    exit();
}

if (!isset($data['cer_name'], $data['origin_name'], $data['created_value'], $data['description'], $data['image'])) {
    echo json_encode(["message" => "Missing required fields", "status" => false]);
    exit();
}

$transaction = dbInsert($conn, 'certificates', [
    'cer_name'      => $data['cer_name'],
    'origin_name'   => $data['origin_name'],
    'created_value' => $data['created_value'],
    'description'   => $data['description'],
    'image'         => $data['image']
]);


if ($transaction) {
    echo json_encode(["message" => "Certificate record inserted.", "status" => true]);
    exit();
} else {
    echo json_encode(["message" => "Certificate record not inserted: " . mysqli_error($conn), "status" => false]);
    exit();
}

?>
