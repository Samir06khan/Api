<?php
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

if (!isset($_GET['cer_id']) || empty($_GET['cer_id'])) {
    echo json_encode(["message" => "Missing or invalid cer_id", "status" => false]);
    exit();
}
$cer_id = intval($_GET['cer_id']);
$condition = "cer_id = $cer_id";
$certificates = dbSelectOne($conn, 'certificates', '*', $condition);

if ($certificates) {
    echo json_encode(["status" => true, "user" => $certificates]);
} else {
    echo json_encode(["message" => "Certificate Not Found", "status" => false]);
}

mysqli_close($conn);
?>
