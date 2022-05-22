<?php
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";

    if (!isset($_SESSION["userid"])) {
        header("Location: ./login.php");
    } else if (!isset($_GET["id"])) {
        header("Location: ./view-edit-stock.php?error=noid");
    }
?>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const itemId = urlParams.get("id");

    $(document).ready(function () {
        $.ajax({
            method: "GET",
            url: "includes/get-stock-item.inc.php",
            data: { id: itemId }
        })
        .done(function (response) {
            $("#edit-form-container").html(response);
        });
    });
</script>
<div class="edit-stock-item-container">
    <h1>Edit Stock</h1>
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] === "emptyfields") {
                echo "<p class='edit-stock-item-form-error'>Fields cannot be empty!</p>";
            } else {
                echo "<p class='edit-stock-item-form-error'>Error performing action!</p>";
            }
        }
    ?>
    <div id="edit-form-container"></div>
</div>
<?php
    include "includes/foot.inc.php";
?>