<?php
session_start();
unset($_SESSION["userid"]);
unset($_SESSION["username"]);

header("Location: ../profile.php");
exit();