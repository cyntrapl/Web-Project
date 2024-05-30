<!DOCTYPE html>
<html>
<head>
    <title>Delete Genres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../genres.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Genres</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['genre_id'])) {
            $genre_id = $conn->real_escape_string($_POST['genre_id']);
            $sql = "DELETE FROM genres WHERE genre_id='$genre_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT genre_id, name FROM genres";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="genres_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Genre</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><button type="submit" name="genre_id" value="' . $row['genre_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No genres found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
