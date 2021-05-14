<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/master.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src="static/js/navbar-dropdown-hover.js"></script>
    <script src="static/js/main.js"></script>
    <?php
    // include scripts and css for specific pages!
    switch($currentPage)
    {
        case "home":
            echo('<title>Home</title>');
            break;
        case "about":
            echo("<title>About</title>");
            break;
        case "search":
            echo("<title>Search results</title>");
            break;
        case "score":
            echo("<title>Scoreboard</title>");
            echo('<script src="static/js/scoreboard.js"></script>');
            break;
    } 
    ?>
</head>