<!DOCTYPE html>
<html>
<head>
    <title>Insert Sale Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../sale_items.php" class="back-button">Back</a>

<div class="container">
    <h1>Insert Sale Item</h1>

    <?php
    include '../scripts/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sale_id = $conn->real_escape_string($_POST['sale_id']);
        $item_id = $conn->real_escape_string($_POST['item_id']);
        $quantity = $conn->real_escape_string($_POST['quantity']);

        $sql = "INSERT INTO sale_items (sale_id, item_id, quantity) VALUES ('$sale_id', '$item_id', '$quantity')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    include '../scripts/generate_options.php';
    ?>

    <form action="sale_items_insert.php" method="post">
        <div class="form-group">
            <label for="sale_id">Sale:</label>
            <select id="sale_id" name="sale_id" required>
                <?php echo generateOptions("sales", "sale_id", "sale_id"); // Assuming sales table has a meaningful identifier field ?>
            </select>
        </div>
        <div class="form-group">
            <label for="item_id">Item:</label>
            <select id="item_id" name="item_id" required>
                <?php echo generateOptions("items", "item_id", "title"); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" required>
        </div>
        <button type="submit" class="button">Insert</button>
    </form>

</div>

</body>
</html>
