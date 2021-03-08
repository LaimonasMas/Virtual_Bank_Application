<?php
// vienkartinis. naudojamas pirma karta uzpildyti duomenim.
if (!file_exists(__DIR__.'/users.json')) {
    $users = [
        ['name' => 'Laimonas', 'surname' => 'Masionis', 'pass' => password_hash('123', PASSWORD_DEFAULT), 'status' => '1']
    ];
    
    file_put_contents(__DIR__.'/users.json', json_encode($users));
}
