<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
   exit;
}

if(isset($_GET['delete_applications'])){
   $delete_id = $_GET['delete_applications'];
   $delete_application = $conn->prepare("DELETE FROM `job_applications` WHERE id = ?");
   $delete_application->execute([$delete_id]);
   header('location:admin_view_application.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Job Applications</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- show job applications section starts  -->

<section class="show-vacancies" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_applications = $conn->prepare("SELECT * FROM `job_applications` ORDER BY `applied_at` DESC");
      $show_applications->execute();
      if($show_applications->rowCount() > 0){
         while($fetch_applications = $show_applications->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <div class="vacancyid">Vacancy ID: <?= htmlspecialchars($fetch_applications['vacancy_id']); ?></div>
      <div class="name">Name: <?= htmlspecialchars($fetch_applications['name']); ?></div>
      <div class="email">Email: <?= htmlspecialchars($fetch_applications['email']); ?></div>
      <div class="phone">Phone: <?= htmlspecialchars($fetch_applications['phone']); ?></div>
      <div class="address">Address: <?= htmlspecialchars($fetch_applications['address']); ?></div>
      <div class="cover-letter">Cover Letter: <?= nl2br(htmlspecialchars($fetch_applications['cover_letter'])); ?></div>
      <div class="applied-at">Applied At: <?= htmlspecialchars($fetch_applications['applied_at']); ?></div>
      <div class="resume">
         <a href="../<?= htmlspecialchars($fetch_applications['resume_path']); ?>" download>Download Resume</a>
      </div>
      <div class="flex-btn">
         <a href="admin_view_application.php?delete_applications=<?= $fetch_applications['id']; ?>" class="delete-btn" onclick="return confirm('Delete this job application?');">Delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No job applications posted yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show job applications section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
