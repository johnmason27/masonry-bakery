<?php 
    include"./includes/header.php"
?>

    <main>
        <?php 
            if (isset($_SESSION["userId"])) {
                echo "<p>You are logged in!</p>";
            } else {
                echo "<p>You are logged out!</p>";
            }
        ?>

        <div class="image-row">
            <div class="image-collumn">
                <img src="./media/making-bread.png" alt="Making bread with hands" style="width:100%"/>
                <img src="media/laughing.png" alt="Employees laughing" style="width:100%"/>
            </div>
            <div class="image-collumn">
                <img src="./media/opening-bread.png" alt="Opening Bread with hands" style="width:100%"/>
                <img src="./media/bread.png" alt="Bread" style="width:100%"/>
            </div>
            <div class="image-collumn">
                <img src="./media/crossaints.png" alt="Freshly baked crossaint" style="width:100%"/>
                <img src="./media/bagging.png" alt="Bagging up bread product" style="width:100%"/>
            </div>
        </div>
    </main>

<?php 
    include"./includes/footer.php"
?>
