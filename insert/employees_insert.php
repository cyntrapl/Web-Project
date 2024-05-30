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
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $conn->real_escape_string($_POST['name']);
        $position_id = $conn->real_escape_string($_POST['position_id']);
        $phone = $conn->real_escape_string($_POST['phone']);

        $sql = "INSERT INTO employees (name, position_id, phone) VALUES ('$name', '$position_id', '$phone')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Employee inserted successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    include "../scripts/generate_options.php";
    ?>

    <form action="employees_insert.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="position_id">Position:</label>
            <select id="position_id" name="position_id" required>
                <option value="" disabled selected>Select a position</option>
                <?php echo generateOptions("positions", "position_id", "position_name"); ?>
            </select>
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
