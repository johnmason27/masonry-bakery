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
            $(".shop-item-view").html(response);
        });
    });

    function addToBasket() {
        if (event !== undefined) {
            event.preventDefault();
        }

        const quantity = $("#item-quantity").val();

        if (quantity == 0) {
            $(".shop-item-form").append("<p class='warning'>You need to set a quantity</p>");
            $(".feedback").remove();
            return;
        } else {
            $(".warning").remove();
            $(".feedback").remove();
        }

        $.ajax({
            method: "POST",
            url: "includes/add-to-basket.inc.php",
            data: { id: itemId, quantity: quantity }
        })
        .done(function (response) {
            if (response === "success") {
                $(".shop-item-form").append("<p class='feedback'>Added to basket</p>");
            } else {
                $(".shop-item-form").append("<p class='feedback'>Failed to add item to basket</p>");
            }
        });
    }
</script>
<div class="shop-item-view"></div>
<?php
    include "includes/foot.inc.php";
?>