<?php
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";

    if (count($_SESSION["basket"]) === 0) {
        header("Location: ./shop.php");
        exit();
    }
?>
<script>
    $(document).ready(function () {
        $.ajax({
            method: "GET",
            url: "includes/get-order-summary.inc.php"
        })
        .done(function (response) {
            $("#order-details").html(response);
        });
    });
</script>
<div class="complete-order-container">
    <h1>Complete Order</h1>
    <h2>Order details</h2>
    <div id="order-details"></div>
    <h2>Shipping details</h2>
    <?php 
        if (isset($_GET["error"])) {
            if ($_GET["error"] === "emptyfields") {
                echo "<p class='complete-order-warning'>Fill in the fields!</p>";
            } else if ($_GET["error"] === "invalidforename") {
                echo "<p class='complete-order-warning'>Invalid forename!</p>";
            } else if ($_GET["error"] === "invalidsurname") {
                echo "<p class='complete-order-warning'>Invalid surname!</p>";
            } else if ($_GET["error"] === "invalidemail") {
                echo "<p class='complete-order-warning'>Invalid email!</p>";
            } else if ($_GET["error"] === "invalidaddress") {
                echo "<p class='complete-order-warning'>Invalid address!</p>";
            } else if ($_GET["error"] === "invalidpostcode") {
                echo "<p class='complete-order-warning'>Invalid postcode!</p>";
            } else {
                echo "<p class='complete-order-warning'>Cannot complete order!</p>";
            }
        }
    ?>
    <form class="order-form" action="includes/complete-order.inc.php" method="POST">
        <label for="forename">Forename</label>
        <input id="forename" autocomplete="name" type="text" name="forename" value="<?php echo ((isset($_GET["forename"])) ? $_GET["forename"] : '')?>"/>
        <label for="surname">Surname</label>
        <input id="surname" autocomplete="name" type="text" name="surname" value="<?php echo ((isset($_GET["surname"])) ? $_GET["surname"] : '')?>"/>
        <label for="email">Email</label>
        <input id="email" autocomplete="email" type="email" name="email" value="<?php echo ((isset($_GET["email"])) ? $_GET["email"] : '')?>"/>
        <label for="address">Address</label>
        <textarea id="address" autocomplete="address-line1" name="address"><?php echo ((isset($_GET["address"])) ? $_GET["address"] : '')?></textarea>
        <label for="postcode">Postcode</label>
        <input id="postcode" type="text" name="postcode" value="<?php echo ((isset($_GET["postcode"])) ? $_GET["postcode"] : '')?>"/>
        <input type="submit" name="complete-order" value="Order"/>
    </form>
</div>
<?php
    include "includes/foot.inc.php";
?>