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
            const item = JSON.parse(response);
            $("#id").val(item.id);
            $("#title").val(item.title);
            $("#description").val(item.description);
            $("#imgUrl").val(item.imgUrl);
            $("#price").val(item.price);
            $("#stock").val(item.stock);
            const tags = item.tags.split(",");
            for (const tag of tags) {
                if (tag === "bread") {
                    $("#bread").prop("checked", true);
                } else if (tag === "wholemeal") {
                    $("#wholemeal").prop("checked", true);
                } else if (tag === "white") {
                    $("#white").prop("checked", true);
                } else if (tag === "cookies") {
                    $("#cookies").prop("checked", true);
                } else if (tag === "savoury") {
                    $("#savoury").prop("checked", true);
                } else if (tag === "sweet") {
                    $("#sweet").prop("checked", true);
                }
            }
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
    <div id="edit-form-container">
        <form class="edit-stock-item-form" method="post" action="includes/edit-stock-item.inc.php">
            <label>Id</label>
            <input id="id" type="text" name="id" readonly="readonly">
            <label>Title</label>
            <input id="title" type="text" name="title">
            <label>Description</label>
            <input id="description" type="text" name="description">
            <label>Image Url</label>
            <input id="imgUrl" type="url" name="imgUrl">
            <label>Price (£)</label>
            <input id="price" type="number" name="price" min="0" step="any">
            <label>Stock</label>
            <input id="stock" type="number" name="stock" min="0" oninput="validity.valid||(value='')" step="1">
            <label>Tags</label>
            <div class="edit-tags">
                <input type="checkbox" id="bread" name="bread" value="bread"/>
                <label for="bread">Bread</label><br>
                <input type="checkbox" id="wholemeal" name="wholemeal" value="wholemeal"/>
                <label for="wholemeal">Wholemeal products</label><br>
                <input type="checkbox" id="white" name="white" value="white"/>
                <label for="white">White flour products</label><br>
                <input type="checkbox" id="cookies" name="cookies" value="cookies"/>
                <label for="cookies">Cookies</label><br>
                <input type="checkbox" id="savoury" name="savoury" value="savoury"/>
                <label for="savoury">Savoury</label><br>
                <input type="checkbox" id="sweet" name="sweet" value="sweet"/>
                <label for="sweet">Sweet</label><br>
            </div>
            <input type="submit" name="edit-stock-item" value="Edit">
        </form>
    </div>
</div>
<?php
    include "includes/foot.inc.php";
?>