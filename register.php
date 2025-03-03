<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
     $name = trim($_POST['name']);
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = trim($_POST['email']);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $number = trim($_POST['number']);
    $number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    $pass = trim($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = trim($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $errors = [];

    // Validate name
    if (empty($name)) {
        $errors[] = 'Name is required.';
    } elseif (strlen($name) > 50) {
        $errors[] = 'Name must be less than 50 characters.';
    } elseif (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
        $errors[] = 'Name must contain only alphabetic characters and spaces.';
    }

    // Validate email
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Validate number
    if (empty($number)) {
        $errors[] = 'Mobile number is required.';
    } elseif (strlen($number) != 10 || !is_numeric($number)) {
        $errors[] = 'Mobile number must be exactly 10 digits.';
    }

    // Validate passwords
    if (empty($pass)) {
        $errors[] = 'Password is required.';
    } elseif (empty($cpass)) {
        $errors[] = 'Confirm password is required.';
    } elseif ($pass !== $cpass) {
        $errors[] = 'Passwords do not match.';
    } else {
        $pass = sha1($pass);
    }

    // If no errors, proceed with database operations
    if (empty($errors)) {
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? OR number = ?");
        $select_user->execute([$email, $number]);
        $row = $select_user->fetch(PDO::FETCH_ASSOC);

        if ($select_user->rowCount() > 0) {
            $errors[] = 'Email or number already exists!';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `users`(name, email, number, password) VALUES(?, ?, ?, ?)");
            $insert_user->execute([$name, $email, $number, $pass]);

            $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
            $select_user->execute([$email, $pass]);
            $row = $select_user->fetch(PDO::FETCH_ASSOC);

            if ($select_user->rowCount() > 0) {
                $_SESSION['user_id'] = $row['id'];
                header('Location: login.php');
                exit;
            }
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
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->
         <?php
   if (isset($errors) && !empty($errors)) {
       foreach ($errors as $error) {
           echo '<div class="error-msg">' . htmlspecialchars($error) . '</div>';
       }
   }
   ?>
<section class="form-container">

   <form action="" method="post">
      <h3>Register Now</h3>

      <input type="text" name="name"  placeholder="Enter your name" class="box" maxlength="50">
      <input type="email" name="email"  placeholder="Enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="text" name="number"  placeholder="Enter your mobile number" class="box" maxlength="10" oninput="this.value = this.value.replace(/\s/g, '').replace(/[^0-9]/g, '')">
      <input type="password" name="pass"  placeholder="Enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass"  placeholder="Confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Register Now" name="submit" class="btn">
      <p>Already have an account? <a href="login.php">Login now</a></p>
   </form>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
