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
$searchColumns = ['cer_name', 'origin_name'];
$certificates = dbSelect($conn, 'certificates', '*', "cer_name LIKE '%$query%' OR origin_name LIKE '%$query%'");

if ($certificates) {
    echo json_encode(["message" => "Certificate found", "status" => true, "data" => $certificates]);
} else {
    echo json_encode(["message" => "No Certificate found", "status" => false]);
}
?>
