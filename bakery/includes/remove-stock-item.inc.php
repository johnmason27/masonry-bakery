<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_POST["id"])) {
    header("Location: ../view-edit-stock.php?error=noid");
    exit();
}

require "dbh.inc.php";
$id = $_POST["id"];
$sql = "DELETE FROM shop WHERE id=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);