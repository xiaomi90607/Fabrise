<?php 

session_start();

if(isset($_POST['order_pay_btn'])){
   
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];

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
        #paypal-button-container {
        width: 200px; /* Set the width as desired */
        height: 100px; /* Set the height as desired */
        text-align: center; /* Center the content horizontally */
        margin: 0 auto; /* Center the container horizontally */
    }

    </style>

</head>
<body>
    
    <?php include 'components/navigation.php'; ?>

    <!-- payment -->

    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Payment</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">

      <?php  if(isset($_POST['order_status']) && $_POST['order_status'] == "not paid"){?>
                <?php $amount = strval($_POST['order_total_price']); ?>
                <?php $order_id = $_POST['order_id'] ?>
                <p>Total Payment:  &#8369;<?php echo $_POST['order_total_price']; ?></p>
                <!-- <input type="submit" class="btn btn-primary" value="Pay Now" /> -->
                <div id="paypal-button-container"></div>  

            <?php }else if(isset($_SESSION['total']) && $_SESSION['total'] != 0){?>
                <?php $amount = strval($_SESSION['total']); ?>
                <?php $order_id = $_SESSION['order_id'] ?>
                <p>Total payment: &#8369;<?php echo $_SESSION['total']; ?></p>
                <!-- <input type="submit" class="btn btn-primary" value="Pay Now" /> -->
                <div id="paypal-button-container"></div>


            


            <?php }else{ ?>
                <p>You did not order anything</p>

            <?php } ?>

            
            
        </div>
    </section>


    <?php include 'components/footer.php'; ?>

    <!-- Replace the "test" client-id value with your client-id -->
    <script src="https://www.paypal.com/sdk/js?client-id=AU-Sm5l7wXYjkBDCfNIttN1B5sEG0XLmbBrLEnQ-ZiOm5X99xhJ9RK6tQobWkZYFApA0nyBISnxiNl0v&currency=USD"></script>
    <script>
        window.paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?php echo $amount; ?>' // Pass the amount dynamically
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            // Handle successful payment
            console.log(details);
            window.location.href = "server/success_payment.php?order_id="+<?php echo $order_id;?>; // Redirect to success_payment.php with order_id
        });
    },
    onError: function(err) {
        // Handle errors
        console.error(err);
        document.getElementById('error-message').innerText = 'An error occurred during the payment. Please try again later.';
    }
}).render('#paypal-button-container');

    </script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>