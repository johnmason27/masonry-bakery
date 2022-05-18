<?php
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";
?>
<div class="login-container">
    <h1>Login</h1>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="login-submit" value="Login">
    </form>
    <a class="signup-link" href="signup.php">Sign up</a>
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] === "emptyfields") {
                echo "<p class='login-error'>Fields blank!</p>";
            } else if ($_GET["error"] === "nouser") {
                echo "<p class='login-error'>Incorrect Username!</p>";
            } else if ($_GET["error"] === "wrongpassword") {
                echo "<p class='login-error'>Incorrect Password!</p>";
            } else {
                echo "<p class='login-error'>Login error!</p>";
            }
        }
    ?>
</div>
<?php
    include "includes/foot.inc.php";
?>