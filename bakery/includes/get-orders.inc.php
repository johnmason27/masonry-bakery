<?php
require "dbh.inc.php";

$sql = "SELECT id, email, receipt FROM orders";
$response = mysqli_query($conn, $sql);

if (!$response) {
    echo "<p>No response from the database. Orders couldn't not be loaded.</p>";
    exit();
}

$num_records = mysqli_num_rows($response);

if ($num_records == 0) {
    print("<p>There are no orders!...</p>");
} else {
    echo "<table class='orders-table'>
        <thead><tr><th class='order-id'>Id</th><th class='order-email'>Email</th><th class='order-receipt'>Receipt</th></tr>
        </thead><tbody>";
    while ($row = mysqli_fetch_assoc($response)) {      
        $reciept = explode(",", $row["receipt"]);       
        $count = count($reciept);
        $convertedReciept = "";
        for ($i = 0; $i < count($reciept); $i++) {
            if ($i !== $count - 1) {
                $convertedReciept .= $reciept[$i]."<br>";
            } else {
                $convertedReciept .= $reciept[$i];
            }
        }        
        echo "<tr><td class='order-id'>".$row["id"]."</td><td class='order-email'>".$row["email"]."</td><td class='order-receipt'>".$convertedReciept."</tr>";
    }
    echo "</tbody></table>";
}