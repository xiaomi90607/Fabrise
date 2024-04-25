<?php 

session_start();

?>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-bar py-3 fixed-top">
        <div class="container">
        <img class="logo" src="assets/imgs/FavrEase__1_-removebg-preview.png" alt="FabrEase Logo"/>

        <script>
// Get the logo element by its class name
var logo = document.querySelector('.logo');

// Add a click event listener to the logo
logo.addEventListener('click', function() {
    // Navigate to the index.php page
    window.location.href = 'index.php';
});
</script>
          
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="nav-butts collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>

      
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
            
              <li class="icons nav-item">
                <a href="cart.php">
                  <i class="fat fa-solid fa-cart-shopping">
                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){?>
                    <span><?php echo $_SESSION['quantity']; ?></span>
                    <?php } ?>
                  </i></a>
                <a href="account.php"><i class="fat fa-regular fa-user"></i></a>
              </li>

              
              
            </ul>
            
          </div>
        </div>
      </nav>