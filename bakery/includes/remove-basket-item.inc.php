<?php
session_start();

if (!isset($_POST["id"])) {
    exit();
}

$id = $_POST["id"];

for ($i = 0; $i < count($_SESSION["basket"]); $i++) {
    if ($_SESSION["basket"][$i]->id === $id) {
        unset($_SESSION["basket"][$i]);
    }
}