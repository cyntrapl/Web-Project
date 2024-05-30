<!DOCTYPE html>
<html>
<head>
    <title>Insert Music Company</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../music_companies.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Music Company</h1>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../scripts/config.php';

        $name = $conn->real_escape_string($_POST['name']);

        $sql = "INSERT INTO music_companies (name) VALUES ('$name')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="music_companies_insert.php" method="post">
        <div class="form-group">
            <label for="name">Company Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
