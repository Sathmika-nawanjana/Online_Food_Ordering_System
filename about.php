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
    <div class="about">
        <h1>About Emoro Restaurant</h1>
        
        <p>Welcome to Emoro Restaurant, where exceptional dining experiences come to life! We are thrilled to have you as our guest and look forward to sharing our passion for great food and hospitality with you.</p>
        <p>Founded in 2010 by a team of culinary enthusiasts, Emoro Restaurant was established with a clear mission: to offer an extraordinary dining experience through a blend of delectable cuisine, impeccable service, and a warm, inviting atmosphere. Our founders envisioned a place where food lovers could come together to enjoy not only outstanding meals but also a sense of community and comfort.</p>
        <p>At Emoro Restaurant, our menu is a celebration of diverse culinary traditions. Our team of talented chefs brings a wealth of experience and creativity to the table, crafting each dish with meticulous attention to detail. We source only the finest, locally grown ingredients, ensuring that every meal is as fresh and flavorful as possible. From our signature appetizers and entrees to our indulgent desserts, every dish is designed to delight your taste buds and leave you coming back for more.</p>
        <p>We take pride in offering a wide range of options to suit every preference and occasion. Whether you are in the mood for a sumptuous steak, a light and refreshing salad, or a rich and creamy dessert, you will find something to satisfy your cravings. Our menu also features a variety of vegetarian, vegan, and gluten-free options, so everyone can find a meal that fits their dietary needs.</p>
        <p>Our commitment to excellence extends beyond the food we serve. Our team of friendly and professional staff is dedicated to making sure that your dining experience is nothing short of exceptional. From the moment you walk through our doors, you will be greeted with a warm smile and attentive service that aims to exceed your expectations.</p>
        <p>In addition to our regular menu, we offer special events and seasonal promotions to add a touch of excitement to your dining experience. Be sure to check our website or follow us on social media to stay updated on our latest offerings and upcoming events.</p>
        <p>Thank you for choosing Emoro Restaurant. We are honored to have you as our guest and are excited to have the opportunity to serve you. We look forward to creating memorable moments and delicious experiences for you and your loved ones!</p>
        <br>
        <p><span>&copy; 2024 Emoro Restaurant Sri Lanka. All rights reserved</span></p>
        
    </div>
</section>




<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->=



<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>