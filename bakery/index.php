<?php 
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masonry Bakery</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
    <link rel="stylesheet" href="./css/main.css"/>
</head>
<body>
    <div class="home-header">
        <nav class="nav-bar">
            <a class="nav-home-link" href="./index.php">
                <h1>O</h1>
            </a>
            <section class="nav-links">
                <ul>
                    <li>
                        <a href="#">OUR STORY</a>
                    </li>
                    <li>
                        <a href="#">SHOP</a>
                    </li>
                    <li>
                        <a href="#">MENU</a>
                    </li>
                    <li>
                        <a href="#">LOCATIONS</a>
                    </li>
                </ul>
            </section>
            <section class="nav-actions">
                <a class="nav-action-link" href="#">
                    <img src="./icons/basket.svg" alt="Basket"/>
                </a>
                <a class="nav-action-link" href="#">
                    <img src="./icons/search.svg" alt="Search"/>
                </a>
                <a class="nav-action-link" href="#">
                    <img src="./icons/profile.svg" alt="Profile"/>
                </a>
            </section>
        </nav>
        <div class="title-logo">
            <h1>THE MASONRY BAKERY</h1>
            <p>THE HOME OF FRESH BAKING</p>
        </div>
    </div>

    <div class="divider"></div>
    
    <div class="home-background-info">
        <div class="home-background-info-content">
            <img src="./media/employee-working.png" alt="Employee working"/>
            <div class="home-background-info-text-content">
                <h1>THE MASONRY BAKERY</h1>
                <h2>BASED IN SHROPSHIRE, ENGLAND</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <button class="our-story-button">
                    <h2>OUR STORY</h2>
                </button>
            </div>
        </div>
    </div>

    <div class="divider"></div>
    
    <div class="have-a-nosey-container">
        <a href="#">
            <button class="have-a-nosey-button">
                <h2>HAVE A NOSEY...</h2>
            </button>
        </a>
    </div>
    
    <div class="centre">
        <div class="social-image-gallery">
            <section class="social-caption-group">
                <section class="social-image-gallery-actions">
                    <a class="social-action-link" href="#">
                        <img src="./icons/green-instagram.svg" alt="Instagram"/>
                    </a>
                    <a class="social-action-link" href="#">
                        <img src="./icons/green-facebook.svg" alt="Facebook"/>
                    </a>
                    <a class="social-action-link" href="#">
                        <img src="./icons/green-youtube.svg" alt="YouTube"/>
                    </a>
                </section>
                <h1>SEE MORE ON OUR SOCIALS!</h1>
            </section>
            <div class="image-container">
                <div class="image-container-column">
                    <img src="./media/gallery-pulled-bread.png" alt="Pulling bread in half"/>
                    <img src="./media/gallery-bread-in-boxes.png" alt="Bread in boxes on display"/>
                </div>
                <div class="image-container-column">
                    <img src="./media/gallery-bread-on-baking-rack.png" alt="Bread cooking on baking racks"/>
                    <img src="./media/gallery-bread-knot.png" alt="Bread knots"/>
                </div>
                <div class="image-container-column">
                    <img src="./media/gallery-crossaints.png" alt="Crossaints"/>
                    <img src="./media/gallery-kneeding.png" alt="Kneeding dough"/>
                </div>
                <div class="image-container-column">
                    <img src="./media/gallery-display.png" alt="Bread on display in shop"/>
                    <img src="./media/gallery-bread-from-oven.png" alt="Bread fresh from oven on racks"/>
                </div>
                <div class="image-container-column">
                    <img src="./media/gallery-pastry-and-coffee.png" alt="Pastry's and Coffee"/>
                    <img src="./media/gallery-employees.png" alt="Employees in shop"/>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="footer-divider-container">
            <div class="divider"></div>
            <a class="footer-home-link" href="./index.php">
                <h1>O</h1>
            </a>
        </div>
        <div class="footer-content">
            <section class="footer-actions">
                <a class="footer-action-link footer-action-social-link" href="#">
                    <img src="./icons/mail.svg" alt="Mail"/>
                </a>
                <a class="footer-action-link footer-action-social-link" href="#">
                    <img src="./icons/instagram.svg" alt="Instagram"/>
                </a>
                <a class="footer-action-link footer-action-social-link" href="#">
                    <img src="./icons/facebook.svg" alt="Facebook"/>
                </a>
                <a class="footer-action-link footer-action-social-link" href="#">
                    <img src="./icons/youtube.svg" alt="YouTube"/>
                </a>
            </section>
            <h2>THE MASONRY BAKERY</h2>
            <section class="footer-actions">
                <a class="footer-action-link" href="#">
                    <img src="./icons/basket.svg" alt="Basket"/>
                </a>
                <a class="footer-action-link" href="#">
                    <img src="./icons/search.svg" alt="Search"/>
                </a>
                <a class="footer-action-link" href="#">
                    <img src="./icons/profile.svg" alt="Profile"/>
                </a>
            </section>
        </div>
    </footer>
</body>
</html>