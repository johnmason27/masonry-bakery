<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: ../login.php");
}

require "dbh.inc.php";
$sql = "SELECT id, title, description, price, added, stock, sold FROM shop";

$response = mysqli_query($conn, $sql);

if (!$response) {
    echo "<p>No response from the database. Stock couldn't not be loaded.</p>";
    exit();
}

$num_records = mysqli_num_rows($response);

if ($num_records == 0) {
    print("<p>There is no stock!</p>");
} else {
    echo "<table class='stock-table'>
        <thead>
            <tr>
                <th class='stock-id'>Id</th>
                <th class='stock-title'>Title</th>
                <th class='stock-description'>Description</th>
                <th class='stock-price'>Price</th>
                <th class='stock-added'>Added</th>
                <th class='stock-stock'>Stock</th>
                <th class='stock-sold'>Sold</th>
                <th class='stock-options'>Options</th>
            </tr>
        </thead><tbody>";
    while ($row = mysqli_fetch_assoc($response)) {             
        echo "<tr id='stock-table-row-".$row["id"]."'>
            <td class='stock-id'>".$row["id"]."</td>
            <td class='stock-title'>".$row["title"]."</td>
            <td class='stock-description'>".$row["description"]."
            <td class='stock-price'>£".$row["price"]."</td>
            <td class='stock-added'>".$row["added"]."</td>
            <td class='stock-stock'>".$row["stock"]."</td>
            <td class='stock-sold'>".$row["sold"]."</td>
            <td class='stock-options'>
                <div class='stock-options-container'>
                    <a class='stock-edit-button' href='edit-stock-item.php?id=".$row["id"]."'>Edit</a>
                    <button class='stock-remove-button' onclick='removeStockItem(".$row["id"].")'>Remove</button>
                </div>
            </td>
        </tr>";
    }
    echo "</tbody></table>";
}