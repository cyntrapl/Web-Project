<!DOCTYPE html>
<html>
head>
<title>Update Artists</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../artists.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Artists</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT artist_id, name FROM artists";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Name</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><a href="forms/artists_update_form.php?artist_id=' . $row['artist_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No artists found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
