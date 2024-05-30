<!DOCTYPE html>
<html>
<head>
    <title>Report 1: Sales by Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../select.php" class="back-button">Back</a>

<div class="container">
    <h1>Sales by Employee</h1>
    <table>
        <tr>
            <th>Employee</th>
            <th>Position</th>
            <th>Number of Sales</th>
        </tr>

        <?php
        include '../scripts/config.php';

        $sql = "SELECT employees.name, positions.position_name, COUNT(sales.sale_id) AS num_sales
                FROM sales
                JOIN employees ON sales.employee_id = employees.employee_id
                JOIN positions ON employees.position_id = positions.position_id
                GROUP BY employees.name, positions.position_name
                ORDER BY num_sales DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['name'] . "</td><td>" . $row['position_name'] . "</td><td>" . $row['num_sales'] . "</td></tr>";
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
