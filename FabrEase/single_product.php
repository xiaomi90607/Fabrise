<?php 

include('server/connect.php');

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");

    $stmt->bind_param("i", $product_id);

    $stmt->execute();
    
    $product = $stmt->get_result();

}else{

    header('location: index.php');
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
        .sm-img-grp{
        display: flex;
        justify-content: space-between;
        }

        .sm-img-col{
        flex-basis: 24%;
        cursor: pointer;
        }

        .single-product input{
        width: 50px;
        height: 40px;
        padding-left: 10px;
        font-size: 16px;
        margin-right: 10px;
        }

        .single-product input:focus{
        outline: none;
        }

        .single-product .buy-btn{
        background-color: steelblue;
        opacity: 1;
        transition: 0.4 all;
        }

        .single-product .buy-btn{
        background-color: steelblue;
        }   
    
    </style>
</head>
<body>
    
    <?php include 'components/navigation.php'; ?>

    <section class="container single-product my-5 pt-5">
        <div class="row mt-5">

        <?php while ($row = $product->fetch_assoc()){  ?>

            
            <div class="col-lg-5 col-md-6 col-sm-12">
                <img class="img-fluid w-100 pb-1" src="assets/imgs/<?php echo $row['product_image']; ?>" id="mainImg"/>
                
            </div>

            

            <div class="col-lg-6 col-md-12 col-sm-12">
                
                <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
                <h2>&#8369;<?php echo $row['product_price']; ?></h2>

                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                    <input type="hidden" name="product_name"  value="<?php echo $row['product_name']; ?>" />
                    <input type="hidden" name="product_price"  value="<?php echo $row['product_price']; ?>" />

                    <input type="number" name="product_quantity" value="1"/>
                    <button class="buy-btn" type="submit" name="add_to_cart">Add to cart</button>
                </form>

                
                <h4 class="mt-5 mb-6">Product Details</h4>
                <span><?php echo $row['product_description']; ?></span>
            </div>

        

        <?php } ?>

        </div>
        
    </section>

      

    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>