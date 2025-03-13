<?php // all data fetch  read data
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$courses = dbSelect($conn, 'courses');

if ($courses) {
    echo json_encode(["message" => "Courses fetched successfully", "status" => true, "data" => $courses]);
} else {
    echo json_encode(["message" => "No Courses found", "status" => false]);
}
?>
