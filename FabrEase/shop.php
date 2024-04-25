<?php 

include('server/connect.php');

if(isset($_POST['search'])){

        if(isset($_GET['page_number']) && $_GET['page_number'] != ""){
            $page_number = $_GET['page_number'];
        }else{
            $page_number = 1;
        }
        $category =$_POST['category'];
        $price = $_POST['price'];

        $stmt2 = $conn->prepare("SELECT COUNT(*) As total_records FROM products WHERE product_category=? AND product_price<=?");
        $stmt2->bind_param('si',$category,$price);
        $stmt2->execute();
        $stmt2->bind_result($total_records);
        $stmt2->store_result();
        $stmt2->fetch();

        $total_records_per_page = 8;

        $offset = ($page_number-1) * $total_records_per_page;

        $previous_page = $page_number - 1;
        $next_page = $page_number + 1;

        $adjacent = "2";

        $total_no_of_pages = ceil($total_records/$total_records_per_page);

        $stmt3 = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price=? LIMIT $offset,$total_records_per_page");
        $stmt3->bind_param("si",$category,$price);
        $stmt3->execute();
        $products = $stmt3->get_result();



}else{

    if(isset($_GET['page_number']) && $_GET['page_number'] != ""){
        $page_number = $_GET['page_number'];
    }else{
        $page_number = 1;
    }

    $stmt2 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
    $stmt2->execute();
    $stmt2->bind_result($total_records);
    $stmt2->store_result();
    $stmt2->fetch();

    $total_records_per_page = 8;

    $offset = ($page_number-1) * $total_records_per_page;

    $previous_page = $page_number - 1;
    $next_page = $page_number + 1;

    $adjacent = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    $stmt3 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
    $stmt3->execute();
    $products = $stmt3->get_result();


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
        /* Container styling */
.container {
    margin-top: 50px;
    text-align: center;
}

.container p {
    font-size: 24px;
    margin-bottom: 20px;
}

.container hr {
    border-color: #ccc;
    margin-bottom: 30px;
}

/* Form styling */
form {
    max-width: 600px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 20px;
}

.form-check-label {
    font-size: 16px;
}

.form-range {
    width: 100%;
}

.w-50 {
    margin: 0 auto;
    max-width: 400px;
}

.btn-primary {
    width: 100%;
    max-width: 200px;
    margin: 0 auto;
    display: block;
}

        /* Custom styles for product cards */
.product {
    margin-bottom: 30px;
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    padding: 20px;
}

.product:hover {
    transform: translateY(-5px);
}

.product img {
    width: 100%;
    height: 200px; /* Set the desired fixed height for the image */
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
}

.product .star {
    color: gold;
    margin-bottom: 10px;
}

.product .p-name {
    font-size: 18px;
    margin-bottom: 8px;
}

.product .p-price {
    font-size: 16px;
    color: #333333;
    font-weight: bold;
    margin-bottom: 15px;
}

.product .buy-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: steelblue;
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.product .buy-btn:hover {
    background-color: #004080;
}

/* Pagination styling */
.pagination {
    margin-top: 30px;
    display: flex;
    justify-content: center;
}

.pagination .page-link {
    color: steelblue;
    border-color: steelblue;
}

.pagination .page-link:hover {
    background-color: #f0f0f0;
    color: #004080;
}

.pagination .page-item.active .page-link {
    background-color: steelblue;
    border-color: steelblue;
    color: #ffffff;
}


    </style>

</head>
<body>

<?php include 'components/navigation.php'; ?>

    <section id="search" class="my-5 py-5 ms-2">
    <div class="container mt-5 py-5">
    <p>Search Products</p>
    
</div>

<form action="shop.php" method="POST">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <p>Category</p>
                <div class="form-check">
                    <input class="form-check-input" value="Linen" type="radio" name="category" id="category_one" <?php if(isset($category) && $category=='fabric1'){echo 'checked';} ?>>
                    <label class="form-check-label" for="category_one">
                        Linen
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="nylon" type="radio" name="category" id="category_two" <?php if(isset($category)&& $category=='fabric2'){echo 'checked';} ?>>
                    <label class="form-check-label" for="category_two">
                        Nylon
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="polyester" type="radio" name="category" id="category_three" <?php if(isset($category)&& $category=='fabric3'){echo 'checked';} ?>>
                    <label class="form-check-label" for="category_three">
                        Polyester
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" value="Silk" type="radio" name="category" id="category_four" <?php if(isset($category)&& $category=='fabric4'){echo 'checked';} ?>>
                    <label class="form-check-label" for="category_four">
                        Silk
                    </label>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
    <p>Price</p>
    <input type="range" class="form-range" name="price" value="<?php if(isset($price)){echo $price;}else{echo "100";} ?>" min="1" max="1000" id="customRange2">
    <div class="price-range-indicator">
        <span class="float-start" id="startValue">1</span>
        <span class="float-end" id="endValue">1000</span>
    </div>
</div>

<script>
    // Function to toggle the visibility of the price range indicator
    function togglePriceRange() {
        var indicator = document.querySelector('.price-range-indicator');
        if (indicator.style.display === 'none') {
            indicator.style.display = 'block';
        } else {
            indicator.style.display = 'none';
        }
    }

    // Function to update the value in the float toggle button
    function updateFloatValues() {
        var startValue = document.getElementById('startValue');
        var endValue = document.getElementById('endValue');
        var rangeValue = document.getElementById('customRange2').value;

        startValue.textContent = rangeValue;
        endValue.textContent = rangeValue;
    }

    // Add event listener to the range input
    document.getElementById('customRange2').addEventListener('input', function() {
        // Call the updateFloatValues function when input value changes
        updateFloatValues();
    });

    // Call updateFloatValues initially to set initial values
    updateFloatValues();
</script>

        </div>
    </div>

    <div class="form-group my-3 mx-3">
        <input type="submit" name="search" value="Search" class="btn btn-primary">
    </div>
</form>

    </section>


    <section class="product my-5 py-5">
        <div class="row mx-auto container-fluid">

        <?php while($row = $products->fetch_assoc()) { ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>" />
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    <h5 class="p-name"><?php echo $row['product_name'];?></h5>
                    <h4 class="p-price"><?php echo $row['product_price'];?></h4>
               <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Buy Now</a>
            </div>

        <?php } ?>
       
        

            <nav aria-label="page navigation example">
                <ul class="pagination mt-5">
                    
                    <li class="page-item <?php if($page_number<=1){echo 'disabled';}?>">
                        <a class="page-link" href="<?php if($page_number <= 1){echo '#';}else{echo "?page_number=".$page_number-1;} ?>">Previous</a>
                    </li>

                    <li class="page-item"><a class="page-link" href="?page_number=1">1</a></li>
                    <li class="page-item"><a class="page-link" href="?page_number=2">2</a></li>

                    <?php if($page_number >= 3){?>
                        <li class="page-item"><a class="page-link" href="">...</a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "?page_number".$page_number; ?>"><?php echo $page_number; ?></a></li>
                    <?php } ?>

                    <li class="page-item <?php if($page_number>= $total_no_of_pages){echo 'disabled';}?>">
                        <a class="page-link" href="<?php if($page_number >= $total_no_of_pages){echo '#';}else{echo "?page_number=".$page_number+1;}?>">Next</a>
                    </li>
                </ul>
            </nav> 

        </div>
        
    </section>
            


    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>
