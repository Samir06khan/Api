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
if (!isset($data['cer_name'], $data['origin_name'], $data['created_value'], $data['description'], $data['image'])) {
    echo json_encode(["message" => "Missing required fields", "status" => false]);
    exit();
}

$cer_id = $data['cer_id'];
$cer_name = $data['cer_name'];
$origin_name = $data['origin_name'];
$created_value = $data['created_value'];
$description = $data['description'];
$image = $data['image'];

$sql = "UPDATE certificates SET cer_name = '{$cer_name}', origin_name = '{$origin_name}',created_value = '{$created_value}',
        description = '{$description}', image = '{$image}' WHERE cer_id = {$cer_id}" ;

if (mysqli_query($conn, $sql)) {
    echo json_encode(["message" => "User record Updated.", "status" => true]);
} else {
    echo json_encode(["message" => "User record not Updated." . mysqli_error($conn), "status" => false]);
}

mysqli_close($conn);

?>
