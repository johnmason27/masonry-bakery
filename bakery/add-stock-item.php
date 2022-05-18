<?php
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";

    if (!isset($_SESSION["userid"])) {
        header("Location: ./login.php");
    }
?>
<div class="add-stock-item-container">
    <h1>Add new stock item</h1>
    <?php 
        if (isset($_GET["error"])) {
            if ($_GET["error"] === "blankfields") {
                echo "<p class='add-stock-item-form-error'>Fields cannot be empty!</p>";
            } else {
                echo "<p class='add-stock-item-form-error'>Error adding item.</p>";
            }
        }
    ?>
    <form class="add-stock-item-form" method="post" action="includes/add-stock-item.inc.php">
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
        <div class="add-tags">
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
        <input type="submit" name="add-stock-item" value="Add">
    </form>
</div>
<?php
    include "includes/foot.inc.php";
?>