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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="category">
   <h1 class="title">Food Category</h1>
   <div class="box-container">
      <a href="#" class="box category-link active-category" data-category="rice & kottu">
         <img src="images/cat-1.png" alt="">
         <h3>rice & kottu</h3>
      </a>
      <a href="#" class="box category-link" data-category="pizza">
         <img src="images/cat-2.png" alt="">
         <h3>pizza</h3>
      </a>
      <a href="#" class="box category-link" data-category="burger">
         <img src="images/cat-3.png" alt="">
         <h3>burger</h3>
      </a>
      <a href="#" class="box category-link" data-category="dessert & beverages">
         <img src="images/cat-4.png" alt="">
         <h3>dessert & beverages</h3>
      </a>
   </div>
</section>

<section class="products">
   
   <div class="box-container">
      <p class="empty">Select a category to view products!</p>
   </div>
   <div class="more-btn">
      <a href="menu.html" class="btn">view all</a>
   </div>

      <div class="loader">
   <img src="images/loader.gif" alt="">
</div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

<script>
$(document).ready(function(){
   function loadProducts(category) {
      $.ajax({
         url: 'fetch_products.php',
         type: 'POST',
         data: {category: category},
         dataType: 'json',
         success: function(response){
            var productHtml = '';
            if(response.length > 0){
               response.forEach(function(product){
                  productHtml += `
                  <form action="" method="post" class="box">
                     <input type="hidden" name="pid" value="${product.id}">
                     <input type="hidden" name="name" value="${product.name}">
                     <input type="hidden" name="price" value="${product.price}">
                     <input type="hidden" name="image" value="${product.image}">
                     <a href="quick_view.php?pid=${product.id}" class="fas fa-eye"></a>
                     <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                     <img src="uploaded_img/${product.image}" alt="">
                     <a href="#" class="cat">${product.category}</a>
                     <div class="name">${product.name}</div>
                     <div class="description">${product.description}</div> <!-- Description added here -->
                     <div class="flex">
                        <div class="price"><span>R.S.</span>${product.price}</div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                     </div>
                  </form>`;
               });
            } else {
               productHtml = '<p class="empty">No products found in this category!</p>';
            }
            $('.products .box-container').html(productHtml);
         }
      });
   }

   // Load products for the first category on page load
   var firstCategory = $('.category-link').first().data('category');
   loadProducts(firstCategory);

   $('.category-link').click(function(e){
      e.preventDefault();
      $('.category-link').removeClass('active-category'); 
      $(this).addClass('active-category');
      var category = $(this).data('category');
      loadProducts(category);
   });
});
</script>

</body>
</html>





