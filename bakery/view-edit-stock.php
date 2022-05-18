<?php
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";

    if (!isset($_SESSION["userid"])) {
        header("Location: ./login.php");
    }
?>
<script>
    $(document).ready(function () {
        $.ajax({
            method: "GET",
            url: "includes/get-stock.inc.php"
        })
        .done(function (response) {
            $("#stock").html(response);
        });
    });

    function removeStockItem(id) {
        $("#stock-table-row-" + id).remove();
        
        $.ajax({
            method: "POST",
            url: "includes/remove-stock-item.inc.php",
            data: { id: id }
        });

        $(".view-edit-stock-message").text("Removed stock item!");
    }
</script>
<div class="view-edit-stock-container">
    <h1>View/Edit Stock</h1>
    <?php
        if (isset($_GET["success"])) {
            if ($_GET["success"] === "edit") {
                echo "<p class='view-edit-stock-message'>Stock item edited!</p>";
            } else if ($_GET["success"] === "added") {
                echo "<p class='view-edit-stock-message'>Stock item added!</p>";
            }
        } else if (isset($_GET["error"])) {
            if ($_GET["error"]) {
                echo "<p class='view-edit-stock-message'>Error performing action!</p>";
            }
        }
    ?>
    <p class="view-edit-stock-message"></p>
    <a href="add-stock-item.php"><button class="stock-add-button">Add stock</button></a>
    <div id="stock"></div>
</div>
<?php
    include "includes/foot.inc.php";
?>