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

        $(".stock-container-header").append("<p class='view-edit-stock-message'>Removed stock item!</p>");
    }
</script>
<div class="view-edit-stock-container">
    <div class="stock-container-header">
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
        <a class="stock-edit-button" href="add-stock-item.php">Add stock</a>
    </div>
    <div id="stock"></div>
</div>
<?php
    include "includes/foot.inc.php";
?>