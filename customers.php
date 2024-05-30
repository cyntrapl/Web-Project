<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php" class="back-button">Back</a>

<div class="container">
    <h1>Manage Customers</h1>
    <div class="table-buttons">
        <a href="forms/customers_insert.php" class="button">Insert</a>
        <a href="forms/customers_update.php" class="button">Update</a>
        <a href="forms/customers_delete.php" class="button">Delete</a>
    </div>

    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Phone</th>
        </tr>

        <?php
        include 'scripts/config.php';

        $sql = "SELECT customer_id, name, address, phone FROM customers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['customer_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['address'] . "</td><td>" . $row['phone'] . "</td></tr>";
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
