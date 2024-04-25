<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        .container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
}

#login-form {
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 5px;
}

#login-form h2 {
    margin-bottom: 20px;
}

#login-form label {
    display: block;
    margin-bottom: 10px;
}

#login-form input[type="text"],
#login-form input[type="password"] {
    width: 92%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

#login-form button {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#login-form button:hover {
    background-color: #45a049;
}

#login-form p {
    margin-top: 15px;
    text-align: center;
}

#login-form a {
    color: #007bff;
    text-decoration: none;
}

#login-form a:hover {
    text-decoration: underline;
}

    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <section id="login-form">
            <h2>Login</h2>
            <form>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit">Login</button>
            </form>
        </section>
    </div>
</body>
<?php include 'admin-footer.php'; ?>
</html>
