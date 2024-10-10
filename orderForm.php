<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kween P Sports</title>
    <!-- tailwind css cdn -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="logo1.png" type="image/x-icon">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Red+Hat+Display:wght@500;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
<form class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">

  <div class="mb-4">
    <label for="productName" class="block text-sm font-medium text-gray-700">Name of Product:</label>
    <input type="text" id="productName" name="productName" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
  </div>

  <div class="mb-4">
    <label for="productImage" class="block text-sm font-medium text-gray-700">Product Image URL:</label>
    <input type="url" id="productImage" name="productImage" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
  </div>

  <div class="mb-4">
    <label for="productDescription" class="block text-sm font-medium text-gray-700">Product Description:</label>
    <textarea id="productDescription" name="productDescription" required class="mt-1 block w-full border border-gray-300 rounded-md p-2"></textarea>
  </div>

  <div class="mb-4">
    <label for="productPrice" class="block text-sm font-medium text-gray-700">Product Price:</label>
    <input type="number" id="productPrice" name="productPrice" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
  </div>

  <div class="mb-4">
    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity (max 10):</label>
    <input type="number" id="quantity" name="quantity" min="1" max="10" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" />
  </div>

  <div class="mb-4">
    <span class="block text-sm font-medium text-gray-700">Size:</span>
    <div class="flex space-x-4 mt-2">
      <label class="flex items-center">
        <input type="radio" name="size" value="sm" class="mr-2" /> SM
      </label>
      <label class="flex items-center">
        <input type="radio" name="size" value="m" class="mr-2" /> M
      </label>
      <label class="flex items-center">
        <input type="radio" name="size" value="l" class="mr-2" /> L
      </label>
      <label class="flex items-center">
        <input type="radio" name="size" value="xl" class="mr-2" /> XL
      </label>
      <label class="flex items-center">
        <input type="radio" name="size" value="xxl" class="mr-2" /> XXL
      </label>
    </div>
  </div>

  <div class="mb-4">
    <label class="flex items-center">
      <input type="checkbox" name="terms" required class="mr-2" />
      I agree to the terms and conditions
    </label>
  </div>

  <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600">Buy Now</button>
  <a href="apparelShop.php"><p class="mt-3 w-full bg-red-500 text-white font-bold py-2 text-center rounded hover:bg-blue-600">Cancel</p></a>
</form>

    
</body>
</html>