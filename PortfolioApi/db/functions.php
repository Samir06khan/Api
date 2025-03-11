<?php
if (!function_exists('dbInsert')) {
    function  dbInsert($connection, $table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = implode("','", array_values($data));

        $sql = "INSERT INTO $table ($keys) VALUES ('$values')";
        if (mysqli_query($connection, $sql)) {
            return true;
        }

        return false;
    }
}