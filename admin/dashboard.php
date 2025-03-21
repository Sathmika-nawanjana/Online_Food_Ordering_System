<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

<marquee class="blink" >Emoro Restaurant Dashboard</marquee>

   <div class="box-container">

   <div class="box">
      <h3>Welcome Emoro Family!</h3>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   </div>


      <div class="box">
      <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completes->execute(['completed']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['total_price'];
         }
      ?>
      <h3><span>R.S.</span><?= $total_completes; ?><span>/-</span></h3>
      <p>total completes</p>
      
   </div>

   <div class="box">
      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
      <h3><?= $numbers_of_orders; ?></h3>
      <p>total orders</p>
     
   </div>



   <div class="box">
      <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->execute(['pending']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['total_price'];
         }
      ?>
      <h3><span>R.S.</span><?= $total_pendings; ?><span>/-</span></h3>
      <p>total pendings</p>
      <a href="placed_orders.php" class="btn">see orders</a>
   </div>



   <div class="box">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
      <h3><?= $numbers_of_products; ?></h3>
      <p>products added</p>
      <a href="products.php" class="btn">see products</a>
   </div>

   <div class="box">
      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
      <h3><?= $numbers_of_users; ?></h3>
      <p>users accounts</p>
      <a href="users_accounts.php" class="btn">see users</a>
   </div>

   <div class="box">
      <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
      <h3><?= $numbers_of_admins; ?></h3>
      <p>admins</p>
      <a href="admin_accounts.php" class="btn">see admins</a>
   </div>

   <div class="box">
      <?php
         $select_staff = $conn->prepare("SELECT * FROM `staff`");
         $select_staff->execute();
         $numbers_of_staff = $select_staff->rowCount();
      ?>
      <h3><?= $numbers_of_staff; ?></h3>
      <p>Staff</p>
      <a href="staff_accounts.php" class="btn">see staff</a>
   </div>

      <div class="box">
      <?php
         $select_deliver = $conn->prepare("SELECT * FROM `deliver`");
         $select_deliver->execute();
         $numbers_of_deliver = $select_deliver->rowCount();
      ?>
      <h3><?= $numbers_of_deliver; ?></h3>
      <p>deliver</p>
      <a href="deliver_accounts.php" class="btn">see Deliver</a>
   </div>

   <div class="box">
      <?php
         $select_messages = $conn->prepare("SELECT * FROM `messages`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
      <h3><?= $numbers_of_messages; ?></h3>
      <p>new messages</p>
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
      <a href="admin_reservation.php" class="btn">see reservation</a>
   </div>

      <div class="box">
      <?php
         $select_job_vacancies = $conn->prepare("SELECT * FROM `job_vacancies`");
         $select_job_vacancies->execute();
         $numbers_of_job_vacancies = $select_job_vacancies->rowCount();
      ?>
      <h3><?= $numbers_of_job_vacancies; ?></h3>
      <p>job vacancies</p>
      <a href="job_vacancies.php" class="btn">see Job Vacancies</a>
   </div>

         <div class="box">
      <?php
         $select_job_vacancies = $conn->prepare("SELECT * FROM `job_vacancies`");
         $select_job_vacancies->execute();
         $numbers_of_job_vacancies = $select_job_vacancies->rowCount();
      ?>
      <h3><?= $numbers_of_job_vacancies; ?></h3>
      <p>job application</p>
      <a href="admin_view_application.php" class="btn">see Job Application</a>
   </div>


   </div>

</section>

<!-- admin dashboard section ends -->


<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>