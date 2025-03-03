
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php"><img src="data:image/jpeg;base64,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" alt="Company Logo" ></a>

      <nav class="navbar">
      <a href="about.php">About</a>
         <a href="menu.php">Menu</a>
         <a href="orders.php">Orders</a>
         <a href="offer.php">Promotions</a>
         <a href="reservation.php">Reservations</a>
         <a href="contact.php">Contact</a>
         <a href="feedback.php">feedback</a>
      </nav>

      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         </div>
         <p class="account">
            
            <a href="register.php">register</a>
         </p> 
         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>


