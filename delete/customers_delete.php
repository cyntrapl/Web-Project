<!DOCTYPE html>
<html>
<head>
    <title>Delete Customers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../customers.php" class="back-button">Back</a>

<div class="container">
    <h1>Delete Customers</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['customer_id'])) {
            $customer_id = $conn->real_escape_string($_POST['customer_id']);
            $sql = "DELETE FROM customers WHERE customer_id='$customer_id'";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $sql = "SELECT customer_id, name FROM customers";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<form action="customers_delete.php" method="post">';
        echo '<table>';
        echo '<tr><th>Name</th><th>Action</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><button type="submit" name="customer_id" value="' . $row['customer_id'] . '" class="delete-button">Delete</button></td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    } else {
        echo 'No customers found.';
    }

    $conn->close();
    ?>

</div>

</body>
</html>
