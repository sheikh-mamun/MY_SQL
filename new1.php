<?php
// Assuming you have established a database connection
$db_host = "localhost";
$db_username = "root";
$db_password = " "; // Provide the correct password here
$db_name = "company";

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $product_name = htmlspecialchars($_POST['product_name']);
    $price = htmlspecialchars($_POST['price']);
    
    // SQL query to insert data into the database (using prepared statement for security)
    $sql = "INSERT INTO high_price_products (name, price) VALUES (?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("si", $product_name, $price); // Assuming 'price' is an integer
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Product Name:</label><br>
        <input type="text" id="product_name" name="name" required><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
