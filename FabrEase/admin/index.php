<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        /* Header styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        /* Container styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
        }

        /* Section styles */
        section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Heading styles */
        h2 {
            margin-bottom: 10px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        /* Button styles */
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Form styles */
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        /* Navigation styles */
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

            <!-- Display key metrics here -->

                <!-- Graphs or charts go here -->
        
            <!-- Quick links to other sections -->
            <div id="quick-links">
                <a href="orders.php">Orders</a>
                <a href="products.php">Products</a>
                <a href="customers.php">Customers</a>
                <a href="create-product.php">Create Product</a>
                <a href="account.php">Account</a>
                <a href="login.php">Login</a>
                
            </div>
        
        
        <!-- Rest of the sections -->
        
</body>
<?php include 'admin-footer.php'; ?>
</html>
