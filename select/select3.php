<!DOCTYPE html>
<html>
<head>
    <title>Report 3: Last 5 Sales by Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../select.php" class="back-button">Back</a>

<div class="container">
    <h1>Last 5 Sales by Employee</h1>
    <table>
        <tr>
            <th>Employee</th>
            <th>Sale Date</th>
            <th>Item</th>
        </tr>

        <?php
        include '../scripts/config.php';

        $sql = "SELECT employees.name, sales.sale_date, items.title
                FROM sales
                JOIN sale_items ON sales.sale_id = sale_items.sale_id
                JOIN items ON sale_items.item_id = items.item_id
                JOIN employees ON sales.employee_id = employees.employee_id
                WHERE sales.sale_date >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR)
                ORDER BY sales.sale_date DESC
                LIMIT 5";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['name'] . "</td><td>" . $row['sale_date'] . "</td><td>" . $row['title'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }

        $conn->close();
        ?>

    </table>
</div>

</body>
</html>
