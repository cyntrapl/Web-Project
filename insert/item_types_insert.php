<!DOCTYPE html>
<html>
<head>
    <title>Insert Item Type</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../item_types.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Item Type</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../scripts/config.php';

        $type = $conn->real_escape_string($_POST['type']);

        $sql = "INSERT INTO item_types (type) VALUES ('$type')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="item_types_insert.php" method="post">
        <div class="form-group">
            <label for="type">Item Type:</label>
            <input type="text" id="type" name="type" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
