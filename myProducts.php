<?php
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

// Pagination variables
$products_per_page = 5; // Number of products per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $products_per_page;

// Fetch total products for pagination
$total_query = "SELECT COUNT(*) as total FROM products";
$total_result = $db->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $products_per_page);

// Fetch products with pagination
$query = "SELECT id, name, description, price, image_url FROM products LIMIT $products_per_page OFFSET $offset";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Admin Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: orange; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
            <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="adminDashboard.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="userOrder.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                User Orders
            </a>
            <a href="myProducts.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                My Products
            </a>
            <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-align-left mr-3"></i>
                Forms
            </a>
            <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tablet-alt mr-3"></i>
                Tabbed Content
            </a>
            <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-calendar mr-3"></i>
                Calendar
            </a>
        </nav>
        <a href="#" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-arrow-circle-up mr-3"></i>
            Upgrade to Pro!
        </a>
    </aside>

    <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                  
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="blank.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Blank Page
                </a>
                <a href="tables.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-table mr-3"></i>
                    Tables
                </a>
                <a href="forms.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-align-left mr-3"></i>
                    Forms
                </a>
                <a href="tabs.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-tablet-alt mr-3"></i>
                    Tabbed Content
                </a>
                <a href="calendar.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-calendar mr-3"></i>
                    Calendar
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-cogs mr-3"></i>
                    Support
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    My Account
                </a>
                <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Sign Out
                </a>
                <button class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-arrow-circle-up mr-3"></i> Upgrade to Pro!
                </button>
            </nav>
        </header>

        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Tabbed Content</h1>

                <div class="w-full mt-6" x-data="{ openTab: 1 }">
                <div>
                     <!--VIEW PRODUCTS-->
                    <ul class="flex border-b">
                        <li class="-mb-px mr-1" @click="openTab = 1">
                            <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-blue-500 hover:text-blue-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">My Products</a>
                        </li>
                        <!-- CREATE PRODUCTS-->
                        <li class="mr-1" @click="openTab = 2">
                            <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-blue-500 hover:text-blue-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Create Products</a>
                        </li>
                    </ul>
                </div>
                <div >
                    <div x-show="openTab === 1">
                                                            <div class="w-full mt-6">
                                        <p class="text-xl pb-3 flex items-center">
                                            <i class="fas fa-list mr-3"></i> Product List
                                        </p>
                                        <div class="bg-white overflow-auto">
                                            <table class="min-w-full bg-white">
                                                <thead class="bg-gray-800 text-white">
                                                    <tr>
                                                        <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Description</th>
                                                        <th class="w-1/5 text-left py-3 px-4 uppercase font-semibold text-sm">Price</th>
                                                        <th class="w-1/5 text-center  uppercase font-semibold text-sm p-5">Image</th>
                                                        <th class="w-1/5 text-center py-3 px-4 uppercase font-semibold text-sm">Action</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-700">
                                                    <?php if ($result->num_rows > 0): ?>
                                                        <?php while ($row = $result->fetch_assoc()): ?>
                                                            <tr>
                                                                <td class="w-1/3 text-left py-3 px-4"><?php echo htmlspecialchars($row['name']); ?></td>
                                                                <td class="w-1/3 text-left py-3 px-4"><?php echo htmlspecialchars($row['description']); ?></td>
                                                                <td class="text-left py-3 px-4"><?php echo htmlspecialchars($row['price']); ?></td>
                                                                <td class="text-center p-3 ">
                                                                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-40 h-40" download>
                                                                </td>
                                                              <td>
                                                                <div class="md:flex space-x-2">
                                                

                                                                    <a href="updateProduct.php?id=<?php echo $row['id']; ?>">
                                                                        <button class="bg-blue-500 sm:px-4 sm:py-2 rounded">Update</button>
                                                                    </a>
                                                                    <form action="deleteProduct.php" method="POST" class="inline">
                                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                                        <button type="submit" class="bg-red-500 sm:px-4 sm:py-2 rounded">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </td>

                                                            </tr>
                                                        <?php endwhile; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="4" class="text-center py-3">No products found</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <?php
                                    // Close the database connection
                                    $db->close();
                                    ?>
                                    <nav class="flex justify-center mt-4">
            <ul class="flex items-center space-x-2">
                <?php if ($current_page > 1): ?>
                    <li>
                        <a href="?page=<?= $current_page - 1 ?>" class="bg-yellow-600 text-white px-3 py-2 rounded-md">Previous</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li>
                        <a href="?page=<?= $i ?>" class="bg-gray-800 text-white px-3 py-2 rounded-md"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <li>
                        <a href="?page=<?= $current_page + 1 ?>" class="bg-yellow-600 text-white px-3 py-2 rounded-md">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
                    </div>
                   
 


                </div>
                        <div x-show="openTab === 2">
                            <form action="addProduct.php" method="POST" class="space-y-4" enctype="multipart/form-data">
                                <div>
                                    <label class="block text-gray-700">Product Name:</label>
                                    <input type="text" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                                </div>
                                <div>
                                    <label class="block text-gray-700">Description:</label>
                                    <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                </div>
                                <div>
                                    <label class="block text-gray-700">Price:</label>
                                    <input type="number" name="price" step="0.01" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                                </div>
                                <div>
                                    <label class="block text-gray-700">Image Upload (JPEG/PNG):</label>
                                    <input type="file" name="image" accept=".jpeg,.jpg,.png" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                                </div>
                                <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded-md">Add Product</button>
                            </form>
                        </div>

                       
                       
            </main>

          
        </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html> 