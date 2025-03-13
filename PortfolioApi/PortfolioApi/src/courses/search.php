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
$searchColumns = [ 'course_name' ,'instructor','duration', 'price' ];
$courses = dbSelect($conn, 'courses', '*', "course_name LIKE '%$query%' OR instructor LIKE '%$query%' OR duration LIKE '%$query%' OR price LIKE '%$query%'");

if ($courses) {
    echo json_encode(["message" => "Course Found", "status" => true, "data" => $courses]);
} else {
    echo json_encode(["message" => "No Course found", "status" => false]);
}
?>
