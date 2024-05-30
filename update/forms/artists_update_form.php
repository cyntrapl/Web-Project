<!DOCTYPE html>
<html>
<head>
    <title>Update Artist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../artists_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Artist</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['artist_id'])) {
        $artist_id = $conn->real_escape_string($_GET['artist_id']);
        $sql = "SELECT name FROM artists WHERE artist_id='$artist_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
        } else {
            echo "Artist not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $artist_id = $conn->real_escape_string($_POST['artist_id']);
        $name = $conn->real_escape_string($_POST['name']);

        $sql = "UPDATE artists SET name='$name' WHERE artist_id='$artist_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Artist updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="artists_update_form.php" method="post">
        <input type="hidden" name="artist_id" value="<?php echo $artist_id; ?>">
        <div class="form-group">
            <label for="name">Artist Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
