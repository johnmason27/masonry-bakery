<?php
session_start();
require "dbh.inc.php";

if (isset($_GET["id"])) {
    $itemId = $_GET["id"];
    $sql = "SELECT id, title, description, imgUrl, price, stock FROM shop WHERE id=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "<p>Failed to connect to database.</p>";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $itemId);
        mysqli_stmt_execute($stmt);
        $response = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($response)) {
            echo "<h1 id='shop-item-title'>".$row["title"]."</h1>
                <p id='shop-item-description'>".$row["description"]."</p>
                <p id='shop-item-price'>£".$row["price"]."</p>
                <form class='shop-item-form'>
                    <p id='stock-count'>Stock: ".$row["stock"]."</p>
                    <label for='item-quantity'>Quantity:</label>
                    <input id='item-quantity' type='number' min='0' oninput='validity.valid||(value=``)'>
                    <button onclick='addToBasket()'>Add to basket</button>
                </form>
                <img id='shop-item-img' src=".$row["imgUrl"]." alt='".$row["title"]."'/>";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}