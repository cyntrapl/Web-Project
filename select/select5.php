<!DOCTYPE html>
<html>
<head>
    <title>Report 5: Purchased Items for a Period</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../select.php" class="back-button">Back</a>

<div class="container">
    <h1>Purchased Items for a Period</h1>
    <form method="post" action="select5.php">
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="button">Generate Report</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../scripts/config.php';

        $start_date = $conn->real_escape_string($_POST['start_date']);
        $end_date = $conn->real_escape_string($_POST['end_date']);

        $sql = "SELECT customers.name, items.title, sales.sale_date
                FROM sales
                JOIN sale_items ON sales.sale_id = sale_items.sale_id
                JOIN items ON sale_items.item_id = items.item_id
                JOIN customers ON sales.customer_id = customers.customer_id
                WHERE sales.sale_date BETWEEN '$start_date' AND '$end_date'
                ORDER BY customers.name, sales.sale_date";

        $result = $conn->query($sql);

        echo "<table><tr><th>Customer</th><th>Item</th><th>Sale Date</th></tr>";

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['name'] . "</td><td>" . $row['title'] . "</td><td>" . $row['sale_date'] . "</td></tr>";
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
