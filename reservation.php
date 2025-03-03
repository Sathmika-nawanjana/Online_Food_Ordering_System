<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
   exit();
}

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_EMAIL);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $date = $_POST['date'];
   $date = filter_var($date, FILTER_SANITIZE_STRING);
   $time = $_POST['time'];
   $time = filter_var($time, FILTER_SANITIZE_STRING);
   $type = isset($_POST['type']) ? $_POST['type'] : ''; 
   $type = filter_var($type, FILTER_SANITIZE_STRING);
   $guests = $_POST['guests'];
   $guests = filter_var($guests, FILTER_SANITIZE_NUMBER_INT);

   // PHP Validation
   if(empty($name) || empty($email) || empty($number) || empty($date) || empty($time) || empty($type) || empty($guests)) {
      $errors[] = 'Please fill in all fields!';
   } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Invalid email format!';
   } elseif(strlen($number) != 10 || !is_numeric($number)) {
      $errors[] = 'Invalid phone number!';
   } elseif($guests < 1) {
      $errors[] = 'Number of guests must be at least 1!';
   } else {
      $select_reservation = $conn->prepare("SELECT * FROM `reservations` WHERE name = ? AND email = ? AND number = ? AND date = ? AND time = ? AND guests = ?");
      $select_reservation->execute([$name, $email, $number, $date, $time, $guests]);

      if($select_reservation->rowCount() > 0){
         $errors[] = 'You have already reserved a table!';
      } else {
         $insert_reservation = $conn->prepare("INSERT INTO `reservations`(user_id, name, email, number, date, time, type, guests) VALUES(?,?,?,?,?,?,?,?)");
         $insert_reservation->execute([$user_id, $name, $email, $number, $date, $time, $type, $guests]);

         $message[] = 'Table reserved successfully!';
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Table Reservation</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->


<!-- reservation section starts  -->

<section class="reservation">
   <div class="row">

      <div class="image">
         <img src="images/reservation.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>Reserve your Table!</h3>
      <?php
      if(!empty($errors)){
         foreach($errors as $error){
            echo '<p class="error-msg">'.$error.'</p>';
         }
      }
      ?>
         <input type="text" name="name" maxlength="50" class="box" placeholder="Enter your name" >
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Enter your number"  maxlength="10">
         <input type="email" name="email" maxlength="50" class="box" placeholder="Enter your email" >
         <input type="date" name="date" class="box" >
         <input type="time" name="time" class="box" >
         <select name="type" class="box" >
            <option value="" disabled selected>Select type</option>
            <option value="Breakfast">Breakfast</option>
            <option value="Lunch">Lunch</option>
            <option value="Dinner">Dinner</option>
            <option value="Party">Party</option>
         </select>
         <input type="number" name="guests" min="1" maxlength="50" class="box" placeholder="Number of guests" equired>
         <input type="submit" value="Reserve Table" name="send" class="btn">
        <a href="view_reservation.php" class="btn">View Reservation</a>

      </form>

   </div>

</section>

<!-- reservation section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
