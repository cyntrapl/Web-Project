<!DOCTYPE html>
<html>
<head>
    <title>Update Music Companies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../music_companies.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Music Companies</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT company_id, name FROM music_companies";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Name</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><a href="forms/music_companies_update_form.php?company_id=' . $row['company_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No music companies found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
