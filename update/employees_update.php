<!DOCTYPE html>
<html>
<head>
    <title>Update Employees</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../employees.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Employees</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT employee_id, name FROM employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Name</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><a href="forms/employees_update_form.php?employee_id=' . $row['employee_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No employees found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
