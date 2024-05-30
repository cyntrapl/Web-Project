<!DOCTYPE html>
<html>
<head>
    <title>Manage Genres</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php" class="back-button">Back</a>

<div class="container">
    <h1>Manage Genres</h1>
    <div class="table-buttons">
        <a href="forms/genres_insert.php" class="button">Insert</a>
        <a href="forms/genres_update.php" class="button">Update</a>
        <a href="forms/genres_delete.php" class="button">Delete</a>
    </div>

    <table>
        <tr>
            <th>Genre ID</th>
            <th>Genre Name</th>
        </tr>

        <?php
        include 'scripts/config.php';

        $sql = "SELECT genre_id, name FROM genres";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['genre_id'] . "</td><td>" . $row['name'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
