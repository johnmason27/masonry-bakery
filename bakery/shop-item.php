<?php 
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";
?>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const itemId = urlParams.get("id");

    $(document).ready(function () {
        $.ajax({
            method: "GET",
            url: "includes/get-shop-item.inc.php",
            data: { id: itemId }
        })
        .done(function (response) {
            const item = JSON.parse(response);
            $("#shop-item-title").text(item.title);
            $("#shop-item-description").text(item.description)
            $("#shop-item-price").text("£" + item.price);
            $("#shop-item-img").prop("src", item.imgUrl);
            $("#shop-item-img").prop("alt", item.title);
            $("#stock-count").text("Stock levels: " + item.stock);
            $("#item-quantity").prop("max", item.stock);
        });
    });

    function addToBasket() {
        if (event !== undefined) {
            event.preventDefault();
        }

        const quantity = $("#item-quantity").val();

        if (quantity == 0) {
            $(".warning").text("You need to set a quantity");
            $(".feedback").text("");
            return;
        } else {
            $(".warning").text("");
            $(".feedback").text("");
        }

        $.ajax({
            method: "POST",
            url: "includes/add-to-basket.inc.php",
            data: { id: itemId, quantity: quantity }
        })
        .done(function (response) {
            if (response === "success") {
                $(".feedback").text("Added to basket");
            } else {
                $(".feedback").text("Failed to add item to basket");
            }
        });
    }
</script>
<div class="shop-item-view">
    <h1 id="shop-item-title"></h1>
    <p id="shop-item-description"></p>
    <p id="shop-item-price"></p>
    <form>
        <p id="stock-count"></p>
        <p class="warning"></p>
        <label for="item-quantity">Quantity:</label>
        <input id="item-quantity" type="number" min="0" oninput="validity.valid||(value='')">
        <button onclick="addToBasket()"><p>Add to basket</p></button>
        <p class="feedback"></p>
    </form>
    <img id="shop-item-img"/>
</div>
<?php
    include "includes/foot.inc.php";
?>