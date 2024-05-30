<!DOCTYPE html>
<html>
<head>
    <title>Insert Sale</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../sales.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Sale</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer_id = $conn->real_escape_string($_POST['customer_id']);
        $employee_id = $conn->real_escape_string($_POST['employee_id']);
        $sale_date = $conn->real_escape_string($_POST['sale_date']);

        $sql = "INSERT INTO sales (customer_id, employee_id, sale_date) VALUES ('$customer_id', '$employee_id', '$sale_date')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    include '../scripts/generate_options.php';
    ?>

    <form action="sales_insert.php" method="post">
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select id="customer_id" name="customer_id" required>
                <?php echo generateOptions("customers", "customer_id", "name"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select id="employee_id" name="employee_id" required>
                <?php echo generateOptions("employees", "employee_id", "name"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="sale_date">Sale Date:</label>
            <input type="date" id="sale_date" name="sale_date" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
