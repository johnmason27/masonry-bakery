<?php
if (isset($_POST["login-submit"])) {
    require "dbh.inc.php";

    $emailusername = $_POST["mailuid"];
    $password = $_POST["password"];

    if (empty($emailusername) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE usernameUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $emailusername, $emailusername);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passwordCheck = password_verify($password, $row["passwordUsers"]);
                if (!$passwordCheck) {
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                } else if ($passwordCheck) {
                    session_start();
                    $_SESSION["userId"] = $row["idUsers"];
                    $_SESSION["username"] = $row["usernameUsers"];
                    $_SESSION["userEmail"] = $row["emailUsers"];

                    header("Location: ../index.php?login=success");
                    exit();
                } else { 
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}