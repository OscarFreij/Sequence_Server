<div class="container pt-3" id="display">
<?php

switch ($_GET['diff'])
{
    case "fast":
        echo('<h2 class="fs-1 mb-3 text-center">Fast Scoreboard</h2>');
        $data = $DB->ActionDisplay("fast_0");
        if (isset($data['data']) && is_array($data['data']))
        {
            foreach ($data['data'] as $key => $value) {
                echo($value);
            }
        }
        break;

    case "norm":
        $data = $DB->ActionDisplay("norm_0");
        echo('<h2 class="fs-1 mb-3 text-center">Normal Scoreboard</h2>');
        if (isset($data['data']) && is_array($data['data']))
        {
            foreach ($data['data'] as $key => $value) {
                echo($value);
            }
        }
        else
        {
            echo('<p class="fs-4 text-center">No scores found!</p>');
        }
        break;

    case "slow":
        $data = $DB->ActionDisplay("slow_0");
        echo('<h2 class="fs-1 mb-3 text-center">Slow Scoreboard</h2>');
        if (isset($data['data']) && is_array($data['data']))
        {
            foreach ($data['data'] as $key => $value) {
                echo($value);
            }
        }
        break;

    default:
        break;
}
?>
</div>
<img id="loadingGIF" src="static/media/loading.gif" style="display:none"></img>
<div class="container"><button id="loadBtn" class="btn btn-primary w-100" onclick="GetMoreScores()">Load more scores!</button></div>