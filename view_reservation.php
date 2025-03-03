<?php

include 'components/connect.php';
require 'vendor/autoload.php';  // Include Composer's autoload file

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
    
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="viewres">
   <h1 class="title">Your Reservations</h1>

   <div class="box-container">
      <?php
         if($user_id == ''){
            echo '<p class="empty">Please log in first to see your orders.</p>';
         }else{
            $select_reservations = $conn->prepare("SELECT * FROM `reservations` WHERE user_id = ?");
            $select_reservations->execute([$user_id]);
            if($select_reservations->rowCount() > 0){
               while($fetch_reservations = $select_reservations->fetch(PDO::FETCH_ASSOC)){
      ?>

      <div class="box">
          <p>Reference Number : <span>00<?= $fetch_reservations['id']; ?></span></p>
         <p>Name : <span><?= $fetch_reservations['name']; ?></span></p>
         <p>Email : <span><?= $fetch_reservations['email']; ?></span></p>
         <p>Number : <span><?= $fetch_reservations['number']; ?></span></p>
         <p>Date : <span><?= $fetch_reservations['date']; ?></span></p>
         <p>Time : <span><?= $fetch_reservations['time']; ?></span></p>
         <p>Type : <span><?= $fetch_reservations['type']; ?></span></p>
         <p>Guests : <span><?= $fetch_reservations['guests']; ?></span></p>
         <a href="download_res.php?reservation_id=<?= $fetch_reservations['id']; ?>" class="btn">Download PDF</a>
         
      </div>
      <?php
               }
            }else{
               echo '<p class="empty">No reservation yet!</p>';
            }
         }
      ?>
   </div>

</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

