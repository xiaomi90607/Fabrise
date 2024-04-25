<?php

session_start();

include('server/connect.php');

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

if(isset($_POST['login-btn'])){

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id,user_name,user_email,user_password FROM users WHERE user_email = ?
                AND user_password = ? LIMIT 1");

    $stmt->bind_param('ss',$email,$password);

    if($stmt->execute()){
        $stmt->bind_result($user_id,$user_name,$user_email,$user_password);
        $stmt->store_result();

        if($stmt->num_rows() == 1){
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['logged_in'] = true;

            header('location: account.php?login_success=logged in successfully');



        }else{

            header('location: login.php?error=could not verify your account');

        }

    }else{

        header('location: login.php?error=something went wrong');

    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>

</head>
<body>

<?php include 'components/navigation.php'; ?>

    <!--Login-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Login</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form method="POST" id="login-form" action="login.php">
                <p style="color: red;" class="text-center"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                <p style="color: green;" class="text-center"><?php if(isset($_GET['logout_success'])){ echo $_GET['logout_success']; } ?></p>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" class="form-control" id="login-email" name="email" placeholder="Type your Email" required />
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Type your Password" required />
                </div>
                <div class="form-group">    
                    <input type="submit" class="btn" id="login-btn" name="login-btn" value="Login"/>
                </div>
                <div class="form-group">    
                    <a id="register-url" class="btn" href="register.php">Don't have account? Register.</a>
                </div>
            </form>
        </div>
    </section>



    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>