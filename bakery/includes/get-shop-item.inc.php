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
            echo json_encode($row);
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}