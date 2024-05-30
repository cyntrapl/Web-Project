<!DOCTYPE html>
<html>
<head>
    <title>Insert Employee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../employees.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Employee</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../scripts/config.php';

        $name = $conn->real_escape_string($_POST['name']);
        $position = $conn->real_escape_string($_POST['position']);
        $phone = $conn->real_escape_string($_POST['phone']);

        $sql = "INSERT INTO employees (name, position, phone) VALUES ('$name', '$position', '$phone')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="employees_insert.php" method="post">
        <div class="form-group">
            <label for="name">Employee Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <input type="text" id="position" name="position" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
