<!DOCTYPE html>
<html>
<head>
    <title>Report 2: Monthly Turnover</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jetbrains-mono/2.242/jetbrains-mono.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<a href="../select.php" class="back-button">Back</a>

<div class="container">
    <h1>Monthly Turnover</h1>
    <form method="post" action="select2.php">
        <div class="form-group">
            <label for="month">Month:</label>
            <input type="text" id="month" name="month" placeholder="MM" required>
        </div>
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" placeholder="YYYY" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="genre">Genre</option>
                <option value="music_company">Music Company</option>
            </select>
        </div>
        <button type="submit" class="button">Generate Report</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../scripts/config.php';

        $month = $conn->real_escape_string($_POST['month']);
        $year = $conn->real_escape_string($_POST['year']);
        $category = $conn->real_escape_string($_POST['category']);

        if ($category == 'genre') {
            $sql = "SELECT genres.name AS category_name, SUM(items.unit_price * sale_items.quantity) AS turnover
                    FROM sales
                    JOIN sale_items ON sales.sale_id = sale_items.sale_id
                    JOIN items ON sale_items.item_id = items.item_id
                    JOIN genres ON items.genre_id = genres.genre_id
                    WHERE MONTH(sales.sale_date) = '$month' AND YEAR(sales.sale_date) = '$year'
                    GROUP BY genres.name
                    ORDER BY turnover ASC";
        } else {
            $sql = "SELECT music_companies.name AS category_name, SUM(items.unit_price * sale_items.quantity) AS turnover
                    FROM sales
                    JOIN sale_items ON sales.sale_id = sale_items.sale_id
                    JOIN items ON sale_items.item_id = items.item_id
                    JOIN music_companies ON items.company_id = music_companies.company_id
                    WHERE MONTH(sales.sale_date) = '$month' AND YEAR(sales.sale_date) = '$year'
                    GROUP BY music_companies.name
                    ORDER BY turnover ASC";
        }

        $result = $conn->query($sql);

        echo "<table><tr><th>" . ucfirst($category) . "</th><th>Turnover</th></tr>";

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['category_name'] . "</td><td>" . $row['turnover'] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data found</td></tr>";
        }

        echo "</table>";

        $conn->close();
    }
    ?>
</div>

</body>
</html>
