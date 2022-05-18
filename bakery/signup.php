<?php
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";
?>
<div class="signup-container">
    <h1>Signup</h1>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="username" placeholder="Username" value="<?php echo ((isset($_GET["username"])) ? $_GET["username"] : '')?>">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="passwordConfirm" placeholder="Confirm Password">
        <input type="submit" name="signup-submit" value="Signup">
    </form>
    <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] === "blankusername") {
                echo "<p class='signup-error'>Username cannot be blank!</p>";
            } else if ($_GET["error"] === "invalidusername") {
                echo "<p class='signup-error'>Invalid username!</p>";
            } else if ($_GET["error"] === "blankpassword") {
                echo "<p class='signup-error'>Password cannot be blank</p>";
            } else if ($_GET["error"] === "invalidpassword") {
                echo "<p class='signup-error'>Password must be between 8 and 64 characters long!</p>";
            } else if ($_GET["error"] === "passwordCheck") {
                echo "<p class='signup-error'>Passwords don't match!</p>";
            } else if ($_GET["error"] === "usertaken") {
                echo "<p class='signup-error'>Username taken!</p>";
            }  else {
                echo "<p class='signup-error'>Signup error!</p>";
            }
        }

        if (isset($_GET["signup"])) {
            if ($_GET["signup"] === "success") {
                echo "<p class='signup-success'>Account created!</p>";
            }
        }
    ?>
</div>
<?php
    include "includes/foot.inc.php";
?>