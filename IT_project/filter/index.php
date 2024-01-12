<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-commerce";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sqlCategories = "SELECT * FROM category";
$resultCategories = $conn->query($sqlCategories);


$categoryFilter = isset($_GET['category']) ? $_GET['category'] : 'all';
$sqlProducts = ($categoryFilter === 'all') ? "SELECT * FROM products" : "SELECT * FROM products WHERE category_id = $categoryFilter";
$resultProducts = $conn->query($sqlProducts);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>eCommerce Product Filter</title>
</head>

<body>

    <div class="container mt-4">



       




        <form action="" method="GET">
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" onchange="this.form.submit()">
                    <option value="all" <?php echo ($categoryFilter === 'all') ? 'selected' : ''; ?>>All Categories</option>
                    <?php
                    while ($row = $resultCategories->fetch_assoc()) {
                        echo '<option value="' . $row['category_id'] . '" ' . (($categoryFilter == $row['category_id']) ? 'selected' : '') . '>'
                            . $row['category_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </form>


        <div class="row">
            <?php
            if ($resultProducts->num_rows > 0) {
                while ($row = $resultProducts->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card">';

                    echo '<img class="card-img-top" style="aspect-ratio:13/14 ;"    " src="' . $row['product_img'] . '" alt="' . $row['product_name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['product_name'] . '</h5>';
                    echo '<p class="card-title fs-bold fs-5">' . $row['price'] . '$' . '</p>';
                    echo '<p class="card-text">' . $row['description'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
    </div>

</body>

</html>

<?php

$conn->close();
?>
