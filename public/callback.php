<?php

require "../private/db.class.php";

$DB = new DB;

/*
Action "reg"
{
    POST | startupKey | -->
    POST | username | -->

    RETURN | uniqueKey | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "upload"
{
    POST | uniqueKey | -->
    POST | score | -->
    POST | diff | -->

    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "login"
{
    POST | startupKey | -->
    POST | uniqueKey | -->

    RETURN | username | <--
    RETURN | score | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "display"
{
    POST | displayRequest | -->

    RETURN | data | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "querryUser"
{
    POST | querryUser | -->

    RETURN | data | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}

Action "querryUserData"
{
    POST | username | -->

    RETURN | data | <--
    RETURN | responseCode | <--
    RETURN | msg | <--
}
*/


if (isset($_GET['action']))
{
    if ($_GET['action'] == "reg")
    {
        if (isset($_POST['startupKey']) && isset($_POST['username']))
        {
            echo(json_encode($DB->ActionReg($_POST['startupKey'], $_POST['username'])));
        }
        else
        {
            echo(json_encode(array('responseCode' => "e152", 'msg' => "Requested action missing arguments!")));
        }
    }
    else if ($_GET['action'] == "update")
    {   
        if (isset($_POST['uniqueKey']) && isset($_POST['score']) && isset($_POST['diff']))
        {
            echo(json_encode($DB->ActionUpload($_POST['uniqueKey'], $_POST['score'], $_POST['diff'])));
        }
        else
        {
            echo(json_encode(array('responseCode' => "e152", 'msg' => "Requested action missing arguments!")));
        }
    }
    else if ($_GET['action'] == "login")
    {
        if (isset($_POST['startupKey']) && isset($_POST['uniqueKey']))
        {
            echo(json_encode($DB->ActionLogin($_POST['startupKey'], $_POST['uniqueKey'])));
        }
        else
        {
            echo(json_encode(array('responseCode' => "e152", 'msg' => "Requested action missing arguments!")));
        }
    }
    else if ($_GET['action'] == "display")
    {
        if (isset($_POST['displayRequest']))
        {
            echo(json_encode($DB->ActionDisplay($_POST['displayRequest'])));
        }
        else
        {
            echo(json_encode(array('responseCode' => "e152", 'msg' => "Requested action missing arguments!")));
        }    
    }
    else if ($_GET['action'] == "querryUser")
    {
        if (isset($_POST['querryUser']))
        {
            echo(json_encode($DB->GetUsers($_POST['querryUser'])));
        }
        else
        {
            echo(json_encode(array('responseCode' => "e152", 'msg' => "Requested action missing arguments!")));
        }    
    }
    else
    {
        echo(json_encode(array('responseCode' => "e151", 'msg' => "Requested action not found!")));
    }
}
else
{
    echo(json_encode(array('responseCode' => "e150", 'msg' => "No action requested!")));
}

?>