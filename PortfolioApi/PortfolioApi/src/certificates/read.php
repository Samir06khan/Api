<?php // all data fetch  read data
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$certificates = dbSelect($conn, 'certificates');

if ($certificates) {
    echo json_encode(["message" => "Certificates fetched successfully", "status" => true, "data" => $certificates]);
} else {
    echo json_encode(["message" => "No Certificates found", "status" => false]);
}
?>
