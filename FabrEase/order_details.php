<?php 

include('server/connect.php');

if(isset($_POST['order_details']) && isset($_POST['order_id']) ){

    $order_id  = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");

    $stmt->bind_param('i',$order_id);

    $stmt->execute();

    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);


}else{

    header('location: account.php');
    exit;

}

function calculateTotalOrderPrice($order_details){

    $total = 0;
    
    foreach($order_details as $row ){

        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);

    }

    return $total;





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

        <section id="orders" class="orders container my-5 py-5">
                <div class="container mt-5">
                    <h2 class="font-weight-bold text-center">Order Details</h2>
                    <hr class="mx-auto">
                </div>
                <table class="mt-5 pt-5 mx-auto">
                    <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                         
                    </tr>

                <?php foreach($order_details as $row){ ?>

                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="assets/imgs/<?php echo $row['product_image']; ?>"/>
                                    <div>
                                        <p class="mt-3"><?php echo $row['product_name']; ?></p>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span>&#8369;<?php echo $row['product_price']; ?></span>
                            </td>

                            <td>
                                <span><?php echo $row['product_quantity']; ?></span>
                            </td>
                                
                        </tr>

                   <?php } ?>

                
                </table>

                <?php if($order_status == "not paid"){ ?>
                    <form style="float: right;" method="POST" action="payment.php">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                        <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" />
                        <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" />
                        <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Pay Now" />

                    </form>
                <?php } ?>

            </section>




<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>