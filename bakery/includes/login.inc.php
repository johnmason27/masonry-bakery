<?php
session_start();
if (isset($_POST["login-submit"])) {
    require "dbh.inc.php";

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passwordCheck = password_verify($password, $row["password"]);
                if (!$passwordCheck) {
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                } else if ($passwordCheck) {
                    session_start();
                    $_SESSION["userid"] = $row["id"];
                    $_SESSION["username"] = $row["username"];

                    header("Location: ../profile.php");
                    exit();
                } else { 
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: ../login.php&error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}