<?php

require "../private/db.class.php";
$DB = new DB;

$currentPage = "home";
if (isset($_GET['page']))
{
    $currentPage = $_GET['page'];
}
?>

<!DOCTYPE html>
<html lang="en">
<?php    
require("../private/modules/head.php");
?>
<body>
    <?php
    require("../private/modules/navbar.php");

    switch($currentPage)
    {
        case "home":
            require("../private/pages/home.php");
            break;
        case "about":
            require("../private/pages/about.php");
            break;
        case "search":
            require("../private/pages/searchPage.php");
            break;
        case "score":
            require("../private/pages/scoreboard.php");
            break;
        default:
            require("../private/pages/errorPages/404.php");
            break;
    }    
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>