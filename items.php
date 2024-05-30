<!DOCTYPE html>
<html>
<head>
    <title>Manage Items</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php" class="back-button">Back</a>

<div class="container">
    <h1>Manage Items</h1>
    <div class="table-buttons">
        <a href="forms/items_insert.php" class="button">Insert</a>
        <a href="forms/items_update.php" class="button">Update</a>
        <a href="forms/items_delete.php" class="button">Delete</a>
    </div>

    <table>
        <tr>
            <th>Item ID</th>
            <th>Type</th>
            <th>Year</th>
            <th>Title</th>
            <th>Artist</th>
            <th>Genre</th>
            <th>Company</th>
            <th>Unit Price</th>
        </tr>

        <?php
        include 'scripts/config.php';

        $sql = "SELECT items.item_id, item_types.type, items.year, items.title, artists.name AS artist_name, 
                       genres.name AS genre_name, music_companies.name AS company_name, items.unit_price
                FROM items
                JOIN item_types ON items.type_id = item_types.type_id
                JOIN artists ON items.artist_id = artists.artist_id
                JOIN genres ON items.genre_id = genres.genre_id
                JOIN music_companies ON items.company_id = music_companies.company_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['item_id'] . "</td><td>" . $row['type'] . "</td><td>" . $row['year'] . "</td><td>" . $row['title'] . "</td><td>" . $row['artist_name'] . "</td><td>" . $row['genre_name'] . "</td><td>" . $row['company_name'] . "</td><td>" . $row['unit_price'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
