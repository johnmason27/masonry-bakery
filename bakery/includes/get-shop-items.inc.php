<?php
session_start();
require "dbh.inc.php";

$sql = "SELECT id, title, description, imgUrl, price, added, stock, sold FROM shop";

if (isset($_POST["searchValue"])) {
    $searchValue = $_POST["searchValue"];
    $query = " WHERE title LIKE '%$searchValue%'";
    $query .= " OR description LIKE '%$searchValue%'";
    $query .= " OR description LIKE '%$searchValue%'";
    $query .= " OR tags LIKE '%$searchValue%'";
    $sql .= $query;
}

if (isset($_POST["sortBy"])) {
    $sortByFilter = $_POST["sortBy"];

    if ($sortByFilter === "lowToHigh") {
        $sql .= " ORDER BY price ASC";
    } else if ($sortByFilter === "highToLow") {
        $sql .= " ORDER BY price DESC";
    } else if ($sortByFilter === "newest") {
        $sql .= " ORDER BY added DESC";
    } else if ($sortByFilter === "oldest") {
        $sql .= " ORDER BY added ASC";
    }
}

if (isset($_POST["filters"])) {
    $filters = $_POST["filters"];
    for ($i = 0; $i < count($filters); $i++) {
        if ($i == 0) {
            $sql .= " WHERE tags LIKE '%$filters[$i]%'";
        } else {
            $sql .= " OR tags LIKE '%$filters[$i]%'";
        }
    }
}

$response = mysqli_query($conn, $sql);

if (!$response) {
    echo "<p>No response from the database. Shop items couldn't not be loaded.</p>";
    exit();
}

$num_records = mysqli_num_rows($response);

if ($num_records == 0) {
    print("<p>No shop items in the database sorry...</p>");
} else {
    while ($row = mysqli_fetch_assoc($response)) {         
        if ($row["stock"] > 0) {       
            $isLowStock = false;
            $isPopular = false;

            if ($row["stock"] < 3) {
                $isLowStock = true;
            }

            if ($row["sold"] >= 15) {
                $isPopular = true;
            }
            
            echo "
                <a class='shop-item' href='shop-item.php?id=".$row["id"]."'>
                    <img src=".$row["imgUrl"]." alt='".$row["title"]."' />
                    <div class='shop-item-text'>";
            if ($isPopular) {
                echo "<p class='alert'>Best Seller</p>";
            } else if ($isLowStock) {
                echo "<p class='alert'>Low Stock</p>";
            }
            echo "<p class='title'>".$row["title"]."</p>
                        <p class='description'>".$row["description"]."</p>
                        <p class='price'>£".$row["price"]."</p>
                    </div>
                </a>";
        }
    }
}