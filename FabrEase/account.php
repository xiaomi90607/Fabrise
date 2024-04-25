<?php 

session_start();

include('server/connect.php');

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){

        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        header('location: login.php?logout_success=logged out successfully');
        exit;
    }
}

if(isset($_POST['changepassword'])){

    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $user_email = $_SESSION['user_email'];

    if($password !== $confirmpassword){
        header('location: account.php?error=passwords do not match');
    

        }else if(strlen($password) < 6){
            header('location: account.php?error=password must be at least 6 characters');
       

            }else{

                $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ? ");
                $stmt->bind_param('ss',md5($confirmpassword),$user_email);

                if($stmt->execute()){
                    header('location: account.php?password_updated=password has been updated successfully');
                }else{
                    header('location: account.php?error=could not update password, try again later');
                }

            }
}

if(isset($_SESSION['logged_in'])){
   

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ?");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();


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
        #account-form{
            width: 50%;
            margin: 35px auto;
            text-align: center;
            padding: 20px;
        }

        #account-form input{
            margin: 5px auto;
        }

        #account-form #change-pass-btn{
            color: #fff;
            background-color: steelblue;
        }

        .account-info #order-btn,#logout-btn{
            color: steelblue;
            text-decoration: none;
        }

        .orders table{
            width: 100%;
            border-collapse: collapse;
        }

        .orders .order-details-btn{
            color: #fff;
            background-color: steelblue;
        }

        .orders th{
            text-align: left;
            padding: 5px 10px;
            color: #fff;
            background-color: steelblue;
        }

        .orders td{
            padding: 10px 20px;
        }

        .orders td img{
            width: 80px;
            height: 80px;
            margin-right: 10px;
        }
    </style>

</head>
<body>

<?php include 'components/navigation.php'; ?>

    <!--Account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <?php if(isset($_GET['payment_message'])) { ?>
            <p class="mt-5 text-center" style="color:green"><?php echo $_GET['payment_message']; ?></p>
            <?php } ?>

          
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color: green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; }?></p>
            <p class="text-center" style="color: green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; }?></p>
                <h3 class="font-weight-bold">Account Info</h3>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name:<span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name']; } ?></span></p>
                    <p>Email:<span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email']; }?></span></p>
                    <p><a href="#orders" id="order-btn">Your Orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form method="POST" id="account-form" action="account.php">
                <p class="text-center" style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <p class="text-center" style="color: green;"><?php if(isset($_GET['password_updated'])){ echo $_GET['password_updated']; }?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmpassword" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="changepassword" class="btn" id="change-pass-btn">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Orders -->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-2">
            <h2 class="font-weight-bold text-center">Your Order</h2>
            <hr class="mx-auto">
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Order ID</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Details</th>
               
            </tr>

            <?php while($row = $orders->fetch_assoc()){ ?>

                <tr>
                    <td>
                        <span><?php echo $row['order_id']; ?></span>
                    </td>

                    <td>
                        <span>&#8369;<?php echo $row['order_cost']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['order_status']; ?></span>
                    </td>

                    <td>
                        <span><?php echo $row['order_date']; ?></span>
                    </td>

                    <td>
                        <form method="POST" action="order_details.php">
                            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status"/>
                            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id"/>
                            <input class="btn order-details-btn" type="submit" name="order_details" value="check product"/>
                        </form>
                    </td>
                        

                </tr>

            <?php } ?>

           
        </table>

        

    </section>




    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>