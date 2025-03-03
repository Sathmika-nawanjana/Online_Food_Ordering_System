<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Feedback</title>
    
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<section class="view-feedback">
   <h1 class="title">Your Feedback</h1>

   <div class="box-container">
      <?php
         if (empty($user_id)) {
            echo '<p class="empty">Please log in first to see your feedback.</p>';
         } else {
            try {
                $select_feedback = $conn->prepare("SELECT * FROM `feedback` WHERE user_id = ?");
                $select_feedback->execute([$user_id]);

                if ($select_feedback->rowCount() > 0) { // Changed > 1 to > 0
                   while ($fetch_feedback = $select_feedback->fetch(PDO::FETCH_ASSOC)) {
      ?>

      <div class="box">
         <p>Feedback : <span><?= htmlspecialchars($fetch_feedback['messages']); ?></span></p>
         <p>Name : <span><?= htmlspecialchars($fetch_feedback['name']); ?></span></p>
      </div>

      <?php
                   } // Close the while loop
                } else {
                    echo '<p class="empty">No feedback found.</p>';
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
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

