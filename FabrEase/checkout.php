<?php 

session_start();

if(isset($_SESSION['logged_in'])){
    if(!empty($_SESSION['cart'])){
    }else{
    header('location: index.php');
}
}else{
    header('location: login.php');
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
        #checkout-form .checkout-small-element{
            display: inline-block;
            width: 48%;
            margin: 10px auto;
        }

        #checkout-form .checkout-large-element{
            width: 96%;
        }

        #checkout-form .checkout-btn-container{
            margin: 10px;
            text-align: right;
            margin-right: 40px;
        }

        #checkout-form #checkout-btn{
            color: #fff;
            background-color: steelblue;
        }

    </style>

</head>
<body>
    
    <?php include 'components/navigation.php'; ?>

    <!-- checkout form -->

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Checkout</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="checkout-form" method="POST" action="server/place_order.php">
                <p class="text-center" style="color: red;">
                    <?php if(isset($_GET['message'])){echo $_GET['message'];} ?>
                    <?php if(isset($_GET['message'])){ ?>
                        <a href="login.php" class="btn btn-primary">Login</a>
                    <?php } ?>
                </p>

                <div class="form-group checkout-small-element">
                    <label>Name:</label>
                    <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
                </div>
                <div class="form-group checkout-small-element">
                    <label>Email:</label>
                    <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required />
                </div>
                <div class="form-group checkout-small-element">
                    <label>Phone:</label>
                    <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required />
                </div>
                <div class="form-group checkout-small-element">
                    <label>City:</label>
                    <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required />
                </div>
                <div class="form-group checkout-large-element">
                    <label>Address:</label>
                    <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required />
                </div>
                <div class="form-group checkout-btn-container"> 
                    <p>Total Amount: &#8369; <?php echo $_SESSION['total']; ?></p>   
                    <input type="submit" class="btn" id="checkout-btn" name="place_order"  value="Place Order"/>
                </div>
            </form>
        </div>
    </section>

















    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>