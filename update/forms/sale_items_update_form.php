<!DOCTYPE html>
<html>
<head>
    <title>Update Sale Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>

<a href="../sale_items_update.php" class="back-button">Back</a>

<div class="container">
    <h1>Update Sale Item</h1>

    <?php
    include '../../scripts/config.php';

    if (isset($_GET['sale_item_id'])) {
        $sale_item_id = $conn->real_escape_string($_GET['sale_item_id']);
        $sql = "SELECT * FROM sale_items WHERE sale_item_id='$sale_item_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sale_id = $row['sale_id'];
            $item_id = $row['item_id'];
            $quantity = $row['quantity'];
        } else {
            echo "Sale item not found.";
            exit();
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sale_item_id = $conn->real_escape_string($_POST['sale_item_id']);
        $sale_id = $conn->real_escape_string($_POST['sale_id']);
        $item_id = $conn->real_escape_string($_POST['item_id']);
        $quantity = $conn->real_escape_string($_POST['quantity']);

        $sql = "UPDATE sale_items SET sale_id='$sale_id', item_id='$item_id', quantity='$quantity' WHERE sale_item_id='$sale_item_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Sale item updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    include '../../scripts/generate_options.php';

    ?>

    <form action="sale_items_update_form.php" method="post">
        <input type="hidden" name="sale_item_id" value="<?php echo $sale_item_id; ?>">
        <div class="form-group">
            <label for="sale_id">Sale:</label>
            <select id="sale_id" name="sale_id" required>
                <?php echo generateOptions("sales", "sale_id", "sale_date", $sale_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="item_id">Item:</label>
            <select id="item_id" name="item_id" required>
                <?php echo generateOptions("items", "item_id", "title", $item_id); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" value="<?php echo $quantity; ?>" required>
        </div>
        <button type="submit" class="button">Update</button>
    </form>

</div>

</body>
</html>
