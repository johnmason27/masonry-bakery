<?php 
    include"./includes/header.php"
?>

    <main>
        <h1>Sign up</h1>
        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] === "emptyfields") {
                    echo '<p>Fill in all fields!</p>';
                } else if ($_GET["error"] === "invalidemailuid") {
                    echo '<p>Invalid username and email!</p>';
                } else if ($_GET["error"] === "invalidemail") {
                    echo '<p>Invalid email!</p>';
                } else if ($_GET["error"] === "invaliduid") {
                    echo '<p>Invalid username!</p>';
                } else if ($_GET["error"] === "passwordcheck") {
                    echo '<p>Your passwords do not match!</p>';
                } else if ($_GET["error"] === "usertaken") {
                    echo '<p>Username is already taken</p>';
                } else if ($_GET["error"] === "sqlerror") {
                    echo '<p>DATABASE ERROR</p>';
                } 
            } else if (isset($_GET["signup"])) {
                if ($_GET["signup"] === "success") {
                    echo '<p>Sign up successful!</p>';
                }
            }
        ?>
        <form action="./includes/signup.inc.php" method="post">
            <input 
                type="text" 
                name="uid" 
                placeholder="Username" 
                value="<?php echo (isset($_GET["uid"]))?$_GET["uid"]:'';?>">
            <input 
                type="text" 
                name="email" 
                placeholder="Email" 
                value="<?php echo (isset($_GET["email"]))?$_GET["email"]:'';?>">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="password-repeat" placeholder="Repeat password">
            <button type="submit" name="signup-submit">Sign up</button>
        </form>        
    </main>

<?php 
    include"./includes/footer.php"
?>
