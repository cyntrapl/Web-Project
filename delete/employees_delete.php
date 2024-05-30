<!DOCTYPE html>
<html>
<head>
    <title>Delete Employees</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../employees.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Employees</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['employee_id'])) {
            $employee_id = $conn->real_escape_string($_POST['employee_id']);
            $sql = "DELETE FROM employees WHERE employee_id='$employee_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT employee_id, name FROM employees";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="employees_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Name</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><button type="submit" name="employee_id" value="' . $row['employee_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No employees found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
