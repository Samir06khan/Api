<?php
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null || !isset($data['cer_id'])) {
    echo json_encode(["message" => $data === null ? "Invalid JSON input" : "Missing cer_id", "status" => false]);
    exit();
}

$cer_id = intval($data['cer_id']);
$update_fields = array_filter([
   'cer_name'      => $data['cer_name'],
    'origin_name'   => $data['origin_name'],
    'created_value' => $data['created_value'],
    'description'   => $data['description'],
    'image'         => $data['image']
]);

if (empty($update_fields)) {
    echo json_encode(["message" => "No fields provided for update", "status" => false]);
    exit();
}
$transaction = dbUpdate($conn, 'certificates', $update_fields, "cer_id = $cer_id");

echo json_encode(["message" => $transaction ? "User record updated successfully" : "User record not updated: " . mysqli_error($conn), "status" => (bool)$transaction]);
?>
