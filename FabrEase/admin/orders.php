<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Admin Dashboard</title>
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
/* Container styles */
.container {
    max-width: 1200px;
    margin: 20px auto; /* Add some margin for spacing */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

/* Section styles */
#orders {
    margin-bottom: 20px;
}

/* Heading styles */
#orders h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    font-size: 24px; /* Increase font size for better readability */
}

/* Table styles */
#orders table {
    width: 100%;
    border-collapse: collapse;
}

#orders table th,
#orders table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

#orders table th {
    background-color: #f0f0f0;
    text-align: left;
    font-weight: bold; /* Make table headers bold */
}

/* Alternate row background color for better readability */
#orders table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Hover effect on table rows */
#orders table tbody tr:hover {
    background-color: #f0f0f0;
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
    
        <section id="orders">
            <h2>Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <!-- Additional columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Populate rows dynamically with data from backend -->
                </tbody>
            </table>
        </section>
    
</body>
<?php include 'admin-footer.php'; ?>
</html>
