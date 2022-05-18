<?php
if (isset($_POST["edit-stock-item"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $imgUrl = $_POST["imgUrl"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    if (empty($title) || empty($description) || empty($imgUrl) || empty($price) || empty($stock)) {
        header("Location: ../edit-stock-item.php?id=".$id."&error=emptyfields");
        exit();
    } else {
        require "dbh.inc.php";

        $sql = "UPDATE shop SET title=?, description=?, imgUrl=?, price=?, stock=?, tags=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../edit-stock-item.php?id=".$id."&error=sqlerror");
        exit();
        } else {
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

            mysqli_stmt_bind_param($stmt, "sssdisi", $title, $description, $imgUrl, $price, $stock, $tags, $id);
            mysqli_stmt_execute($stmt);
            
            header("Location: ../view-edit-stock.php?success=edit");
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