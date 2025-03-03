<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->



<!-- about section starts  -->


<section>
    <div class="terms">
        <span>PRIVACY POLICY</span>
        <h1>Welcome to EMORO Srilanka Online!tion</h1>
        
        
        <P>Welcome to [Emoro Sri Lanka]. Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website [www.emorosrilanka.lk] (the "Emoro"). By accessing or using our Site, you agree to the terms of this Privacy Policy. We may collect information about you through your interactions with our Site, including when you register, place an order, or interact with our services. We are committed to protecting your privacy and ensuring your personal information is handled securely. Please read this Privacy Policy carefully to understand our practices regarding your information and how we will treat it.</p>
    </div>
</section>




<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>