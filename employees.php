<!DOCTYPE html>
<html>
<head>
    <title>Manage Employees</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php" class="back-button">Back</a>

<div class="container">
    <h1>Manage Employees</h1>
    <div class="table-buttons">
        <a href="forms/employees_insert.php" class="button">Insert</a>
        <a href="forms/employees_update.php" class="button">Update</a>
        <a href="forms/employees_delete.php" class="button">Delete</a>
    </div>

    <table>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Position</th>
            <th>Phone</th>
        </tr>

        <?php
        include 'scripts/config.php';

        $sql = "SELECT employees.employee_id, employees.name, positions.position_name, employees.phone 
                FROM employees 
                JOIN positions ON employees.position_id = positions.position_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['employee_id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['position_name'] . "</td><td>" . $row['phone'] . "</td></tr>";
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
