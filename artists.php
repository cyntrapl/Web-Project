<!DOCTYPE html>
<html>
<head>
    <title>Manage Artists</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php" class="back-button">Back</a>

<div class="container">
    <h1>Manage Artists</h1>
    <div class="table-buttons">
        <a href="forms/artists_insert.php" class="button">Insert</a>
        <a href="forms/artists_update.php" class="button">Update</a>
        <a href="forms/artists_delete.php" class="button">Delete</a>
    </div>

    <table>
        <tr>
            <th>Artist ID</th>
            <th>Artist Name</th>
        </tr>

        <?php
        include 'scripts/config.php';

        $sql = "SELECT artist_id, name FROM artists";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['artist_id'] . "</td><td>" . $row['name'] . "</td></tr>";
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
