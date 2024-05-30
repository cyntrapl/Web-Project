<!DOCTYPE html>
<html>
<head>
    <title>Insert Genre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../genres.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Genre</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../scripts/config.php';

        $name = $conn->real_escape_string($_POST['name']);

        $sql = "INSERT INTO genres (name) VALUES ('$name')";

        if ($conn->query($sql) === TRUE) {
            echo "New genre inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="genres_insert.php" method="post">
        <div class="form-group">
            <label for="name">Genre Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
