<!DOCTYPE html>
<html>
<head>
    <title>Delete Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../items.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Items</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['item_id'])) {
            $item_id = $conn->real_escape_string($_POST['item_id']);
            $sql = "DELETE FROM items WHERE item_id='$item_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT item_id, title FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="items_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Title</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td><button type="submit" name="item_id" value="' . $row['item_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No items found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
