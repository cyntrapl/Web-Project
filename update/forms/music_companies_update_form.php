<!DOCTYPE html>
<html>
<head>
    <title>Update Music Company</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../music_companies_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Music Company</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['company_id'])) {
        $company_id = $conn->real_escape_string($_GET['company_id']);
        $sql = "SELECT name FROM music_companies WHERE company_id='$company_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
        } else {
            echo "Music company not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $company_id = $conn->real_escape_string($_POST['company_id']);
        $name = $conn->real_escape_string($_POST['name']);

        $sql = "UPDATE music_companies SET name='$name' WHERE company_id='$company_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Music company updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="music_companies_update_form.php" method="post">
        <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
        <div class="form-group">
            <label for="name">Company Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
