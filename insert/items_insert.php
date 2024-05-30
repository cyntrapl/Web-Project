<!DOCTYPE html>
<html>
<head>
    <title>Insert Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../items.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Item</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type_id = $conn->real_escape_string($_POST['type_id']);
        $year = $conn->real_escape_string($_POST['year']);
        $title = $conn->real_escape_string($_POST['title']);
        $artist_id = $conn->real_escape_string($_POST['artist_id']);
        $genre_id = $conn->real_escape_string($_POST['genre_id']);
        $company_id = $conn->real_escape_string($_POST['company_id']);
        $unit_price = $conn->real_escape_string($_POST['unit_price']);

        $sql = "INSERT INTO items (type_id, year, title, artist_id, genre_id, company_id, unit_price) VALUES ('$type_id', '$year', '$title', '$artist_id', '$genre_id', '$company_id', '$unit_price')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Item inserted successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    include '../scripts/generate_options.php';
    ?>

    <form action="items_insert.php" method="post">
        <div class="form-group">
            <label for="type_id">Item Type:</label>
            <select id="type_id" name="type_id" required>
                <option value="" disabled selected>Select an item type</option>
                <?php echo generateOptions("item_types", "type_id", "type"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" required>
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="artist_id">Artist:</label>
            <select id="artist_id" name="artist_id" required>
                <option value="" disabled selected>Select an artist</option>
                <?php echo generateOptions("artists", "artist_id", "name"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="genre_id">Genre:</label>
            <select id="genre_id" name="genre_id" required>
                <option value="" disabled selected>Select a genre</option>
                <?php echo generateOptions("genres", "genre_id", "name"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="company_id">Company:</label>
            <select id="company_id" name="company_id" required>
                <option value="" disabled selected>Select a company</option>
                <?php echo generateOptions("music_companies", "company_id", "name"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="unit_price">Unit Price:</label>
            <input type="text" id="unit_price" name="unit_price" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
