<?php 
    include "includes/head.inc.php";
    include "includes/navbar-wrapper.inc.php";
?>    
<script>
    $(document).ready(function () {
        $.ajax({
            method: "GET",
            url: "includes/get-shop-items.inc.php"
        })
        .done(function (response) {
            $("#shop-items").html(response);
        });
    });

    function search() {
        if (event !== undefined) {
            event.preventDefault();
        }

        $.ajax({
            method: "POST",
            url: "includes/get-shop-items.inc.php",
            data: { searchValue: $("#search-box").val() }
        })
        .done(function (response) {
            $("#shop-items").html(response);
        });
    }

    function applyFilter() {
        if (event !== undefined) {
            event.preventDefault();
        }

        $(".sort-by input[type='radio']:checked").prop("checked", false);

        const filters = [];
        $.each($(".filters-form input[type='checkbox']:checked"), function () {
            filters.push($(this).val());
        });

        $.ajax({
            method: "POST",
            url: "includes/get-shop-items.inc.php",
            data: { filters: filters }
        })
        .done(function (response) {
            $("#shop-items").html(response);
        });
    }

    function applySortBy() {
        if (event !== undefined) {
            event.preventDefault();
        }

        $.each($(".filters-form input[type='checkbox']:checked"), function () {
            $(this).prop("checked", false);
        });

        let selectedSortByItem = "";
        const selectedButton = $(".sort-by input[type='radio']:checked");
        if (selectedButton.length > 0) {
            selectedSortByItem = selectedButton.val();
        }

        $.ajax({
            method: "POST",
            url: "includes/get-shop-items.inc.php",
            data: { sortBy: selectedSortByItem }
        })
        .done(function (response) {
            $("#shop-items").html(response);
        });
    }

    function clear() {
        if (event !== undefined) {
            event.preventDefault();
        }

        $.ajax({
            method: "GET",
            url: "includes/get-shop-items.inc.php"
        })
        .done(function (response) {
            $("#shop-items").html(response);
        });
    }
</script>
<div class="shop-container">
    <h1>SHOP</h1>
    <h2>View & Purchase goods online</h2>
    <div class="shop-filters">
        <form class="search-bar-form">
            <input type="text" id="search-box" placeholder="Search..."/>
            <button class="shop-filter-search-button" onclick="search()" type="submit">
                <img src="icons/black-search.svg" alt="Search icon"/>
            </button>
        </form>
        <div class="filters">
            <h3>Filters</h3>
            <form class="filters-form">
                <input type="checkbox" id="bread" value="bread"/>
                <label for="bread">Bread</label><br>
                <input type="checkbox" id="wholemeal" value="wholemeal"/>
                <label for="wholemeal">Wholemeal products</label><br>
                <input type="checkbox" id="white" value="white"/>
                <label for="white">White flour products</label><br>
                <input type="checkbox" id="cookies" value="cookies"/>
                <label for="oldecookiesst">Cookies</label><br>
                <input type="checkbox" id="savoury" value="savoury"/>
                <label for="savoury">Savoury</label><br>
                <input type="checkbox" id="sweet" value="sweet"/>
                <label for="sweet">Sweet</label><br>
                <input type="submit" onclick="applyFilter()" value="Filter"/>
                <input type="submit" onclick="clear()" value="Clear"/>
            </form>
        </div>
        <div class="sort-by">
            <h3>Sort by</h3>
            <form class="sort-by-form">
                <input type="radio" id="lowToHigh" name="sortBy" value="lowToHigh"/>
                <label for="lowToHigh">Price low to high</label><br>
                <input type="radio" id="highToLow" name="sortBy" value="highToLow"/>
                <label for="highToLow">Price high to low</label><br>
                <input type="radio" id="newest" name="sortBy" value="newest"/>
                <label for="newest">Newest</label><br>
                <input type="radio" id="oldest" name="sortBy" value="oldest"/>
                <label for="oldest">Oldest</label><br>
                <input type="submit" onclick="applySortBy()" value="Sort"/>
                <input type="submit" onclick="clear()" value="Clear"/>
            </form>
        </div>
    </div>
    <div class=".shop-items" id="shop-items"></div>
</div>
<?php 
    include "includes/foot.inc.php"
?>