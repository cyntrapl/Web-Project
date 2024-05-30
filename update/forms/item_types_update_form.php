<!DOCTYPE html>
<html>
<head>
    <title>Update Item Type</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../item_types_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Item Type</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['type_id'])) {
        $type_id = $conn->real_escape_string($_GET['type_id']);
        $sql = "SELECT type FROM item_types WHERE type_id='$type_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $type = $row['type'];
        } else {
            echo "Item type not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type_id = $conn->real_escape_string($_POST['type_id']);
        $type = $conn->real_escape_string($_POST['type']);

        $sql = "UPDATE item_types SET type='$type' WHERE type_id='$type_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Item type updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="item_types_update_form.php" method="post">
        <input type="hidden" name="type_id" value="<?php echo $type_id; ?>">
        <div class="form-group">
            <label for="type">Item Type:</label>
            <input type="text" id="type" name="type" value="<?php echo $type; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
