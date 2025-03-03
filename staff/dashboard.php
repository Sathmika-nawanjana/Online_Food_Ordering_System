<?php

include '../components/connect.php';

session_start();

$staff_id = $_SESSION['staff_id'];

if(!isset($staff_id)){
   header('location:staff_login.php');
   exit; // Stop further execution after redirection
}
$staff_id = $_SESSION['staff_id'];

// Fetch staff profile data
$select_profile = $conn->prepare("SELECT name FROM staff WHERE id = ?");
$select_profile->execute([$staff_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard - Emoro Restaurant</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="../css/staff_style.css">

</head>
<body>

<?php include '../components/staff_header.php'; ?>

<!-- Staff dashboard section starts -->
<section class="dashboard">
   <marquee class="blink">Emoro Restaurant Dashboard</marquee>

   <div class="box-container">

<!-- Box for displaying welcome message and profile update link -->
   <div class="box">
      <h3>Welcome Emoro Family!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>


         <!-- Box for displaying total completed orders -->
      <div class="box">
         <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT total_price FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['total_price'];
         }
         ?>
         <h3><span>R.S.</span><?= $total_completes; ?><span>/-</span></h3>
         <p>Total Completes</p>
         
      </div>

      <!-- Box for displaying total orders -->
      <div class="box">
         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
         ?>
         <h3><?= $numbers_of_orders; ?></h3>
         <p>Total Orders</p>
         
      </div>



      <!-- Box for displaying total pending orders -->
      <div class="box">
         <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT total_price FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         }
         ?>
         <h3><span>R.S.</span><?= $total_pendings; ?><span>/-</span></h3>
         <p>Total Pendings</p>
         <a href="placed_orders.php" class="btn">See Orders</a>
      </div>


      <!-- Box for displaying total staff accounts -->
      <div class="box">
         <?php
         $select_staff = $conn->prepare("SELECT * FROM `staff`");
         $select_staff->execute();
         $numbers_of_staff = $select_staff->rowCount();
         ?>
         <h3><?= $numbers_of_staff; ?></h3>
         <p>Staff</p>
         <a href="staff_accounts.php" class="btn">See Staff</a>
      </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <p>Messages</p>
      <a href="messages.php" class="btn">see messages</a>
   </div>

    <div class="box">
      <?php
         $select_reservation = $conn->prepare("SELECT * FROM `reservations`");
         $select_reservation->execute();
         $numbers_of_reservation = $select_reservation->rowCount();
      ?>
      <h3><?= $numbers_of_reservation; ?></h3>
      <p>reservation</p>
      <a href="reservation.php" class="btn">see reservation</a>
   </div>



   </div>

</section>
<!-- Staff dashboard section ends -->

<!-- Custom JS -->
<script src="../js/staff_script.js"></script>

</body>
</html>

