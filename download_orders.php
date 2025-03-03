<?php

require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include 'components/connect.php';

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: login.php'); 
    exit();
}

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $select_order = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
    $select_order->execute([$order_id]);

    if($select_order->rowCount() > 0){
        $order = $select_order->fetch(PDO::FETCH_ASSOC);

        // Initialize dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

       
        $html = '
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { max-width: 800px; margin: 0 auto; padding: 20px; }
                .order-details { border: 1px solid #ddd; padding: 10px; margin-bottom: 20px; }
                h1 { text-align: center; color:green; font-size:3.3rem; }
                
                p { margin: 5px 0; }
                .status-pending { color: red; }
                .status-completed { color: green; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1> Emoro Restaurant </h1>
                <h2>Order Details</h2>
                <div class="order-details">
                    <p>Reference Number : <strong>ER000' . $order['id'] . '</strong></p>
                    <p>Placed On : <strong>' . $order['placed_on'] . '</strong></p>
                    <p>Name : <strong>' . $order['name'] . '</strong></p>
                    <p>Email : <strong>' . $order['email'] . '</strong></p>
                    <p>Mobile Number : <strong>' . $order['number'] . '</strong></p>
                    <p>Address : <strong>' . $order['address'] . '</strong></p>
                    <p>Payment method : <strong>' . $order['method'] . '</strong></p>
                    <p>Your Orders : <strong>' . $order['total_products'] . '</strong></p>
                    <p>Total Price : <strong>R.S. ' . $order['total_price'] . '/-</strong></p>
                    <p>Payment status : <strong class="' . ($order['payment_status'] == 'pending' ? 'status-pending' : 'status-completed') . '">' . $order['payment_status'] . '</strong></p>
                </div>
            </div>
        </body>
        </html>';

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF (1 = download and 0 = view in browser)
        $dompdf->stream('Order_Details_ER000' . $order['id'] . '.pdf', ['Attachment' => 1]);
    } else {
        echo 'Order not found!';
    }
} else {
    echo 'No order ID specified!';
}

?>
