<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['send'])){

   $msg = $_POST['msg']; // Change from 'massages' to 'msg'
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   // Corrected SQL query
   $select_feedback = $conn->prepare("SELECT * FROM `feedback` WHERE messages = ? AND name = ?");
   $select_feedback->execute([$msg, $name]);

   if($select_feedback->rowCount() > 0){
      $message[] = 'Feedback already sent!';
   }else{
      // Remove feedbackId from the insert as it's auto-increment
      $insert_feedback = $conn->prepare("INSERT INTO `feedback` (messages, name) VALUES (?, ?)");
      $insert_feedback->execute([$msg, $name]);

      $message[] = 'Feedback sent successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->


<!-- contact section starts  -->

<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="Contact Image">
      </div>

      <form action="" method="post">
         <h3>Tell us something!</h3>
         <textarea name="msg" class="box" required placeholder="Enter your message" maxlength="500" cols="30" rows="10"></textarea>
         <input type="text" name="name" maxlength="50" class="box" placeholder="Enter your name" required>
         <input type="submit" value="Send Message" name="send" class="btn">
       
        <a href="view_feedback.php" class="btn">View Feedback</a>
      </form>

   </div>

</section>

<!-- contact section ends -->

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
