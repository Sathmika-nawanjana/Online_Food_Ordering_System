<?php

include 'components/connect.php';
require 'vendor/autoload.php';  // Include Composer's autoload file

use Dompdf\Dompdf;
use Dompdf\Options;

session_start();

if(isset($_GET['reservation_id'])){
    $reservation_id = $_GET['reservation_id'];
}else{
    die('Reservation ID not specified.');
}

// Fetch reservation details
$select_reservation = $conn->prepare("SELECT * FROM `reservations` WHERE id = ?");
$select_reservation->execute([$reservation_id]);
$reservation = $select_reservation->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    die('Reservation not found.');
}

// Instantiate Dompdf
$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

// Generate HTML content
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; }
 h1 { text-align: center; color:green; font-size:3.3rem; }
       
        .info { margin-bottom: 10px; }
        .info span { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
                <h1> Emoro Restaurant </h1>
                <h2>Reservation Details</h2>
        <p class="info">Id: <span>' . htmlspecialchars($reservation['id']) . '</span></p>
        <p class="info">Name: <span>' . htmlspecialchars($reservation['name']) . '</span></p>
        <p class="info">Email: <span>' . htmlspecialchars($reservation['email']) . '</span></p>
        <p class="info">Number: <span>' . htmlspecialchars($reservation['number']) . '</span></p>
        <p class="info">Date: <span>' . htmlspecialchars($reservation['date']) . '</span></p>
        <p class="info">Time: <span>' . htmlspecialchars($reservation['time']) . '</span></p>
        <p class="info">Type: <span>' . htmlspecialchars($reservation['type']) . '</span></p>
        <p class="info">Guests: <span>' . htmlspecialchars($reservation['guests']) . '</span></p>
    </div>
</body>
</html>
';

// Load HTML content
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('reservation_details_' . $reservation_id . '.pdf', array("Attachment" => 1));
exit();
?>
