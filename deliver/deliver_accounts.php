<?php

include '../components/connect.php';

session_start();

$deliver_id = $_SESSION['deliver_id'];

if(!isset($deliver_id)){
   header('location:deliver_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_deliver = $conn->prepare("DELETE FROM `deliver` WHERE id = ?");
   $delete_deliver->execute([$delete_id]);
   header('location:deliver_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>staff accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/deliver_style.css">

</head>
<body>

<?php include '../components/deliver_header.php' ?>

<!-- staff accounts section starts  -->

<section class="accounts">

   <h1 class="heading">deliver account</h1>

   <div class="box-container">



   <?php
      $select_account = $conn->prepare("SELECT * FROM `deliver`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> staff id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['name']; ?></span> </p>

   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no accounts available</p>';
   }
   ?>

   </div>

</section>

<!-- staff accounts section ends -->

<!-- custom js file link  -->
<script src="../js/deliver_script.js"></script>

</body>
</html>
