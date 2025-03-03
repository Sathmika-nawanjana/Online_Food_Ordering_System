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
        <span>Terms & Conditions</span>
        <h1>Introduction</h1>
        
        <p>Welcome to Emoro Sri Lanka ("we," "our," or "us"). These Terms & Conditions ("Terms") govern your use of our online food ordering platform available at www.emorosrilanka.lk the "Emoro". By accessing or using our Site, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use our Site.</p>
        
        <h1>Use of the Site</h1>

        <p>You must be at least 18 years old to use our Site. By using our Site, you represent that you meet this age requirement.
        You agree to provide accurate, current, and complete information during the registration process and to update such information to keep it accurate, current, and complete.
        You are responsible for maintaining the confidentiality of your account information, including your password, and for all activities that occur under your account.</p>
        
        <h1>Ordering and Payment</h1>
        <p>All orders placed through our Site are subject to acceptance and availability. We reserve the right to refuse any order at our discretion.
        Prices for food items are listed on the Site and are subject to change without notice.
        Payment for orders must be made through the payment methods available on the Site. You agree to pay all charges incurred by you or on your behalf through the Site, at the prices in effect when such charges are incurred.</p>

        <h1>Delivery and Pickup</h1>
        <p>Delivery times are estimated and may vary based on factors such as order volume, traffic, and weather conditions. We will not be liable for any delays in delivery.
        You agree to be available at the delivery address provided at the time of delivery. If you are not available, the delivery may be left at your doorstep or a designated area, and you assume all responsibility for any loss or damage.</p>

        <h1>User Conduct</h1>
        <p>You agree not to use the Site for any unlawful or prohibited purpose, including but not limited to posting or transmitting any harmful, threatening, defamatory, or otherwise objectionable content.
        You agree not to interfere with or disrupt the Site or servers or networks connected to the Site.</p>

        <h1>Intellectual Property</h1>
        <p>All content on the Site, including text, graphics, logos, and images, is the property of Emoro or its licensors and is protected by intellectual property laws.
        You may not use, reproduce, or distribute any content from the Site without our prior written permission.</p>


        <h1>Limitation of Liability</h1>
        <p>To the fullest extent permitted by law, Emoro shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or in connection with your use of the Site.
        Our total liability to you for any claims arising out of or in connection with the Site shall not exceed the amount paid by you for the specific order giving rise to such claim.</p>

        <h1>Changes to Terms</h1>
        <p>We reserve the right to modify or replace these Terms at any time. If we make material changes, we will notify you by posting the revised Terms on the Site. Your continued use of the Site after any such changes constitutes your acceptance of the new Terms.</p>

        <h1>Governing Law</h1>
        <p>These Terms shall be governed by and construed in accordance, without regard to its conflict of law principles.</p>
    </div>
</section>




<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>