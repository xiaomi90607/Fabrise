<?php

session_start();

if(isset($_POST['add_to_cart'])){

        if(isset($_SESSION['cart'])){

            $product_id = $_POST['product_id'];
            
            $products_array_ids = array_column($_SESSION['cart'], $product_id);

            if( !in_array($_POST['product_id'], $products_array_ids)) {

                $product_id = $_POST['product_id'];
            
                $product_array = array(
                                'product_id' => $_POST['product_id'],
                                'product_name' => $_POST['product_name'],
                                'product_price' => $_POST['product_price'],
                                'product_image' => $_POST['product_image'],
                                'product_quantity' => $_POST['product_quantity']
                );

                $_SESSION['cart'][$product_id]= $product_array;

            }else{

                echo '<script>alert("Product was already added to the cart")</script>';
                
            }



        }else{

            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];

            $product_array = array(
                                'product_id' => $product_id,
                                'product_name' => $product_name,
                                'product_price' => $product_price,
                                'product_image' => $product_image,
                                'product_quantity' => $product_quantity
            );

            $_SESSION['cart'][$product_id] = $product_array;
            
            

        }

        calculateTotalCart();

}else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];

    unset($_SESSION['cart'][$product_id]);

    calculateTotalCart();

}else if(isset($_POST['edit_quantity'])){

    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart'][$product_id];


    $product_array['product_quantity'] = $product_quantity;


    $_SESSION['cart'][$product_id] = $product_array;

    calculateTotalCart();

}else{
    //header('location: index.php');

}



function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value){

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;

    }

    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;

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
        .cart table{
        width: 100%;
        border-collapse: collapse;
        }

        .cart .product-info{
        display: flex;
        flex-wrap: wrap;

        }

        .cart th{
        text-align: left;
        padding: 5px 10px;
        color:  #fff;
        background-color: steelblue;
        }

        .cart td{
        padding: 10px 20px;
        }

        .cart td img{
        width: 80px;
        height: 80px;
        margin-right: 10px;
        }

        .cart td input{
            width: 40px;
            height: 30px;
            padding: 5px;
        }

        .cart td a {
            color: steelblue;

        }

        .cart .remove-btn{
            color: steelblue;
            text-decoration: none;
            font-size: 14px;
            background-color: #fff;
            border: none;
            width: 100%;
        }

        .cart .edit-btn{
            color: steelblue;
            text-decoration: none;
            font-size: 15px;
            background-color: #fff;
            border: none;
            
        }

        .cart .product-info p{
            margin: 3px;
        }

        .cart-total{
            display: flex;
            justify-content: flex-end;
        }

        .cart-total table{
            width: 100%;
            max-width: 500px;
            border-top: 3px solid steelblue;
        }

        td:last-child{
            text-align: right;
        }

        th:last-child{
            text-align: right;
        }

        .checkout-container{
            display: flex;
            justify-content: flex-end;
        }

        .checkout-btn{
            background-color: steelblue;
            color: #fff;
        }
    </style>

</head>
<body>
    
    <?php include 'components/navigation.php'; ?>

    <!-- cart -->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>


            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                <img src="assets/imgs/<?php echo $value['product_image']; ?>"/>
                    <div>
                    <p><?php echo $value['product_name']; ?></p>
                    <small><span>P</span><?php echo $value['product_price']; ?></small>
                    <br>
                    <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
                    <input type="submit" name="remove_product" class="remove-btn" value="remove" />
                    </form>
                </div>
            </div>
        </td>

        <td>
           
            <form method="POST" action="cart.php">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" />
            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
            <input type="submit" class="edit-btn" value="edit" name="edit_quantity" />
            </form>
        </td>

        <td>
            <span>P</span>
            <span class="price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
        </td>
    </tr>

    <?php } ?>
          
        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Total</td>
                    <td>P <?php echo $_SESSION['total']; ?></td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <form method="POST" action="checkout.php">
            <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout" />
            </form>
        </div>

    </section>


    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>