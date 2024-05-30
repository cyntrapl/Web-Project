<!DOCTYPE html>
<html>
<head>
    <title>Delete Music Companies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../music_companies.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Music Companies</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['company_id'])) {
            $company_id = $conn->real_escape_string($_POST['company_id']);
            $sql = "DELETE FROM music_companies WHERE company_id='$company_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT company_id, name FROM music_companies";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="music_companies_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Name</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><button type="submit" name="company_id" value="' . $row['company_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No music companies found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
