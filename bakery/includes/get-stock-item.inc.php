<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: ../view-edit-stock.php?error=noid");
    exit();
}

require "dbh.inc.php";
$id = $_GET["id"];
$sql = "SELECT id, title, description, imgUrl, price, stock, tags FROM shop WHERE id=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $response = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($response)) {
        echo json_encode($row);
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();