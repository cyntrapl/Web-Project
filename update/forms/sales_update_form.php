<!DOCTYPE html>
<html>
<head>
    <title>Update Sale</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../sales_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Sale</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['sale_id'])) {
        $sale_id = $conn->real_escape_string($_GET['sale_id']);
        $sql = "SELECT customer_id, employee_id, sale_date FROM sales WHERE sale_id='$sale_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customer_id = $row['customer_id'];
            $employee_id = $row['employee_id'];
            $sale_date = $row['sale_date'];
        } else {
            echo "Sale not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sale_id = $conn->real_escape_string($_POST['sale_id']);
        $customer_id = $conn->real_escape_string($_POST['customer_id']);
        $employee_id = $conn->real_escape_string($_POST['employee_id']);
        $sale_date = $conn->real_escape_string($_POST['sale_date']);

        $sql = "UPDATE sales SET customer_id='$customer_id', employee_id='$employee_id', sale_date='$sale_date' WHERE sale_id='$sale_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Sale updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    include '../../scripts/generate_options.php';

    ?>

    <form action="sales_update_form.php" method="post">
        <input type="hidden" name="sale_id" value="<?php echo $sale_id; ?>">
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select id="customer_id" name="customer_id" required>
                <?php echo generateOptions("customers", "customer_id", "name", $customer_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select id="employee_id" name="employee_id" required>
                <?php echo generateOptions("employees", "employee_id", "name", $employee_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sale_date">Sale Date:</label>
            <input type="date" id="sale_date" name="sale_date" value="<?php echo $sale_date; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
