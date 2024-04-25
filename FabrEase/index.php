<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<style>
  #home{
    background-image: url('assets/imgs/background-image.png');
    width: 100%;
    height: 100vh;
    background-size: cover;
    background-position-x: center;
    background-position-y: 80px;
    background-repeat: no-repeat;
    background-attachment: fixed;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#home span{
    color:antiquewhite;
}
/* Styling for Home section */
#home {
    background-image: url('assets/imgs/background-image.png');
    background-size: cover;
    background-position: center;
    padding: 150px 0;
    color: #fff;
    text-align: center;
}

#home .container {
    position: relative;
    z-index: 1; /* Ensure content appears above background image */
}

#home h1 {
    font-size: 72px;
    margin-bottom: 20px;
}

#home p {
    font-size: 24px;
    margin-bottom: 40px;
}

#home button {
    font-size: 24px;
    padding: 15px 30px;
    background-color: #ff6b6b;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#home button:hover {
    background-color: #e64c4c;
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

#home .container {
    animation: fadeIn 1s ease;
}
#featured {
  background-color: #f5f5f5;
  padding-top: 80px;
}

#featured h3 {
  font-size: 32px;
  color: #333;
}

#featured hr {
  width: 50px;
  border-top: 2px solid #5cb85c;
  margin: 20px auto;
}

.product-card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 30px;
  padding: 20px;
  transition: transform 0.3s ease-in-out;
}

.product-card:hover {
  transform: translateY(-5px);
}

.product-image img {
  width: 100%;
  border-radius: 10px;
}

.star-rating {
  color: #f39c12;
  margin-bottom: 10px;
}

.product-name {
  font-size: 18px;
  color: #333;
}

.product-price {
  font-size: 20px;
  color: #5cb85c;
}

.buy-now-btn {
  display: inline-block;
  background-color: #3498db;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  margin-top: 10px;
  transition: background-color 0.3s ease-in-out;
}

.buy-now-btn:hover {
  background-color: #2980b9;
}
#about {
  background-color: #f0f8ff; /* Sky blue background */
  padding-top: 80px;
}

#about h3 {
  font-size: 32px;
  color: #333;
}

#about hr {
  width: 50px;
  border-top: 2px solid #5cb85c; /* Green accent */
  margin: 20px auto;
}

.about-content {
  max-width: 800px;
  margin: 0 auto;
}

.about-content p {
  font-size: 18px;
  color: #555;
  line-height: 1.6;
  margin-bottom: 30px;
}


</style>

</head>
<body>
    
    <?php include 'components/navigation.php'; ?>

      <!--Home-->
      <section id="home" class="my-5 pb5">
        <div class="container text-center mt-5 py-5">
          <span class="mx-auto">
          <h1>FabrEase</h1>
          <p>Elevating Excellence, One Fabric at a Time.</p>
          </span>
          <a class="nav-link" href="shop.php"><button class="mx-auto" >Shop Now</button></a>
        </div>
      </section> 
    



      <!-- Featured -->
      <section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Discover Our Featured Fabrics</h3>
    <hr class="mx-auto">
  </div>
  <div class="row mx-auto container-fluid">
    <?php include('server/get_product.php'); ?>
    <?php while($row= $get_product->fetch_assoc()){ ?>
    <div class="product-card col-lg-3 col-md-4 col-sm-12">
      <div class="product-image">
        <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>" class="img-fluid" style="width: 250px; height: 250px;">
      </div>
      <div class="product-details">
        <div class="star-rating">
          <?php for($i = 0; $i < 5; $i++) { ?>
            <i class="fas fa-star"></i>
          <?php } ?>
        </div>
        <h5 class="product-name"><?php echo $row['product_name']; ?></h5>
        <h4 class="product-price">P <?php echo $row['product_price']; ?></h4>
        <a href="<?php echo "single_product.php?product_id=". $row['product_id']?>" class="buy-now-btn">Buy Now</a>
      </div>
    </div>
    <?php }?>
  </div>   
</section>



<section id="about" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>About FabrEase</h3>
    <hr class="mx-auto">
    <div class="about-content">
      <p>FabrEase isn't just another fabric store. We're a creative hub where dreams weave into reality. Since our inception in 2024, we've been more than just a supplier; we're your trusted partner in the world of textiles. Our journey began with a passion for quality fabrics, and today, it's evolved into a commitment to innovation and sustainability.</p>
      <p>At FabrEase, we're redefining the fabric industry by offering not just products, but experiences. Our curated selection of premium materials isn't just meant to be sewn; they're meant to be crafted into masterpieces. Whether you're a fashion designer pushing boundaries, an interior decorator seeking elegance, or a technologist revolutionizing industries, FabrEase is here to fuel your imagination.</p>
      <p>Our mission goes beyond delivering fabrics; it's about inspiring creativity and empowering individuals to bring their visions to life. With a dedication to excellence and a touch of artistic flair, we invite you to join us on this journey of innovation, sustainability, and endless possibilities.</p>
    </div>
  </div>      
</section>


      

    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
    
</body>
</html>