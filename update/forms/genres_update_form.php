<!DOCTYPE html>
<html>
<head>
    <title>Update Genre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../genres_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Genre</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['genre_id'])) {
        $genre_id = $conn->real_escape_string($_GET['genre_id']);
        $sql = "SELECT name FROM genres WHERE genre_id='$genre_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
        } else {
            echo "Genre not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $genre_id = $conn->real_escape_string($_POST['genre_id']);
        $name = $conn->real_escape_string($_POST['name']);

        $sql = "UPDATE genres SET name='$name' WHERE genre_id='$genre_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Genre updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="genres_update_form.php" method="post">
        <input type="hidden" name="genre_id" value="<?php echo $genre_id; ?>">
        <div class="form-group">
            <label for="name">Genre Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
