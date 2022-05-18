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
            url: "includes/get-orders.inc.php"
        })
        .done(function (response) {
            $("#orders").html(response);
        });
    });
</script>
<div class="view-orders-container">
    <h1>Orders</h1>
    <div id="orders"></div>
</div>
<?php
    include "includes/foot.inc.php";
?>