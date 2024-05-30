<!DOCTYPE html>
<html>
<head>
    <title>Update Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../employees_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Employee</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['employee_id'])) {
        $employee_id = $conn->real_escape_string($_GET['employee_id']);
        $sql = "SELECT name, position_id, phone FROM employees WHERE employee_id='$employee_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $position_id = $row['position_id'];
            $phone = $row['phone'];
        } else {
            echo "Employee not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $employee_id = $conn->real_escape_string($_POST['employee_id']);
        $name = $conn->real_escape_string($_POST['name']);
        $position_id = $conn->real_escape_string($_POST['position_id']);
        $phone = $conn->real_escape_string($_POST['phone']);

        $sql = "UPDATE employees SET name='$name', position_id='$position_id', phone='$phone' WHERE employee_id='$employee_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Employee updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    include "../../scripts/generate_options_update.php";
    ?>

    <form action="employees_update_form.php" method="post">
        <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
            <label for="position_id">Position:</label>
            <select id="position_id" name="position_id" required>
                <?php echo generateOptions("positions", "position_id", "position_name", $position_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
