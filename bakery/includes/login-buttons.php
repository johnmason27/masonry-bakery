<?php 
    if (isset($_SESSION["userId"])) {
        echo '<ul class="ul-button">
                <form action="./includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button>
                </form>
            </ul>';
    } else {
        echo '<ul class="ul-button">
                <form action="./includes/login.inc.php" method="post">
                    <input type="text" name="mailuid" placeholder="Username/Email...">
                    <input type="password" name="password" placeholder="Password">
                    <button type="submit" name="login-submit">Login</button>
                </form>
            </ul>
            <ul class="ul-button">
                <a href="signup.php">Sign up</a>
            </ul>';
    }
?>

