<!DOCTYPE html>
<html>
<head>
    <title>Update Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../items.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Items</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT item_id, title FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Title</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td><a href="forms/items_update_form.php?item_id=' . $row['item_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No items found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
