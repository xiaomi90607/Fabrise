<?php

session_start();

include('server/connect.php');

if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}


if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if($password !== $confirmpassword){
        header('location: register.php?error=passwords do not match');
    

        }else if(strlen($password) < 6){
            header('location: register.php?error=password must be at least 6 characters');
       

            }else{

                $stmt = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
                $stmt->bind_param('s',$email);
                $stmt->execute();
                $stmt->bind_result($num_rows);
                $stmt->store_result();
                $stmt->fetch();

                if($num_rows != 0){
                    header('location: register.php?error=email already exists');

                }else{

                    $stmt2 = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) 
                                VALUES (?,?,?); ");

                    $stmt2->bind_param('sss', $name,$email,md5($password));

                    if($stmt2->execute()){
                           $user_id = $stmt2->insert_id;
                           $_SESSION['user_id'] = $user_id;
                           $_SESSION['user_email'] = $email;
                           $_SESSION['user_name'] = $name;
                           $_SESSION['logged_in'] = true;
                           header('location: account.php?register_success=registered successfully');

                    }else{
                        header('location: register.php?error=could not create an account, try again later');
                    }

                }

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
    <style>
        
    </style>

</head>
<body>

<?php include 'components/navigation.php'; ?>

    <!--Login-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form method="POST" id="register-form" action="register.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Pick a Name" required />
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Type your Email" required />
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Type your Password" required />
                </div>
                <div class="form-group">
                    <label>Confirm Password:</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmpassword" placeholder="Confirm Password" required />
                </div>
                <div class="form-group">    
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register"/>
                </div>
                <div class="form-group">    
                    <a id="login-url" class="btn" href="login.php">Do you have an account? Login.</a>
                </div>
            </form>
        </div>
    </section>



    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>