<!DOCTYPE html>
<html>
<head>
    <title>Update Positions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../positions.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Positions</h1>
    <table>
        <tr>
            <th>Position Name</th>
            <th>Action</th>
        </tr>

        <?php
        include '../scripts/config.php';

        $sql = "SELECT position_id, position_name FROM positions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['position_name'] . "</td><td><a href='forms/positions_update_form.php?position_id=" . $row['position_id'] . "' class='update-button'>Update</a></td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No positions found</td></tr>";
        }

        $conn->close();
        ?>

    </table>
</div>

</body>
</html>
