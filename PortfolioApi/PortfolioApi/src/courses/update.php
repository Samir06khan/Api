<?php
include '../../config/connection.php';
include '../../db/functions.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Access-Control-Allow-Methods, Access-Control-Allow-Headers');

$data = json_decode(file_get_contents("php://input"), true);

if ($data === null || !isset($data['course_id'])) {
    echo json_encode(["message" => $data === null ? "Invalid JSON input" : "Missing course_id", "status" => false]);
    exit();
}

$course_id = intval($data['course_id']);
$update_fields = array_filter([
        'course_name'           => $data['course_name'],
        'description'           => $data['description'],
        'instructor'            => $data['instructor'],
        'duration'              => $data['duration'],
        'price'                 => $data['price'],
        'start_date'            => $data['start_date'],
        'end_date'              => $data['end_date'],
        'progress'              => $data['progress'],
        'completion_date'       => $data['completion_date'],
        'completion_percent'    => $data['completion_percent'],
        'course_link'           => $data['course_link'],
        'grade'                 => $data['grade']
    ]);
    

if (empty($update_fields)) {
    echo json_encode(["message" => "No fields provided for update", "status" => false]);
    exit();
}
$transaction = dbUpdate($conn, 'courses', $update_fields, "course_id = $course_id");

echo json_encode(["message" => $transaction ? "Course record updated successfully" : "Course record not updated: " . mysqli_error($conn), "status" => (bool)$transaction]);
?>
