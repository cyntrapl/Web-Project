<!DOCTYPE html>
<html>
<head>
    <title>Update Customer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../customers_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Customer</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['customer_id'])) {
        $customer_id = $conn->real_escape_string($_GET['customer_id']);
        $sql = "SELECT name, address, phone FROM customers WHERE customer_id='$customer_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $address = $row['address'];
            $phone = $row['phone'];
        } else {
            echo "Customer not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_id = $conn->real_escape_string($_POST['customer_id']);
        $name = $conn->real_escape_string($_POST['name']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);

        $sql = "UPDATE customers SET name='$name', address='$address', phone='$phone' WHERE customer_id='$customer_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Customer updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

    <form action="customers_update_form.php" method="post">
        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
        <div class="form-group">
            <label for="name">Customer Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
