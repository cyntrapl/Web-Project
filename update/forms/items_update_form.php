<!DOCTYPE html>
<html>
<head>
    <title>Update Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../items_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Item</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['item_id'])) {
        $item_id = $conn->real_escape_string($_GET['item_id']);
        $sql = "SELECT * FROM items WHERE item_id='$item_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $type_id = $row['type_id'];
            $year = $row['year'];
            $artist_id = $row['artist_id'];
            $genre_id = $row['genre_id'];
            $company_id = $row['company_id'];
            $unit_price = $row['unit_price'];
        } else {
            echo "Item not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $item_id = $conn->real_escape_string($_POST['item_id']);
        $title = $conn->real_escape_string($_POST['title']);
        $type_id = $conn->real_escape_string($_POST['type_id']);
        $year = $conn->real_escape_string($_POST['year']);
        $artist_id = $conn->real_escape_string($_POST['artist_id']);
        $genre_id = $conn->real_escape_string($_POST['genre_id']);
        $company_id = $conn->real_escape_string($_POST['company_id']);
        $unit_price = $conn->real_escape_string($_POST['unit_price']);

        $sql = "UPDATE items SET title='$title', type_id='$type_id', year='$year', artist_id='$artist_id', genre_id='$genre_id', company_id='$company_id', unit_price='$unit_price' WHERE item_id='$item_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Item updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    include '../../scripts/generate_options_update.php';

    ?>

    <form action="items_update_form.php" method="post">
        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>
        </div>
        <div class="form-group">
            <label for="type_id">Item Type:</label>
            <select id="type_id" name="type_id" required>
                <?php echo generateOptions("item_types", "type_id", "type", $type_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" value="<?php echo $year; ?>" required>
        </div>
        <div class="form-group">
            <label for="artist_id">Artist:</label>
            <select id="artist_id" name="artist_id" required>
                <?php echo generateOptions("artists", "artist_id", "name", $artist_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="genre_id">Genre:</label>
            <select id="genre_id" name="genre_id" required>
                <?php echo generateOptions("genres", "genre_id", "name", $genre_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="company_id">Company:</label>
            <select id="company_id" name="company_id" required>
                <?php echo generateOptions("music_companies", "company_id", "name", $company_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="unit_price">Unit Price:</label>
            <input type="text" id="unit_price" name="unit_price" value="<?php echo $unit_price; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
