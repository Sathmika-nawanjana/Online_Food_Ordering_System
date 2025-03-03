<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Job Vacancies</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<?php include 'components/user_header.php'; ?>


<!-- show job vacancies section starts  -->

<section class="show-vacancies">

   <div class="box-container">

   <?php
      $show_vacancies = $conn->prepare("SELECT * FROM `job_vacancies`");
      $show_vacancies->execute();
      if ($show_vacancies->rowCount() > 0) {
         while ($fetch_vacancies = $show_vacancies->fetch(PDO::FETCH_ASSOC)) {  
   ?>
   <div class="box">
      <div class="title"><?= htmlspecialchars($fetch_vacancies['title']); ?></div>
      <div class="location"><?= htmlspecialchars($fetch_vacancies['location']); ?></div>
      <div class="description"><?= htmlspecialchars($fetch_vacancies['description']); ?></div>
      <div class="flex-btn">
         <a href="apply.php?vacancy_id=<?= $fetch_vacancies['id']; ?>" class="apply-btn">Apply Now</a>
      </div>
   </div>
   <?php
         }
      } else {
         echo '<p class="empty">No job vacancies posted yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show job vacancies section ends -->
<?php include 'components/footer.php'; ?>
</body>
</html>

