<!DOCTYPE html>
<html>
head>
<title>Update Sales</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../sales.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Sales</h1>

    <?php
    include '../scripts/config.php';

    $sql = "SELECT sale_id, sale_date FROM sales";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>Sale Date</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['sale_date'] . '</td>';
            echo '<td><a href="forms/sales_update_form.php?sale_id=' . $row['sale_id'] . '" class="update-button">Update</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No sales found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
