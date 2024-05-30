<!DOCTYPE html>
<html>
<head>
    <title>Insert Position</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../positions.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Position</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $position_name = $conn->real_escape_string($_POST['position_name']);

        $sql = "INSERT INTO positions (position_name) VALUES ('$position_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Position inserted successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="positions_insert.php" method="post">
        <div class="form-group">
            <label for="position_name">Position Name:</label>
            <input type="text" id="position_name" name="position_name" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
