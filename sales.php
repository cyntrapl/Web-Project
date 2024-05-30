<!DOCTYPE html>
<html>
<head>
    <title>Manage Sales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php" class="back-button">Back</a>

<div class="container">
    <h1>Manage Sales</h1>
    <div class="table-buttons">
        <a href="forms/sales_insert.php" class="button">Insert</a>
        <a href="forms/sales_update.php" class="button">Update</a>
        <a href="forms/sales_delete.php" class="button">Delete</a>
    </div>

    <table>
        <tr>
            <th>Sale ID</th>
            <th>Customer</th>
            <th>Employee</th>
            <th>Sale Date</th>
        </tr>

        <?php
        include 'scripts/config.php';

        $sql = "SELECT sales.sale_id, customers.name AS customer_name, employees.name AS employee_name, sales.sale_date
                FROM sales
                JOIN customers ON sales.customer_id = customers.customer_id
                JOIN employees ON sales.employee_id = employees.employee_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['sale_id'] . "</td><td>" . $row['customer_name'] . "</td><td>" . $row['employee_name'] . "</td><td>" . $row['sale_date'] . "</td></tr>";
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
