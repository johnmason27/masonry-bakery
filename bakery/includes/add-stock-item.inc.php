<?php
if (isset($_POST["add-stock-item"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $imgUrl = $_POST["imgUrl"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    if (empty($title) || empty($description) || empty($imgUrl) || empty($price) || empty($stock)) {
        header("Location: ../add-stock-item.php&error=emptyfields");
        exit();
    } else {
        require "dbh.inc.php";

        $sql = "INSERT INTO shop (`title`, `description`, `imgUrl`, `price`, `added`, `stock`, `sold`, `tags`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../add-stock-item.php?&error=sqlerror");
        exit();
        } else {
            $added = date("Y-m-d");
            $sold = 0;
            $tags = "";
            if (isset($_POST["bread"])) {
                $tags .= $_POST["bread"];
            }
            
            if (isset($_POST["wholemeal"])) {
                if ($tags === "") {
                    $tags .= $_POST["wholemeal"];
                } else {
                    $tags .= ",".$_POST["wholemeal"];
                }
            } 
            
            if (isset($_POST["white"])) {
                if ($tags === "") {
                    $tags .= $_POST["white"];
                } else {
                    $tags .= ",".$_POST["white"];
                }
            } 
            
            if (isset($_POST["cookies"])) {
                if ($tags === "") {
                    $tags .= $_POST["cookies"];
                } else {
                    $tags .= ",".$_POST["cookies"];
                }
            } 
            
            if (isset($_POST["savoury"])) {
                if ($tags === "") {
                    $tags .= $_POST["savoury"];
                } else {
                    $tags .= ",".$_POST["savoury"];
                }
            }
            
            if (isset($_POST["sweet"])) {
                if ($tags === "") {
                    $tags .= $_POST["sweet"];
                } else {
                    $tags .= ",".$_POST["sweet"];
                }
            }

            mysqli_stmt_bind_param($stmt, "sssdsiis", $title, $description, $imgUrl, $price, $added, $stock, $sold, $tags);
            mysqli_stmt_execute($stmt);
            
            header("Location: ../view-edit-stock.php?success=add");
            exit();
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        exit();
    }
} else {
    header("Location: ../view-edit-stock.php?error=nopost");
    exit();
}