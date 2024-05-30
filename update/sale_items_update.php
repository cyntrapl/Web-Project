<!DOCTYPE html>
<html>
head>
<title>Update Sale Items</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../sale_items.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Sale Items</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT sale_item_id, sale_id, item_id FROM sale_items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Sale ID</th><th>Item ID</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['sale_id'] . '</td>';
            echo '<td>' . $row['item_id'] . '</td>';
            echo '<td><a href="forms/sale_items_update_form.php?sale_item_id=' . $row['sale_item_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No sale items found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
