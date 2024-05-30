<!DOCTYPE html>
<html>
<head>
    <title>Update Item Types</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../item_types.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Item Types</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT type_id, type FROM item_types";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Type</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['type'] . '</td>';
            echo '<td><a href="forms/item_types_update_form.php?type_id=' . $row['type_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No item types found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
