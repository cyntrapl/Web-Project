<!DOCTYPE html>
<html>
<head>
    <title>Delete Position</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../positions.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Position</h1>
    <table>
        <tr>
            <th>Position Name</th>
            <th>Action</th>
        </tr>

        <?php
        include '../scripts/config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $position_id = $conn->real_escape_string($_POST['position_id']);

            $sql = "DELETE FROM positions WHERE position_id='$position_id'";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Position deleted successfully.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $sql = "SELECT position_id, position_name FROM positions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['position_name'] . "</td><td>";
                echo "<form action='positions_delete.php' method='post' style='display:inline-block;'>";
                echo "<input type='hidden' name='position_id' value='" . $row['position_id'] . "'>";
                echo "<button type='submit' class='delete-button'>Delete</button>";
                echo "</form>";
                echo "</td></tr>";
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
