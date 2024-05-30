<!DOCTYPE html>
<html>
<head>
    <title>Report 4: Purchased Items by Customer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../select.php" class="back-button">Back</a>

<div class="container">
    <h1>Purchased Items by Customer</h1>
    <form method="post" action="select4.php">
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select id="customer_id" name="customer_id" required>
                <option value="" disabled selected>Select a customer</option>
                <?php
                include '../scripts/config.php';
                $sql = "SELECT customer_id, name FROM customers";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['customer_id'] . "\">" . $row['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="button">Generate Report</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_id = $conn->real_escape_string($_POST['customer_id']);

        $sql = "SELECT items.title, item_types.type, sales.sale_date
                FROM sales
                JOIN sale_items ON sales.sale_id = sale_items.sale_id
                JOIN items ON sale_items.item_id = items.item_id
                JOIN item_types ON items.type_id = item_types.type_id
                WHERE sales.customer_id = '$customer_id'
                ORDER BY item_types.type, sales.sale_date";

        $result = $conn->query($sql);

        echo "<table><tr><th>Item</th><th>Type</th><th>Sale Date</th></tr>";

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['title'] . "</td><td>" . $row['type'] . "</td><td>" . $row['sale_date'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }

        echo "</table>";

        $conn->close();
    }
    ?>
</div>

</body>
</html>
