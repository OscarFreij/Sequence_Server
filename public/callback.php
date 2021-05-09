<?php

require "../private/db.class.php";

$DB = new DB;

/*
Action "Reg"
{
    POST | startupKey | -->
    POST | username | -->

    RETURN | uniqueKey | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "Login" // Not made yet
{
    POST | startupKey | -->
    POST | uniqueKey | -->

    RETURN | username | <--
    RETURN | score | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "Upload"
{
    POST | uniqueKey | -->
    POST | score | -->
    POST | diff | -->

    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "Display"
{
    POST | displayRequest | -->

    RETURN | data | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}
*/

if (isset($_POST['startupKey']) && isset($_POST['username']))
{
    echo(json_encode($DB->ActionReg($_POST['startupKey'], $_POST['username'])));
}
else if (isset($_POST['uniqueKey']) && isset($_POST['score']) && isset($_POST['diff']))
{
    echo(json_encode($DB->ActionUpload($_POST['uniqueKey'], $_POST['score'], $_POST['diff'])));
}
else if (isset($_POST['startupKey']) && isset($_POST['uniqueKey']))
{
    echo(json_encode($DB->ActionLogin($_POST['startupKey'], $_POST['uniqueKey'])));
}
else if (isset($_POST['displayRequest']))
{
    echo(json_encode($DB->ActionDisplay($_POST['displayRequest'])));
}
else
{
    echo(json_encode(array('responseCode' => "e150", 'msg' => "No sutible action found!")));
}

?>