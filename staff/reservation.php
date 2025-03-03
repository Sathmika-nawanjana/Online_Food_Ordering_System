<?php

include '../components/connect.php';

session_start();

$staff_id = $_SESSION['staff_id'];

if(!isset($staff_id)){
   header('location:staff_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_reservations = $conn->prepare("DELETE FROM `reservations` WHERE id = ?");
   $delete_reservations->execute([$delete_id]);
   header('location:reservation.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>reservation</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/staff_style.css">

</head>
<body>

<?php include '../components/staff_header.php' ?>

<!-- messages section starts  -->

<section class="messages">

   <h1 class="heading">Reservations</h1>

   <div class="box-container">

   <?php
      $select_reservations = $conn->prepare("SELECT * FROM `reservations`");
      $select_reservations->execute();
      if($select_reservations->rowCount() > 0){
         while($fetch_reservations = $select_reservations->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> name : <span><?= $fetch_reservations['name']; ?></span> </p>
      <p> email : <span><?= $fetch_reservations['email']; ?></span> </p>
	   <p> number : <span><?= $fetch_reservations['number']; ?></span> </p>
      <p> date : <span><?= $fetch_reservations['date']; ?></span> </p>
	   <p> time : <span><?= $fetch_reservations['time']; ?></span> </p>
	   <p> type : <span><?= $fetch_reservations['type']; ?></span> </p>
	   <p> guests : <span><?= $fetch_reservations['guests']; ?></span> </p>
      <a href="reservation.php?delete=<?= $fetch_reservations['id']; ?>" class="delete-btn" onclick="return confirm('delete this reservations?');">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no reservations</p>';
      }
   ?>

   </div>

</section>

<!-- messages section ends -->


<!-- custom js file link  -->
<script src="../js/staff_script.js"></script>

</body>
</html>