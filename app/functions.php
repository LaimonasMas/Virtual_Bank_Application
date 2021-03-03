<?php

function readData() : array
{
    if (!file_exists(DIR.'data/accounts.json')) {// pirmas kartas
        $data = json_encode([]);
        file_put_contents(DIR.'data/accounts.json', $data);
    }
    $data = file_get_contents(DIR.'data/accounts.json');
    return json_decode($data, 1);
}

function writeData(array $data) : void
{
    $data = json_encode($data);
    file_put_contents(DIR.'data/accounts.json', $data);
}


?>