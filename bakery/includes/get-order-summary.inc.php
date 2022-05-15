<?php
session_start();
require "dbh.inc.php";

$basketItems = $_SESSION["basket"];

$sql = "SELECT id, title, imgUrl, price FROM shop WHERE";

for ($i = 0; $i < count($basketItems); $i++) {
    $id = $basketItems[$i]->id;
    if ($i === 0) {
        $sql .= " id = $id";
    } else {
        $sql .= " OR id = $id";
    }  
}

$response = mysqli_query($conn, $sql);

if (!$response) {
    echo "<p>No items in database</p>";
    exit();
}

$num_records = mysqli_num_rows($response);

if ($num_records == 0) {
    echo "<p>No items in database</p>";
} else {
    echo "<div class='order-details-container'>";
        $totalPrice = 0;
        while ($row = mysqli_fetch_assoc($response)) {                
            for ($i = 0; $i < count($basketItems); $i++) {
                if ($basketItems[$i]->id === $row["id"]) {
                    $quantity = $basketItems[$i]->quantity;
                }
            }
            $itemPrice = $row["price"] * $quantity;
            $totalPrice += $itemPrice;
            echo "<div class='order-details-item'>
                <div>
                    <p class='order-details-item-title'>".$row["title"]."</p>
                    <p class='order-details-item-price'>£".$row["price"]."</p>
                    <p class='order-details-item-quantity'>Quantity: ".$quantity."</p>
                </div>
            </div>";
        }
    echo "<p class='order-details-item-total'>Total: £".$totalPrice."</p>";
    echo "</div>";
}