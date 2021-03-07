<?php
// vienkartinis. naudojamas pirma karta uzpildyti duomenim.
$users = [
    ['name' => 'Laimonas', 'surname' => 'Masionis', 'pass' => password_hash('123', PASSWORD_DEFAULT)],
    ['name' => 'Rūta', 'surname' => 'Masionienė', 'pass' => password_hash('123', PASSWORD_DEFAULT)],
    ['name' => 'Lukas', 'surname' => 'Masionis', 'pass' => password_hash('123', PASSWORD_DEFAULT)],
    ['name' => 'Benas', 'surname' => 'Masionis', 'pass' => password_hash('123', PASSWORD_DEFAULT)],
    ['name' => 'Tauras', 'surname' => 'Masionis', 'pass' => password_hash('123', PASSWORD_DEFAULT)]
];

file_put_contents(__DIR__.'/users.json', json_encode($users));