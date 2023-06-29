
<?php

function genID($lastid, $tableName, $columnName, $prefix)
{
    global $conn;
    $generated_id = $prefix . $lastid . date("d") . date("m") . date("y");
    $idExist_result = mysqli_query($conn, "select * from " . $tableName . " where " . $columnName . "='$generated_id'");
    if (mysqli_num_rows($idExist_result) == 0) {
        mysqli_query($conn, "update " . $tableName . " set " . $columnName . "='$generated_id' where " . $tableName . ".id='$lastid'");
    } else {
        genID($lastid, $tableName, $columnName, $prefix);
    }
    return $generated_id;
}




?>