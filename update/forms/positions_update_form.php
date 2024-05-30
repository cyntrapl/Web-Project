<!DOCTYPE html>
<html>
<head>
    <title>Update Position</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../positions_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Position</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['position_id'])) {
        $position_id = $conn->real_escape_string($_GET['position_id']);
        $sql = "SELECT position_name FROM positions WHERE position_id='$position_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $position_name = $row['position_name'];
        } else {
            echo "Position not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $position_id = $conn->real_escape_string($_POST['position_id']);
        $position_name = $conn->real_escape_string($_POST['position_name']);

        $sql = "UPDATE positions SET position_name='$position_name' WHERE position_id='$position_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Position updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="positions_update_form.php" method="post">
        <input type="hidden" name="position_id" value="<?php echo $position_id; ?>">
        <div class="form-group">
            <label for="position_name">Position Name:</label>
            <input type="text" id="position_name" name="position_name" value="<?php echo $position_name; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
