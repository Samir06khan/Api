<?php
if (!function_exists('dbInsert')) {
    function dbInsert($conn, $table, $data) {
        $keys = implode(',', array_keys($data));
        $values = implode("','", array_map(fn($val) => mysqli_real_escape_string($conn, $val), array_values($data)));
        $sql = "INSERT INTO $table ($keys) VALUES ('$values')";
        return mysqli_query($conn, $sql);
    }
}

if (!function_exists('dbUpdate')) {
    function dbUpdate($conn, $table, $data, $condition) {
        $set_values = implode(", ", array_map(fn($k, $v) => "$k='" . mysqli_real_escape_string($conn, $v) . "'", array_keys($data), $data));
        return mysqli_query($conn, "UPDATE $table SET $set_values WHERE $condition");
    }
}

if (!function_exists('dbDelete')) {
    function dbDelete($conn, $table, $condition) {
        return mysqli_query($conn, "DELETE FROM $table WHERE $condition") ? ["message" => "Deleted successfully", "status" => true] : ["error" => mysqli_error($conn)];
    }
}

if (!function_exists('dbSelect')) {
    function dbSelect($conn, $table, $columns = "*", $condition = "1") {
        $result = mysqli_query($conn, "SELECT $columns FROM $table WHERE $condition");
        return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
    }
}

if (!function_exists('dbSelectOne')) {
    function dbSelectOne($conn, $table, $columns = "*", $condition) {
        $result = mysqli_query($conn, "SELECT $columns FROM $table WHERE $condition LIMIT 1");
        return $result ? mysqli_fetch_assoc($result) : false;
    }
}
?>
