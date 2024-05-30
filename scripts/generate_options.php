<?php
function generateOptions($table, $id_field, $name_field) {
    include 'config.php';


    $options = "";
    $sql = "SELECT $id_field, $name_field FROM $table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $options .= "<option value=\"" . $row[$id_field] . "\">" . $row[$name_field] . "</option>";
        }
    }
    return $options;
}
?>