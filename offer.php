<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
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

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

	<!--offer -->
	
	<section class="promotion">

	<h>Promotions</h>

	</section>>
	<section class="offer swiper" id="offer">
		
		<div class="swiper-wrapper">
      		<div class="swiper-slide conatiner">
			<img src="images/offer-1.jpeg" alt="">
			<div class="offer-text">
				<span></span>
				
				</div>
			</div>
      
			<!-- Box 2 -->
			
			<div class="swiper-slide conatiner">
			<img src="images/offer-2.jpeg" alt="">
			<div class="offer-text">
				<span></span>
				
				</div>
			</div>
			
			<!-- Box 3 -->
			
			<div class="swiper-slide conatiner">
			<img src="images/offer-3.jpeg" alt="">
			<div class="offer-text">
				<span></span>
				
				</div>
			</div>
			
			<!-- Box 4 -->
			
			<div class="swiper-slide conatiner">
			<img src="images/offer-4.webp" alt="">
			<div class="offer-text">
				<span></span>
				
				</div>
			</div>
			
			
    	</div>
    	
    	<div class="swiper-pagination"></div>
	
	</section>


<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>

var Swiper = new Swiper(".offer", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      
    });

</script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>