<?php

// function readData() : array
// {
//     if (!file_exists(DIR.'saskaitos.json')) {// pirmas kartas
//         $data = json_encode([]);
//         file_put_contents(DIR.'saskaitos.json', $data);
//     }
//     $data = file_get_contents(DIR.'saskaitos.json');
//     return json_decode($data, 1);
// }

// function writeData(array $data) : void
// {
//     $data = json_encode($data);
//     file_put_contents(DIR.'saskaitos.json', $data);
// }

// function getNextId() : int
// {
//     if (!file_exists(DIR.'indexes.json')) {// pirmas kartas
//         $index = json_encode(['id'=>1]);
//         file_put_contents(DIR.'indexes.json', $index);
//     }
//     $index = file_get_contents(DIR.'indexes.json');
//     $index = json_decode($index, 1);
//     $id = (int) $index['id'];
//     $index['id'] = $id + 1;
//     $index = json_encode($index);
//     file_put_contents(DIR.'indexes.json', $index);
//     return $id;
// }

// function getAccount(int $id) : ?array
// {
//     foreach(readData() as $account) {
//         if ($account['id'] == $id) {
//             return $account;
//         }
//     }
//     return null;
// }




?>