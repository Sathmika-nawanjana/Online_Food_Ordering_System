<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

include 'components/add_cart.php';

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}

if (isset($_GET['vacancy_id'])) {
    $vacancy_id = $_GET['vacancy_id'];
    $vacancy_id = filter_var($vacancy_id, FILTER_SANITIZE_NUMBER_INT);
    
    $query = $conn->prepare("SELECT * FROM job_vacancies WHERE id = ?");
    $query->execute([$vacancy_id]);
    $vacancy = $query->fetch(PDO::FETCH_ASSOC);

    if (!$vacancy) {
        echo 'Invalid Vacancy ID!';
        exit();
    }
} else {
    echo 'No Vacancy ID Provided!';
    exit();
}

$error_msg = [];
if (isset($_POST['apply'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['mobile'];
    $address = $_POST['address'];
    $cover_letter = $_POST['cover_letter'];

    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['resume']['tmp_name'];
        $fileName = $_FILES['resume']['name'];
        $fileSize = $_FILES['resume']['size'];
        $fileType = $_FILES['resume']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        $allowedfileExtensions = ['pdf', 'doc', 'docx'];
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = 'uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);
            }
            $dest_path = $uploadFileDir . $fileName;
            
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $stmt = $conn->prepare("INSERT INTO job_applications (user_id, vacancy_id, name, email, phone, address, cover_letter, resume_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$user_id, $vacancy_id, $name, $email, $phone, $address, $cover_letter, $dest_path]);

                if ($stmt) {
                    $message[] = 'Application submitted successfully!';
                } else {
                    $error_msg[] = 'Failed to submit application.';
                }
            } else {
                $error_msg[] = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        } else {
            $error_msg[] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $error_msg[] = 'There is some error in the file upload. Please check the following error.<br>';
        $error_msg[] = 'Error:' . $_FILES['resume']['error'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Apply for Job</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'components/user_header.php'; ?>

<section class="apply-vacancy">
   <div class="box">
      <h1>Apply for Job</h1>
      <h2><?= htmlspecialchars($vacancy['title']); ?></h2>
      <p><?= htmlspecialchars($vacancy['location']); ?></p>
      <p><?= htmlspecialchars($vacancy['description']); ?></p>

      <?php if (!empty($error_msg)): ?>
         <div class="error-messages">
            <?php foreach ($error_msg as $error): ?>
               <p><?= htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
         </div>
      <?php endif; ?>

      <form action="" method="post" enctype="multipart/form-data">
         <input type="text" name="name" maxlength="20" required placeholder="Enter username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
         <input type="email" name="email" required placeholder="Enter email" class="box">
         <input type="tel" name="mobile" pattern="[0-9]{10}" required placeholder="Enter mobile number (10 digits)" class="box">
         <input type="text" name="address" required placeholder="Enter address" class="box">
         <textarea name="cover_letter" placeholder="Write your cover letter here" required></textarea>
         <input type="file" name="resume" required class="box">
         <button type="submit" name="apply" class="apply-btn">Submit Application</button>
      </form>
   </div>
</section>
<?php include 'components/footer.php'; ?>
</body>
</html>
