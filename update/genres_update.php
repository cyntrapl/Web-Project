<!DOCTYPE html>
<html>
<head>
    <title>Update Genres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../genres.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Genres</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT genre_id, name FROM genres";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Genre</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><a href="forms/genres_update_form.php?genre_id=' . $row['genre_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No genres found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
