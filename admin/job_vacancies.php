<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_vacancy'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $location = $_POST['location'];
   $location = filter_var($location, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);

   $insert_vacancy = $conn->prepare("INSERT INTO `job_vacancies` (title, location, description) VALUES (?, ?, ?)");
   $insert_vacancy->execute([$title, $location, $description]);

   $message[] = 'New job vacancy added!';
}

if(isset($_GET['delete_vacancy'])){

   $delete_id = $_GET['delete_vacancy'];

  
   $delete_applications = $conn->prepare("DELETE FROM `job_applications` WHERE vacancy_id = ?");
   $delete_applications->execute([$delete_id]);


   $delete_vacancy = $conn->prepare("DELETE FROM `job_vacancies` WHERE id = ?");
   $delete_vacancy->execute([$delete_id]);

   header('location:job_vacancies.php');
}


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
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- add job vacancy section starts  -->

<section class="add-vacancy">

   <form action="" method="POST">
      <h3>Add Job Vacancy</h3>
      <input type="text" required placeholder="Enter job title" name="title" maxlength="100" class="box">
      <input type="text" required placeholder="Enter job location" name="location" maxlength="100" class="box">

      <textarea name="description" placeholder="Enter job description" maxlength="500" required class="box"></textarea>
      <input type="submit" value="Add Vacancy" name="add_vacancy" class="btn">
   </form>

</section>

<!-- add job vacancy section ends -->

<!-- show job vacancies section starts  -->

<section class="show-vacancies" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_vacancies = $conn->prepare("SELECT * FROM `job_vacancies` ORDER BY `date_posted` DESC");
      $show_vacancies->execute();
      if($show_vacancies->rowCount() > 0){
         while($fetch_vacancies = $show_vacancies->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <div class="title"><?= $fetch_vacancies['title']; ?></div>
      <div class="location"><?= $fetch_vacancies['location']; ?></div>
      <div class="description"><?= $fetch_vacancies['description']; ?></div>
      
         <a href="job_vacancies.php?delete_vacancy=<?= $fetch_vacancies['id']; ?>" class="delete-btn" onclick="return confirm('Delete this job vacancy?');">Delete</a>
      
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">No job vacancies posted yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show job vacancies section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>
