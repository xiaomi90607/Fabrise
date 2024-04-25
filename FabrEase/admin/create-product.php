<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product - Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f7f7f7;
    padding: 20px;
}

/* Container styles */
.container {
    max-width: 1200px;
    margin: 0 auto;
    overflow: hidden;
}
.h2{
    text-align: center;
}
/* Section styles */
.container {
    width: 50%;
    margin: 0 auto;
}

#create-product {
    margin-top: 20px;
}

#product-form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

input[type="text"],
textarea,
input[type="number"],
select,
input[type="file"] {
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

#quick-links {
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 5px;
    display: flex; /* Use flexbox to make the links horizontal */
    justify-content: space-between; /* Add space between links */
}

#quick-links a {
    color: #333;
    text-decoration: none;
    padding: 5px 10px;
    margin-bottom: 5px;
}

#quick-links a:hover {
    background-color: #ddd;
    color: #000;
}

    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div id="quick-links">
                <a href="orders.php">Orders</a>
                <a href="products.php">Products</a>
                <a href="customers.php">Customers</a>
                <a href="create-product.php">Create Product</a>
                <a href="account.php">Account</a>
                <a href="login.php">Login</a>
                
            </div>

            <div class="container">
    <section id="create-product">
        <h2 class="h2">Create Product</h2>
        <form id="product-form">
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product-name">

            <label for="product-description">Description:</label>
            <textarea id="product-description" name="product-description"></textarea>

            <label for="product-price">Price:</label>
            <input type="number" id="product-price" name="product-price" step="0.01" min="0">

            <label for="product-category">Category:</label>
            <select id="product-category" name="product-category">
                <option value="electronics">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="books">Books</option>
                <!-- Add more categories as needed -->
            </select>

            <label for="product-image">Product Image:</label>
            <input type="file" id="product-image" name="product-image">

            <button type="submit">Save Product</button>
        </form>
    </section>
</div>

</body>
<?php include 'admin-footer.php'; ?>
</html>
