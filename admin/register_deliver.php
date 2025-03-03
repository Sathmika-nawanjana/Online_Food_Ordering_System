<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit(); 
}

$message = []; // Initialize message array

if(isset($_POST['submit'])){
 
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
   $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']); 
   $cpass = sha1($_POST['cpass']);

   // Check if username already exists
   $select_deliver = $conn->prepare("SELECT * FROM `deliver` WHERE name = ?");
   $select_deliver->execute([$name]);
   
   if($select_deliver->rowCount() > 0){
      $message[] = 'Username already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      }else{
         // Insert new staff into database
         $insert_deliver = $conn->prepare("INSERT INTO `deliver` (name, email, mobile, address, password) VALUES (?, ?, ?, ?, ?)");
         $insert_deliver->execute([$name, $email, $mobile, $address, $cpass]);
         $message[] = 'New deliver registered!';
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
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/deliver_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- register staff section starts  -->

<section class="form-container">

   <form action="" method="POST">
      <h3>Register New deliver</h3>
      <?php
         if (!empty($message) && is_array($message)) { 
            echo '<div class="message">';
            foreach ($message as $msg) {
               echo '<p>' . $msg . '</p>';
            }
            echo '</div>';
         }
      ?>
      <input type="text" name="name" maxlength="20" required placeholder="Enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="email" name="email" required placeholder="Enter email" class="box">
      <input type="tel" name="mobile" pattern="[0-9]{10}" required placeholder="Enter mobile number (10 digits)" class="box">
      <input type="text" name="address" required placeholder="Enter address" class="box">
      <input type="password" name="pass" maxlength="20" required placeholder="Enter password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" maxlength="20" required placeholder="Confirm password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register Now" name="submit" class="btn">
   </form>

</section>

<!-- register staff section ends -->

<!-- custom js file link  -->
<script src="../js/deliver_script.js"></script>

</body>
</html>

