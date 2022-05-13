<?php
session_start();

if (!isset($_POST["id"]) || !isset($_POST["quantity"])) {
    echo "fail";
}

$id = $_POST["id"];
$quantity = $_POST["quantity"];

$item = new stdClass();
$item->id = $id;
$item->quantity = $quantity;

$isEmpty = empty($_SESSION["basket"]);
if ($isEmpty) {
    array_push($_SESSION["basket"], $item);
} else {
    $sessionLength = count($_SESSION["basket"]);
    $notFound = true;
    
    for ($i = 0; $i < $sessionLength; $i++) {
        if ($item->id == $_SESSION["basket"][$i]->id) {
            $notFound = false;
            $_SESSION["basket"][$i]->quantity += $item->quantity;
        }
    }
    
    if ($notFound) {
        array_push($_SESSION["basket"], $item);
    }
}

echo "success";