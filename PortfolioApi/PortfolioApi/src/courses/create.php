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

$requiredFields = [
    'course_name', 'description', 'instructor', 'duration', 'price',
    'start_date', 'end_date', 'progress', 'completion_date',
    'completion_percent', 'course_link', 'grade'
];

$missingFields = array_diff($requiredFields, array_keys($data));

if (!empty($missingFields)) {
    echo json_encode(["message" => "Missing required fields: " . implode(", ", $missingFields), "status" => false]);
    exit();
}
$completion_date = isset($data['completion_date']) && !empty($data['completion_date']) ? $data['completion_date'] : NULL;

$transaction = dbInsert($conn, 'courses', [
    'course_name'           => $data['course_name'],
    'description'           => $data['description'],
    'instructor'            => $data['instructor'],
    'duration'              => $data['duration'],
    'price'                 => $data['price'],
    'start_date'            => $data['start_date'],
    'end_date'              => $data['end_date'],
    'progress'              => $data['progress'],
    'completion_date'       => $completion_date, 
    'completion_percent'    => $data['completion_percent'],
    'course_link'           => $data['course_link'],
    'grade'                 => $data['grade']
]);


if ($transaction) {
    echo json_encode(["message" => "Course Record Inserted.", "status" => true]);
} else {
    echo json_encode(["message" => "Course Record Not Inserted: " . mysqli_error($conn), "status" => false]);
}
?>
