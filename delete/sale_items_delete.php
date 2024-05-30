<!DOCTYPE html>
<html>
<head>
    <title>Delete Sale Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../sale_items.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Sale Items</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['sale_item_id'])) {
            $sale_item_id = $conn->real_escape_string($_POST['sale_item_id']);
            $sql = "DELETE FROM sale_items WHERE sale_item_id='$sale_item_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT sale_item_id, sale_id, item_id FROM sale_items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="sale_items_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Sale ID</th><th>Item ID</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['sale_id'] . '</td>';
            echo '<td>' . $row['item_id'] . '</td>';
            echo '<td><button type="submit" name="sale_item_id" value="' . $row['sale_item_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No sale items found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
