<?php
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";
?>
<div class="profile-container">
    <?php
        if (isset($_SESSION["userid"])) {
            echo "<div class='profile-logged-in-container'>
                <h1>Hello, ".$_SESSION["username"]."</h1>
                <a href='view-edit-stock.php'>View/Edit Stock</a>
                <a href='view-orders.php'>View Orders</a>
                <form action='includes/logout.inc.php' method='post'><input type='submit' value='Logout'></form>
            </div>";
        } else {
            echo "<div class='profile-logged-out-container'>
                <h1>Your not logged in!</h1>
                <a href='login.php'>Login</a>
                <a href='signup.php'>Signup</a>
            </div>";
        }
    ?>
</div>
<?php
    include "includes/foot.inc.php";
?>