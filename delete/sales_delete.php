<!DOCTYPE html>
<html>
<head>
    <title>Delete Sales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../sales.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Sales</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['sale_id'])) {
            $sale_id = $conn->real_escape_string($_POST['sale_id']);
            $sql = "DELETE FROM sales WHERE sale_id='$sale_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT sale_id, sale_date FROM sales";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="sales_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Sale Date</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['sale_date'] . '</td>';
            echo '<td><button type="submit" name="sale_id" value="' . $row['sale_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No sales found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
