/*<?php 
include '../../config/connection.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow API access from any source

$search_value = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($search_value)) {
   
    $sql = "SELECT * FROM users WHERE first_name LIKE '%$search_value%'";
    $result = mysqli_query($conn, $sql) or die(json_encode(["message" => "SQL Query Failed"]));

    if (mysqli_num_rows($result) > 0) {
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($output);
    } else {
        echo json_encode(["message" => "No Record Found.", "status" => false]);
    }
}
//not work
?>
