<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>


    <style>
        #contact span{
            color: steelblue;
        }
        /* Styling for Contact section */
#contact {
    background-color: #f9f9f9;
    padding: 80px 0;
}

#contact h3 {
    font-size: 48px;
    margin-bottom: 40px;
    color: #333;
}

#contact hr {
    width: 70px;
    border-top: 2px solid #333;
    margin: 0 auto 30px auto;
}

#contact p {
    font-size: 20px;
    line-height: 1.6;
    margin-bottom: 20px;
}

#contact .w-50 {
    width: 50%;
}

#contact iframe {
    width: 100%;
    height: 500px;
    border: none;
    border-radius: 20px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    margin-top: 40px;
}

/* Creative styling */
#contact .container {
    position: relative;
}

#contact .container:before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 100%;
    background-image: url('https://source.unsplash.com/random');
    background-size: cover;
    background-position: center;
    filter: grayscale(80%);
    z-index: -1;
}

#contact .container .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    padding: 40px;
    box-sizing: border-box;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
}

        
    </style>

</head>
<body>
    
    <?php include 'components/navigation.php'; ?>

    <!-- contact us -->
    <section id="contact" class="container my-5 py-5">
    <div class="container text-center mt-5">
        <h3>Contact Us</h3>
        <hr class="mx-auto">
        <p class="w-50 mx-auto">
            Phone number: <span>+639755428821</span>
        </p>
        <p class="w-50 mx-auto">
            Email Address: <span>berseker124@gmail.com</span>
        </p>
        <p class="w-50 mx-auto">
            24/7 customer service
        </p>
        <!-- Google Maps Embed Code -->
        <iframe
            width="600"
            height="450"
            frameborder="0" style="border:0"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.010001724054!2d122.08931961412047!3d6.930646195001881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32504224e12d28cb%3A0x30c90b8e2dde6a06!2sBougainvillea%20Rd%2C%20Zamboanga%2C%20Zamboanga%20del%20Sur!5e0!3m2!1sen!2sph!4v1649378044976!5m2!1sen!2sph"
            allowfullscreen>
        </iframe>
    </div>
</section>



 
      

    <?php include 'components/footer.php'; ?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/8b4a76ec01.js" crossorigin="anonymous"></script>
</body>
</html>