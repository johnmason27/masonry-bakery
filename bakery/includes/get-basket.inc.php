<?php
session_start();
require "dbh.inc.php";

$basketItems = $_SESSION["basket"];

if (empty($basketItems)) {
    echo "<div class='basket-empty'>
        <p>No items in your basket! Go to the <a href='shop.php'>shop</a> to add some.</p>
    </div>";
    exit();
}

$sql = "SELECT id, title, description, imgUrl, price, stock FROM shop WHERE";

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
    $totalPrice = 0;
    echo "<h1>Basket</h1>";
    echo "<button class='basket-clear-all-button' onclick='clearBasket()'><p>Clear basket</p></button>";
    while ($row = mysqli_fetch_assoc($response)) {                
        for ($i = 0; $i < count($basketItems); $i++) {
            if ($basketItems[$i]->id === $row["id"]) {
                $quantity = $basketItems[$i]->quantity;
            }
        }
        $itemPrice = $row["price"] * $quantity;
        $totalPrice += $itemPrice;
        echo "<div class='basket-item' id='item-".$row["id"]."'>
            <img src='".$row["imgUrl"]."' alt='".$row["title"]."'/>
            <div>
                <p class='item-title'>".$row["title"]."</p>
                <p class='item-price'>£".$row["price"]."</p>
                <p class='item-stock-levels'>Stock levels: ".$row["stock"]."</p>
                <label for='item-quantity'>Quantity:</label>
                <input id='item-quantity' type='number' min='0' max='".$row["stock"]."' value='".$quantity."' oninput='validity.valid||(value=``); updateQuantity(".$id.")'>
                <button class='basket-remove-item-button' onclick='removeItem(".$row["id"].")'><p>Remove</p></button>
            </div>
        </div>";
    }
    echo "<p class='basket-total'>Total: £".$totalPrice."</p>";
    if (count($basketItems) !== 0) {
        echo "<a href='complete-order.php'><button class='basket-complete-order-button'><h2>Order</h2></button></a>";
    }
}