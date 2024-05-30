<!DOCTYPE html>
<html>
<head>
    <title>Delete Artists</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../artists.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Artists</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['artist_id'])) {
            $artist_id = $conn->real_escape_string($_POST['artist_id']);
            $sql = "DELETE FROM artists WHERE artist_id='$artist_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT artist_id, name FROM artists";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="artists_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Name</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><button type="submit" name="artist_id" value="' . $row['artist_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No artists found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
