<div class="container pt-3">

<?php

if (isset($_GET['uq']))
{
    $uq = preg_replace('/[\x00-\x2F\x5B-\x60\x7F-\xFF]/', '', $_GET['uq']);
    echo('<h2 class="fs-1 text-center">Search results for: '.$uq.'</h2>');
    $returnData = $DB->GetUsers($uq);
    
    
}
else
{
    echo("ERROR: search parameters");
}
?>

<div class="row row-cols-1 row-cols-md-3 g-4">
<?php
if (strlen($uq) > 0)
{
    if (is_array($returnData['data']))
    {
        foreach ($returnData['data'] as $key => $value) {
            echo($value);
        }
    }
    else
    {
        echo('<p class="fs-4 text-center">No users found!</p>');
    }
}
else
{
    echo('<p class="fs-4 text-center">Search querry is empty found!</p>');
}
?>
</div>
</div>