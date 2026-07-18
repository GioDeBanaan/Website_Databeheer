<?php
    header('Content-Type: application/json');
    $response = file_get_contents('https://random-d.uk/api/v2/random?type=jpg');
    echo $response;
?>