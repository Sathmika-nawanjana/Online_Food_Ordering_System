<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){
   $errors = [];

   // Validate email
   if(empty($_POST['email'])){
      $errors[] = 'Email is required.';
   } else {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $errors[] = 'Invalid email format.';
      }
   }

   // Validate password
   if(empty($_POST['pass'])){
      $errors[] = 'Password is required.';
   } else {
      $pass = $_POST['pass'];
      $pass = filter_var($pass, FILTER_SANITIZE_STRING);
      $pass = sha1($pass);
   }

   // Proceed only if there are no errors
   if(empty($errors)){
      $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
      $select_user->execute([$email, $pass]);
      $row = $select_user->fetch(PDO::FETCH_ASSOC);
      
      if($select_user->rowCount() > 0){
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');
         exit;
      }else{
         $errors[] = 'Incorrect username or password!';
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
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->
      <?php
      if(!empty($errors)){
         foreach($errors as $error){
            echo '<p class="error-msg">'.$error.'</p>';
         }
      }
      ?>
<section class="form-container">
   <form action="" method="post">
      <h3>login now</h3>

      


      <input type="email" name="email"  placeholder="enter your email" class="box" maxlength="50" value="<?php if(isset($email)) echo $email; ?>">
      <input type="password" name="pass"  placeholder="enter your password" class="box" maxlength="50">
      <input type="submit" value="login now" name="submit" class="btn">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

   <div class="loader">
      <img src="images/loader.gif" alt="">
   </div>
</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
