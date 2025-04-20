<?php
$conn = new mysqli("localhost", "root", "", "demo");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = $_GET['id']; // ❗ Vulnerable: No sanitization
$query = "SELECT * FROM products WHERE id = $product_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["name"] . "</h3>";
        echo "<p>" . $row["description"] . "</p>";
        echo "<p>Price: $" . $row["price"] . "</p><hr>";
    }
} else {
    echo "No product found.";
}
?>
