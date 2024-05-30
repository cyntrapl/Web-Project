<!DOCTYPE html>
<html>
<head>
    <title>Manage Sale Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php" class="back-button">Back</a>

<div class="container">
    <h1>Manage Sale Items</h1>
    <div class="table-buttons">
        <a href="forms/sale_items_insert.php" class="button">Insert</a>
        <a href="forms/sale_items_update.php" class="button">Update</a>
        <a href="forms/sale_items_delete.php" class="button">Delete</a>
    </div>

    <table>
        <tr>
            <th>Sale Item ID</th>
            <th>Sale ID</th>
            <th>Item ID</th>
            <th>Quantity</th>
        </tr>

        <?php
        include 'scripts/config.php';

        $sql = "SELECT sale_item_id, sale_id, item_id, quantity FROM sale_items";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['sale_item_id'] . "</td><td>" . $row['sale_id'] . "</td><td>" . $row['item_id'] . "</td><td>" . $row['quantity'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
