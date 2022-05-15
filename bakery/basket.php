<?php 
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";
?>
<script>
    $(document).ready(function () {
        $.ajax({
            method: "GET",
            url: "includes/get-basket.inc.php"
        })
        .done(function (response) {
            $(".basket-items").html(response);
        });
    });

    function removeItem(id) {
        $("#item-" + id).remove();
        
        $.ajax({
            method: "POST",
            url: "includes/remove-basket-item.inc.php",
            data: { id: id }
        });

        if ($(".basket-item").length === 0) {
            $(".basket-items").html(`<div class='basket-empty'>
                <p>No items in your basket! Go to the <a href='shop.php'>shop</a> to add some.</p>
            </div>`);
        }
    }

    function clearBasket() {
        $.each($(".basket-item"), function () {
            $(this).remove();
        });

        $.ajax({
            method: "POST",
            url: "includes/clear-basket.inc.php"
        });

        if ($(".basket-item").length === 0) {
            $(".basket-items").html(`<div class='basket-empty'>
                <p>No items in your basket! Go to the <a href='shop.php'>shop</a> to add some.</p>
            </div>`);
        }
    }
</script>
<?php 
    if (isset($_GET["success"])) {
        if ($_GET["success"] === "completedorder") {
            echo "<p class='basket-order-completed'>Order completed</p>";
        }
    } else {
        echo "<div class='basket-items'></div>";
    }
?>
<?php 
    include "includes/foot.inc.php";
?>