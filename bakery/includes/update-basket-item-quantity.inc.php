<?php
session_start();
if (isset($_POST["id"]) && isset($_POST["quantity"])) {
    for ($i = 0; $i < $_SESSION["basket"]; $i++) {
        if ($_SESSION["basket"][$i]->id === $_POST["id"]) {
            $_SESSION["basket"][$i]->quantity = $_POST["quantity"];
            break;
        }
    }
} else {
    header("Location: ../basket.php");
    exit();
}