<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
   
   
   if (!isset($_SESSION['first_login'])) {
       $message[] = 'WELCOME TO EMORO';
       $_SESSION['first_login'] = true;  
   }
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" 
 href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<!--home-->
<section class="home" id="home">
<div class "home-text">
	<h1>start your day with delicious Food</h1>
	<p>Starting your day with delicious food is like giving yourself a warm hug from the inside out. Whether it's a perfectly toasted bagel slathered with cream cheese , the simplicity of a satisfying breakfast sets a positive tone for the day ahead. Just a few moments spent enjoying a tasty meal can make all the difference, filling you with energy and contentment to tackle whatever comes your way. So why not treat yourself to a little morning delight and kickstart your day with a smile?</p>
	
  </div>
	<div class="home-img">
	<img src="images/main image.png" alt="">
	</div>
	</section>
  <hr style="height:4px;border-width:50%;color:gray;background-color:gray;margin-top:5rem;margin-bottom:4rem;">




<section class="products">

   <h1 class="title">latest foods</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 4");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="description"><?= $fetch_products['description']; ?></div> 
         <div class="flex">
            <div class="price"><span>R.S.</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.html" class="btn">view all</a>
   </div>


</section>
<hr style="height:4px;border-width:50%;color:gray;background-color:gray;margin-top:5rem;margin-bottom:4rem;">


<!-- Gallery section starts -->
<section class="gallery">

   <h1 class="title">food gallery</h1>

   <div class="gallery-container">
      <!-- Individual gallery items -->
      <div class="gallery-item">
         <img src="images/homefood-1.jpg" alt="Gallery Image 1">
      </div>
      <div class="gallery-item">
         <img src="images/homefood-2.jpg" alt="Gallery Image 2">
      </div>
      <div class="gallery-item">
         <img src="images/homefood-3.jpg" alt="Gallery Image 3">
      </div>
      <div class="gallery-item">
         <img src="images/homefood-4.jpg" alt="Gallery Image 4">
      </div>
      <div class="gallery-item">
         <img src="images/homefood-5.webp" alt="Gallery Image 5">
      </div>
      <div class="gallery-item">
         <img src="images/homefood-6.jpg" alt="Gallery Image 5">
      </div>
      <div class="gallery-item">
         <img src="images/homefood-7.jpg" alt="Gallery Image 5">
      </div>
   </div>

</section>
<!-- Gallery section ends -->


</section>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about.svg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Discover why thousands of food lovers choose Emoro Restaurant for their online ordering needs. With a vast array of restaurants offering cuisines to suit every palate, ordering food has never been easier or more enjoyable. Our streamlined platform ensures a seamless experience from start to finish, allowing you to browse menus, place orders effortlessly, and track deliveries in real-time. Enjoy the convenience of multiple payment options and frequent special offers that make dining with us not only convenient but also cost-effective. Backed by rave reviews from our satisfied customers, we pride ourselves on delivering exceptional service and ensuring your satisfaction with every order. Whether you crave comfort food or exotic dishes, Emoro Restaurant is your go-to destination for delicious meals delivered straight to your doorstep.</p>
         <a href="menu.html" class="btn">our menu</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>choose order</h3>
         
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>fast delivery</h3>
         
      </div>

      <div class="box">
         <img src="images/step-3.png" alt="">
         <h3>enjoy food</h3>
         
      </div>

   </div>

</section>

<!-- steps section ends -->

<!-- reviews section starts  -->

<section class="reviews">

   <h1 class="title">customer's reivews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/pic1.jpg" alt="">
            <p>Emorro blew me away with their exceptional food and cozy atmosphere. A must-visit!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Chirantha Bimsara</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic2.png" alt="">
            <p>Delicious food and friendly service, though a bit noisy. Still, worth a visit for sure!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Maleesha Thathsarani</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/pic3.jpg" alt="">
            <p>Decent food but found it a tad pricey. Good for a casual meal, but not mind-blowing.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Chandima Jayasanka</h3>
         </div>

        
      </div>

      <div class="swiper-pagination"></div>

   </div>

   <div class="loader">
   <img src="images/loader.gif" alt="">
</div>

</section>

<!-- reviews section ends -->

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>
