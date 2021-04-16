<?php

require "../private/db.class.php";

$DB = new DB;


var_dump($DB->Connect());

echo("<br>");

var_dump($DB->Close());
?>