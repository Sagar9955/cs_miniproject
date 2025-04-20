<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "demo";

// Connect to database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the product ID from URL
$product_id = $_GET['id']; // Input from user

// Check if product ID is an integer
if (filter_var($product_id, FILTER_VALIDATE_INT)) {
    // Prepare the SQL query using a placeholder for product_id
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    
    // Bind the product ID to the prepared statement
    $stmt->bind_param("i", $product_id); // "i" for integer type
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row['id'] . "<br>";
            echo "Name: " . $row['name'] . "<br>";
            echo "Price: ₹" . $row['price'] . "<br><br>";
        }
    } else {
        echo "No product found.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Invalid product ID.";
}

// Close the database connection
$conn->close();
?>
