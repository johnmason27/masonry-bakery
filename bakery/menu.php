<?php 
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";
    require "includes/dbh.inc.php";

    $styleSheet = "menu-default-colours";

    if (isset($_COOKIE["useColourContrast"])) {
        $styleSheet = $_COOKIE["useColourContrast"];
    }

    if (isset($_POST["changeStyle"])) {
        $styleSheet = $_POST["changeStyle"];
    }

    setcookie("useColourContrast", $styleSheet);
?>
<link rel="stylesheet" href="css/<?= $styleSheet; ?>.css">
<div class="menu-container">
    <h1>MENU</h1>
    <form class="colour-settings" method="post" action="<?= $_SERVER["PHP_SELF"];?>">
        <input type="submit" name="changeStyle" value="menu-default-colours"><br>
        <input type="submit" name="changeStyle" value="menu-high-contrast-colours"><br>
    </form>
    <div class="menu-items menu-items-drinks">
        <h2>DRINKS</h2>
        <div class="menu-items-group">
            <h3>IRON & FIRE COFFEE</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'IronAndFireCoffee'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>LATTES</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'Lattes'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>TEAPIGS TEAS</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'TeapigsTeas'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>HOT CHOCOLATE</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'HotChocolate'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>SOFT DRINKS</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'SoftDrinks'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>SMOOTHIES & JUICES</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'SmoothiesAndJuices'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>COCKTAILS</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'Cocktails'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>CRAFT BEERS</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'CraftBeers'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
        <div class="menu-items-group">
            <h3>ORGANIC WINES</h3>
            <?php 
                $sql = "SELECT title, price, hint FROM drinks_menu WHERE type = 'OrganicWines'";
                $response = mysqli_query($conn, $sql);

                if (!$response) {
                    exit;
                }

                $num_records = mysqli_num_rows($response);
                
                if ($num_records == 0) {
                    print("<p>No mains in the database sorry...</p>");
                } else {
                    echo"<ul>";
                    while ($row = mysqli_fetch_assoc($response)) {
                        echo "
                        <li>
                            <p>
                                <span class='drink-title'>".$row["title"]."</span>
                                <span class='drink-price'>".$row["price"]."</span>
                            </p>";
                        if (!empty($row["hint"])) {
                            echo "<p class='hint'><span class='italic'>".$row["hint"]."</span></p>";
                        }
                        echo"</li>";
                    }
                    echo"</ul>";
                }
            ?>
        </div>
    </div>
    <div class="menu-items menu-items-main">
        <h2>BRIOCHE & BENEDICTS</h2>
        <?php 
            $sql = "SELECT title, description, hint, category, price FROM main_menu WHERE category = 'BriocheAndBenedicts'";
            $response = mysqli_query($conn, $sql);

            if (!$response) {
                exit;
            }

            $num_records = mysqli_num_rows($response);
            
            if ($num_records == 0) {
                print("<p>No mains in the database sorry...</p>");
            } else {
                echo"<ul>";
                while ($row = mysqli_fetch_assoc($response)) {
                    echo "
                    <li>
                    <div class='menu-item'>
                            <h3>".$row["title"]." ".$row["price"]."</h3>
                            <p>".$row["description"]."</p>
                            ";
                    if (!empty($row["hint"])) {
                        echo "<p>+ <span class='italic'>fried egg</span></p>";
                    }
                    echo "</div>
                    </li>
                    ";
                }
                echo"</ul>";
            }
        ?>
    </div>
    <div class="menu-items menu-items-main">
        <h2>SOURDOUGH TOAST</h2>
        <?php 
            $sql = "SELECT title, description, hint, category, price FROM main_menu WHERE category = 'SourdoughToast'";
            $response = mysqli_query($conn, $sql);

            if (!$response) {
                exit;
            }

            $num_records = mysqli_num_rows($response);
            
            if ($num_records == 0) {
                print("<p>No mains in the database sorry...</p>");
            } else {
                echo"<ul>";
                while ($row = mysqli_fetch_assoc($response)) {
                    echo "
                    <li>
                    <div class='menu-item'>
                            <h3>".$row["title"]." ".$row["price"]."</h3>
                            <p>".$row["description"]."</p>
                            ";
                    if (!empty($row["hint"])) {
                        echo "<p>+ <span class='italic'>fried egg</span></p>";
                    }
                    echo "</div>
                    </li>
                    ";
                }
                echo"</ul>";
            }
        ?>
    </div>
    <div class="menu-items menu-items-main">
        <h2>SWEET</h2>
        <?php 
            $sql = "SELECT title, description, hint, category, price FROM main_menu WHERE category = 'Sweet'";
            $response = mysqli_query($conn, $sql);

            if (!$response) {
                exit;
            }

            $num_records = mysqli_num_rows($response);
            
            if ($num_records == 0) {
                print("<p>No mains in the database sorry...</p>");
            } else {
                echo"<ul>";
                while ($row = mysqli_fetch_assoc($response)) {
                    echo "
                    <li>
                    <div class='menu-item'>
                            <h3>".$row["title"]." ".$row["price"]."</h3>
                            <p>".$row["description"]."</p>
                            ";
                    if (!empty($row["hint"])) {
                        echo "<p>+ <span class='italic'>fried egg</span></p>";
                    }
                    echo "</div>
                    </li>
                    ";
                }
                echo"</ul>";
            }
        ?>
    </div>
    <div class="menu-items menu-items-main">
        <h2>BRUNCH</h2>
        <?php 
            $sql = "SELECT title, description, hint, category, price FROM main_menu WHERE category = 'Brunch'";
            $response = mysqli_query($conn, $sql);

            if (!$response) {
                exit;
            }

            $num_records = mysqli_num_rows($response);
            
            if ($num_records == 0) {
                print("<p>No mains in the database sorry...</p>");
            } else {
                echo"<ul>";
                while ($row = mysqli_fetch_assoc($response)) {
                    echo "
                    <li>
                    <div class='menu-item'>
                            <h3>".$row["title"]." ".$row["price"]."</h3>
                            <p>".$row["description"]."</p>
                            ";
                    if (!empty($row["hint"])) {
                        echo "<p>+ <span class='italic'>fried egg</span></p>";
                    }
                    echo "</div>
                    </li>
                    ";
                }
                echo"</ul>";
            }
        ?>
    </div>
    <div class="menu-items menu-items-main">
        <h2>LUNCH</h2>
        <?php 
            $sql = "SELECT title, description, hint, category, price FROM main_menu WHERE category = 'Lunch'";
            $response = mysqli_query($conn, $sql);

            if (!$response) {
                exit;
            }

            $num_records = mysqli_num_rows($response);
            
            if ($num_records == 0) {
                print("<p>No mains in the database sorry...</p>");
            } else {
                echo"<ul>";
                while ($row = mysqli_fetch_assoc($response)) {
                    echo "
                    <li>
                    <div class='menu-item'>
                            <h3>".$row["title"]." ".$row["price"]."</h3>
                            <p>".$row["description"]."</p>
                            ";
                    if (!empty($row["hint"])) {
                        echo "<p>+ <span class='italic'>fried egg</span></p>";
                    }
                    echo "</div>
                    </li>
                    ";
                }
                echo"</ul>";
            }
        ?>
    </div>
    <div class="menu-items menu-items-main">
        <h2>GRILLED SOURDOUGH SANDWICHES</h2>
        <?php 
            $sql = "SELECT title, description, hint, category, price FROM main_menu WHERE category = 'GrilledSourdoughSandwiches'";
            $response = mysqli_query($conn, $sql);

            if (!$response) {
                exit;
            }

            $num_records = mysqli_num_rows($response);
            
            if ($num_records == 0) {
                print("<p>No mains in the database sorry...</p>");
            } else {
                echo"<ul>";
                while ($row = mysqli_fetch_assoc($response)) {
                    echo "
                    <li>
                    <div class='menu-item'>
                            <h3>".$row["title"]." ".$row["price"]."</h3>
                            <p>".$row["description"]."</p>
                            ";
                    if (!empty($row["hint"])) {
                        echo "<p>+ <span class='italic'>fried egg</span></p>";
                    }
                    echo "</div>
                    </li>
                    ";
                }
                echo"</ul>";
            }
        ?>
    </div>
    <div class="menu-items menu-items-sides">
        <h2>SIDES + ADD ONS</h2>
        <?php 
            $sql = "SELECT title, price FROM sides_menu";
            $response = mysqli_query($conn, $sql);

            if (!$response) {
                exit;
            }

            $num_records = mysqli_num_rows($response);
            
            if ($num_records == 0) {
                print("<p>No sides in the database sorry...</p>");
            } else {
                echo"<ul>";
                while ($row = mysqli_fetch_assoc($response)) {
                    echo "
                    <li>
                        <div class='menu-item'>
                            <p>".$row["title"]." ".$row["price"]."</p>
                        </div>
                    </li>
                    ";
                }
                echo"</ul>";
            }
        ?>
    </div>
    <div class="allergy-warning">
        <div>
            <p>
                * please ask your server for dairy free butters
            </p>
            <p>
                Unfortunately changes to our menu are not available during our busy periods.
            </p>
        </div>
        <div>
            <p>
                Please inform us of any allergies or intolerances you have have before ordering - all our food is prepared in a bakery & we cannot guarantee ther has been no contact with wheat or nuts.
            </p>
        </div>
    </div>
</div>
<?php 
    include "includes/foot.inc.php"
?>