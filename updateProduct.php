<?php
session_start();

// Database configuration
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'capstoneloginver2'; 

// Create a connection
$db = new mysqli($host, $username, $password, $database);

// Check the connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if ID is set in URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch product details
    $stmt = $db->prepare("SELECT name, description, price, image_url FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        // Redirect or show an error if no product is found
        $_SESSION['message'] = "Product not found.";
        header("Location: myProducts.php");
        exit();
    }
} else {
    // Redirect if no ID is provided
    $_SESSION['message'] = "Invalid product ID.";
    header("Location: myProducts.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Add Tailwind CSS and other includes here -->
</head>
<body>
    <h1>Update Product</h1>
    <form action="updateProductProcess.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image_url']); ?>">

        
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        
        <label>Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        
        <label>Price:</label>
        <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
        
        <label>Image Upload (JPEG/PNG):</label>
        <input type="file" name="image" accept=".jpeg,.jpg,.png" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
        <p class="mt-2 text-gray-600">Leave this blank if you do not want to change the image.</p>

        
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
