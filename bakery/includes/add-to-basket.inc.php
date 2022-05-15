<?php
session_start();
require "dbh.inc.php";

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
            $sql = "SELECT stock FROM shop WHERE id = ?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "i", $item->id);
                mysqli_stmt_execute($stmt);
                $response = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($response)) {
                    if ($row["stock"] >= $_SESSION["basket"][$i]->quantity) {
                        $_SESSION["basket"][$i]->quantity = $row["stock"];
                    } else {
                        $_SESSION["basket"][$i]->quantity += $item->quantity;
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
    
    if ($notFound) {
        array_push($_SESSION["basket"], $item);
    }
}

echo "success";