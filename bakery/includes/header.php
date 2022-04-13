<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link rel="stylesheet" href="css/main-theme.css"/>
    <title>Masonry Bakery</title>
</head>
<body>
    <img src="./icons/background-with-logo.svg" alt="Background with logo" />
    <nav class="nav-bar">
        <li class="nav-links">
            <ul><a href="#">Shop</a></ul>
            <ul><a href="#">Menu</a></ul>
            <ul><a href="#">Locations</a></ul>
            <ul><a href="#">About</a></ul>
        </li>
        <li class="nav-links nav-icons">
            <?php include"./includes/login-buttons.php"?>
            <ul><a href="#"><img src="./icons/search.svg" alt="Search"/></a></ul>
            <ul><a href="#"><img src="./icons/basket.svg" alt="Basket"/></a></ul>
        </li>
    </nav>