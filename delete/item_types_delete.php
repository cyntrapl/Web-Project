<!DOCTYPE html>
<html>
<head>
    <title>Delete Item Types</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../item_types.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Item Types</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['type_id'])) {
            $type_id = $conn->real_escape_string($_POST['type_id']);
            $sql = "DELETE FROM item_types WHERE type_id='$type_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT type_id, type FROM item_types";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="item_types_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Type</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['type'] . '</td>';
            echo '<td><button type="submit" name="type_id" value="' . $row['type_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No item types found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
