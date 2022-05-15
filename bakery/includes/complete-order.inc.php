<?php
session_start();

if (isset($_POST["complete-order"])) {
    require "dbh.inc.php";

    $forename = $_POST["forename"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $postcode = $_POST["postcode"];

    if (empty($forename) && 
        empty($surname) && 
        empty($email) && 
        empty($address) && 
        empty($postcode)) {
        header("Location: ../complete-order.php?error=emptyfields");
        exit();
    } else if (empty($forename)) {
        header("Location: ../complete-order.php?error=invalidforename&surname=".$surname."&email=".$email."&address=".$address."&postcode=".$postcode);
        exit();
    } else if (empty($surname)) {
        header("Location: ../complete-order.php?error=invalidsurname&forename=".$forename."&email=".$email."&address=".$address."&address=".$address."&postcode=".$postcode);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        header("Location: ../complete-order.php?error=invalidemail&forename=".$forename."&surname=".$surname."&address=".$address."&address=".$address."&postcode=".$postcode);
        exit();
    } else if (empty($address)) {
        header("Location: ../complete-order.php?error=invalidaddress&forename=".$forename."&surname=".$surname."&email=".$email."&postcode=".$postcode);
        exit();
    } else if (empty($postcode)) {
        header("Location: ../complete-order.php?error=invalidpostcode&forename=".$forename."&surname=".$surname."&email=".$email."&address=".$address);
        exit();
    } else {
        $basketItems = $_SESSION["basket"];
        $receipt = "";
        $totalPrice = 0;

        $sql = "SELECT id, title, price FROM shop WHERE";

        for ($i = 0; $i < count($basketItems); $i++) {
            $id = $basketItems[$i]->id;
            $quantity = $basketItems[$i]->quantity;
            if ($i === 0) {
                $sql .= " id = $id";
            } else {
                $sql .= " OR id = $id";
            }  

            $updateStockSql = "UPDATE shop SET stock = stock - ?, sold = sold + ? WHERE id = ?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $updateStockSql)) {
                header("Location: ../complete-order.php?error=genericerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "iii", $quantity, $quantity, $id);
                mysqli_stmt_execute($stmt);
            }
        }

        $response = mysqli_query($conn, $sql);

        if (!$response) {
            header("Location: ../complete-order.php?error=genericerror");
            exit();
        }

        $num_records = mysqli_num_rows($response);

        if ($num_records == 0) {
            header("Location: ../complete-order.php?error=genericerror");
            exit();
        } else {
            $count = 0;
            while ($row = mysqli_fetch_assoc($response)) {                
                for ($i = 0; $i < count($basketItems); $i++) {
                    if ($basketItems[$i]->id === $row["id"]) {
                        $quantity = $basketItems[$i]->quantity;
                    }
                }
                $title = $row["title"];
                $itemPrice = $row["price"] * $quantity;
                $totalPrice += $itemPrice;

                $basketItemsCount = count($basketItems);

                if ($basketItemsCount === 1) {
                    $receipt .= "Item: ".$row["title"]." - Quantity: ".$quantity." - Price: £".$itemPrice;
                    $receipt .= ", Total Price: £".$totalPrice;
                } else if ($count === $basketItemsCount - 1) {
                    $receipt .= ", Item: ".$row["title"]." - Quantity: ".$quantity." - Price: £".$itemPrice;
                    $receipt .= ", Total Price: £".$totalPrice;
                } else if ($count === 0) {
                    $receipt .= "Item: ".$row["title"]." - Quantity: ".$quantity." - Price: £".$itemPrice;
                } else {
                    $receipt .= ", Item: ".$row["title"]." - Quantity: ".$quantity." - Price: £".$itemPrice;
                }

                $count++;
            }
        }

        $stockUpdateSql = "INSERT INTO orders (`forename`, `surname`, `email`, `address`, `postcode`, `receipt`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $stockUpdateSql)) {
            header("Location: ../complete-order.php?error=genericerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssssss", $forename, $surname, $email, $address, $postcode, $receipt);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        $_SESSION["basket"] = array();
        header("Location: ../basket.php?success=completedorder");
        exit();
    }
} else {
    header("Location: ../shop.php");
    exit();
}