<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_deliver = $conn->prepare("SELECT * FROM `deliver` WHERE name = ? AND password = ?");
   $select_deliver->execute([$name, $pass]);
   
   if($select_deliver->rowCount() > 0){
      $fetch_deliver_id = $select_deliver->fetch(PDO::FETCH_ASSOC);
      $_SESSION['deliver_id'] = $fetch_deliver_id['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
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
   <link rel="stylesheet" href="../css/deliver_style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

       <img src="data:image/jpeg;base64,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" alt="Company Logo" width="110px" ></a>
      <a class="logo">deliver rider<span>Panel</span></a>
   </section>

</header>

<!-- staff login form section starts  -->

<section class="form-container">

   <form action="" method="POST">
      <h3>login now</h3>
      
      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- staff login form section ends -->


</body>
</html>
