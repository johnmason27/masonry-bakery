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
        $isBreadChecked = false;
        $isWholemealChecked = false;
        $isWhiteChecked = false;
        $isCookiesChecked = false;
        $isSavouryChecked = false;
        $isSweetChecked = false;

        $tags = explode(",", $row["tags"]);
        for ($i = 0; $i < count($tags); $i++) {
            if ($tags[$i] === "bread") {
                $isBreadChecked = true;
            } else if ($tags[$i] === "wholemeal") {
                $isWholemealChecked = true;
            } else if ($tags[$i] === "white") {
                $isWhiteChecked = true;
            } else if ($tags[$i] === "cookies") {
                $isCookiesChecked = true;
            } else if ($tags[$i] === "savoury") {
                $isSavouryChecked = true;
            } else if ($tags[$i] === "sweet") {
                $isSweetChecked = true;
            }
        }

        echo "<form class='edit-stock-item-form' method='post' action='includes/edit-stock-item.inc.php'>
                <label>Id</label>
                <input id='id' type='text' name='id' readonly='readonly' value='".$row["id"]."'>
                <label>Title</label>
                <input id='title' type='text' name='title' value='".$row["title"]."'>
                <label>Description</label>
                <input id='description' type='text' name='description' value='".$row["description"]."'>
                <label>Image Url</label>
                <input id='imgUrl' type='url' name='imgUrl' value='".$row["imgUrl"]."'>
                <label>Price (£)</label>
                <input id='price' type='number' name='price' min='0' step='any' value=".$row["price"].">
                <label>Stock</label>
                <input id='stock' type='number' name='stock' min='0' oninput='validity.valid||(value=``)' step='1' value=".$row["stock"].">
                <label>Tags</label>
                <div class='edit-tags'>
                    <input type='checkbox' id='bread' name='bread' value='bread' ".($isBreadChecked ? "checked": "")."/>
                    <label for='bread'>Bread</label><br>
                    <input type='checkbox' id='wholemeal' name='wholemeal' value='wholemeal' ".($isWholemealChecked ? "checked": "")."/>
                    <label for='wholemeal'>Wholemeal products</label><br>
                    <input type='checkbox' id='white' name='white' value='white' ".($isWhiteChecked ? "checked": "")."/>
                    <label for='white'>White flour products</label><br>
                    <input type='checkbox' id='cookies' name='cookies' value='cookies' ".($isCookiesChecked ? "checked": "")."/>
                    <label for='cookies'>Cookies</label><br>
                    <input type='checkbox' id='savoury' name='savoury' value='savoury' ".($isSavouryChecked ? "checked": "")."/>
                    <label for='savoury'>Savoury</label><br>
                    <input type='checkbox' id='sweet' name='sweet' value='sweet' ".($isSweetChecked ? "checked": "")."/>
                    <label for='sweet'>Sweet</label><br>
                </div>
                <input type='submit' name='edit-stock-item' value='Edit'>
            </form>";
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
exit();