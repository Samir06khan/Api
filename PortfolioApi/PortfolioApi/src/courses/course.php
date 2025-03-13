<?php // single
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

if (!isset($_GET['course_id']) || empty($_GET['course_id'])) {
    echo json_encode(["message" => "Missing or invalid course_id", "status" => false]);
    exit();
}
$course_id = intval($_GET['course_id']);
$condition = "course_id = $course_id";
$courses = dbSelectOne($conn, 'courses', '*', $condition);

if ($courses) {
    echo json_encode(["status" => true, "courses" => $courses]);
} else {
    echo json_encode(["message" => "Courses Not Found", "status" => false]);
}

mysqli_close($conn);
?>
