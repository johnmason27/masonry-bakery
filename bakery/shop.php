<?php 
    include"includes/head.inc.php";
    include"includes/navbar-wrapper.inc.php";

    if (isset($_POST["clearFilters"])) {
        unset($_POST["bread"]);
        unset($_POST["wholemeal"]);
        unset($_POST["white"]);
        unset($_POST["cookies"]);
        unset($_POST["savoury"]);
        unset($_POST["sweet"]);
    }
?>    

<script>
    $(document).ready(function() {
        if (localStorage.sortBySelected) {
            $("#" + localStorage.sortBySelected ).attr("checked", true);
        }

        $(".sortByButton").click(function() {
            if (localStorage.sortBySelected) {
                $("#" + localStorage.sortBySelected ).prop("checked", false);
            }
            
            localStorage.setItem("sortBySelected", this.id);
        });

        $("#clearSortBy").click(function() {
            localStorage.removeItem("sortBySelected", this.id);
        });
    });
</script>
<div class="shop-container">
    <h1>SHOP</h1>
    <h2>View & Purchase goods online</h2>
    <div class="shop-filters">
        <form class="search-bar-form" action="<?= $_SERVER["PHP_SELF"];?>" method="POST">
            <input type="text" name="searchInput" placeholder="Search..."/>
            <button class="shop-filter-search-button" name="search" type="submit">
                <img src="icons/black-search.svg" alt="Search icon"/>
            </button>
        </form>
        <div class="filters">
            <h3>Filters</h3>
            <form class="filters-form" action="<?= $_SERVER["PHP_SELF"];?>" method="POST">
                <input type="checkbox" id="bread" name="bread" value="bread" <?php if(isset($_POST["bread"])){ echo " checked='checked'"; } ?>/>
                <label for="bread">Bread</label><br>
                <input type="checkbox" id="wholemeal" name="wholemeal" value="wholemeal" <?php if(isset($_POST["wholemeal"])){ echo " checked='checked'"; } ?>/>
                <label for="wholemeal">Wholemeal products</label><br>
                <input class="filter-form-item" type="checkbox" id="white" name="white" value="white" <?php if(isset($_POST["white"])){ echo " checked='checked'"; } ?>/>
                <label for="white">White flour products</label><br>
                <input class="filter-form-item" type="checkbox" id="cookies" name="cookies" value="cookies" <?php if(isset($_POST["cookies"])){ echo " checked='checked'"; } ?>/>
                <label for="oldecookiesst">Cookies</label><br>
                <input class="filter-form-item" type="checkbox" id="savoury" name="savoury" value="savoury" <?php if(isset($_POST["savoury"])){ echo " checked='checked'"; } ?>/>
                <label for="savoury">Savoury</label><br>
                <input class="filter-form-item" type="checkbox" id="sweet" name="sweet" value="sweet" <?php if(isset($_POST["sweet"])){ echo " checked='checked'"; } ?>/>
                <label for="sweet">Sweet</label><br>
                <input type="submit" name="applyFilters" value="Filter"/>
                <input type="submit" name="clearFilters" value="Clear"/>
            </form>
        </div>
        <div class="sort-by">
            <h3>Sort by</h3>
            <form class="sort-by-form" action="<?= $_SERVER["PHP_SELF"];?>" method="POST">
                <input class="sortByButton" type="radio" id="lowToHigh" name="lowToHigh" value="lowToHigh"/>
                <label for="lowToHigh">Price low to high</label><br>
                <input class="sortByButton" type="radio" id="highToLow" name="highToLow" value="highToLow"/>
                <label for="highToLow">Price high to low</label><br>
                <input class="sortByButton" type="radio" id="newest" name="newest" value="newest"/>
                <label for="newest">Newest</label><br>
                <input class="sortByButton" type="radio" id="oldest" name="oldest" value="oldest"/>
                <label for="oldest">Oldest</label><br>
                <input type="submit" name="sortBy" value="Sort"/>
                <input type="submit" id="clearSortBy" value="Clear"/>
            </form>
        </div>
    </div>
    <?php
        require "includes/dbh.inc.php";
        $sql = "SELECT id, title, description, imgUrl, price, added, stock, sold FROM shop";
        $stmt = mysqli_stmt_init($conn);
        
        if (isset($_POST["applyFilters"])) {
            $searchQuery = " WHERE";
            $searchQueryItems = array();
            
            if (isset($_POST["bread"])) {
                $breadFilter = $_POST["bread"];
                $breadFilterQuery = " tags LIKE '%$breadFilter%'";
                array_push($searchQueryItems, $breadFilterQuery);
            }
            if (isset($_POST["wholemeal"])) {
                $wholemealFilter = $_POST["wholemeal"];
                $wholemealFilterQuery = " tags LIKE '%$wholemealFilter%'";
                array_push($searchQueryItems, $wholemealFilterQuery);
            }
            if (isset($_POST["white"])) {
                $whiteFilter = $_POST["white"];
                $whiteFilterQuery = " tags LIKE '%$whiteFilter%'";
                array_push($searchQueryItems, $whiteFilterQuery);
            }
            if (isset($_POST["cookies"])) {
                $cookiesFilter = $_POST["cookies"];
                $cookiesFilterQuery = " tags LIKE '%$cookiesFilter%'";
                array_push($searchQueryItems, $cookiesFilterQuery);
            }
            if (isset($_POST["savoury"])) {
                $savouryFilter = $_POST["savoury"];
                $savouryFilterQuery = " tags LIKE '%$savouryFilter%'";
                array_push($searchQueryItems, $savouryFilterQuery);
            }
            if (isset($_POST["sweet"])) {
                $sweetFilter = $_POST["sweet"];
                $sweetFilterQuery = " tags LIKE '%$sweetFilter%'";
                array_push($searchQueryItems, $sweetFilterQuery);
            }
        
            for ($x = 0; $x < count($searchQueryItems); $x++) {
                if ($x === 0) {
                    $searchQuery .= $searchQueryItems[0];
                } else {
                    $searchQuery .= " OR ".$searchQueryItems[$x];
                }
            }
            $sql .= $searchQuery;
        } else if (isset($_POST["sortBy"])) {            
            if (isset($_POST["lowToHigh"])) {
                $sql .= " ORDER BY price ASC";
            } else if (isset($_POST["highToLow"])) {
                $sql .= " ORDER BY price DESC";
            } else if (isset($_POST["newest"])) {
                $sql .= " ORDER BY added DESC";
            } else if (isset($_POST["oldest"])) {
                $sql .= " ORDER BY added ASC";
            }
        } else if (isset($_POST["search"])) {
            if (isset($_POST["searchInput"])) {
                $queryString = $_POST["searchInput"];
                $query = " WHERE title LIKE '%$queryString%'";
                $query .= " OR description LIKE '%$queryString%'";
                $query .= " OR description LIKE '%$queryString%'";
                $query .= " OR tags LIKE '%$queryString%'";
                $sql .= $query;
            }
        }

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            exit();
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            echo "<div class='shop-items'>";
            while ($row = mysqli_fetch_assoc($result)) {                
                $isLowStock = false;
                $isPopular = false;

                if ($row["stock"] < 3) {
                    $isLowStock = true;
                }

                if ($row["sold"] >= 15) {
                    $isPopular = true;
                }

                echo "
                    <a class='shop-item' href='".$row["id"]."'>
                        <img src=".$row["imgUrl"]." alt=".$row["title"]." />
                        <div class='shop-item-text'>";
                if ($isPopular) {
                    echo "<p class='alert'>Best Seller</p>";
                } else if ($isLowStock) {
                    echo "<p class='alert'>Low Stock</p>";
                }
                echo "<p class='title'>".$row["title"]."</p>
                            <p class='description'>".$row["description"]."</p>
                            <p class='price'>£".$row["price"]."</p>
                        </div>
                    </a>";
            }
            echo "</div>";
        }
    ?>
</div>
<?php 
    include"includes/foot.inc.php"
?>