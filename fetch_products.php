<?php

include 'components/connect.php';

if(isset($_POST['category'])){
    $category = $_POST['category'];

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
    $select_products->execute([$category]);

    $products = [];
    if($select_products->rowCount() > 0){
        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            $products[] = $fetch_products;
        }
    }

    echo json_encode($products);
}
?>
