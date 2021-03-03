<?php

// generuoja nauja saskaita
function accountGenerator()
{
    $string1 = '';
    for ($i = 0; $i < 2; $i++) {
        $string1 .= rand(0, 9);
    }
    $string2 = '';
    for ($i = 0; $i < 3; $i++) {
        $string2 .= rand(0, 9);
    }
    $string3 = '';
    for ($i = 0; $i < 4; $i++) {
        $string3 .= rand(0, 9);
    }
    $string4 = '';
    for ($i = 0; $i < 4; $i++) {
        $string4 .= rand(0, 9);
    }
    return 'LT' . $string1 . ' ' . '7044 0' . $string2 . ' ' . $string3 . ' ' . $string4;
}

// generuoja nauja ID ir iraso i indexes.json faila
function writeAccId(): void
{
    if (!file_exists(DIR . 'indexes.json') && isset($_SESSION['newAccButton'])) { // pirmas kartas
        $index = json_encode(['id' => 1]);
        file_put_contents(DIR . 'indexes.json', $index);
    }
    if (file_exists(DIR . 'indexes.json') && isset($_SESSION['newAccButton'])) {
        $index = file_get_contents(DIR . 'indexes.json');
        $index = json_decode($index, 1);
        $id = (int) $index['id'];
        $index['id'] = $id + 1;
        $index = json_encode($index);
        file_put_contents(DIR . 'indexes.json', $index);
    }
}

// nuskaito index.json faila ir atiduoda nauja ID numeri
function readNextAccId()
{
    if (file_exists(DIR . 'indexes.json')) {
        $index = file_get_contents(DIR . 'indexes.json');
        $index = json_decode($index, 1);
        $id = (int) $index['id'];
        return $id;
    }
}

// sukuria nauja masyva (saskaitose) ir ikelia i saskaitos.json faila
function writeAccount(): void
{
    if (isset($_SESSION['newAccButton'])) {
        $newAccButton = $_SESSION['newAccButton'];
    }
    if (!file_exists(DIR . 'saskaitos.json')) {
        $stringas = json_encode([]);
        file_put_contents(DIR . 'saskaitos.json', $stringas);
    } else if (isset($newAccButton) && !empty($_SESSION['vardas']) && !empty($_SESSION['pavarde']) && !empty($_SESSION['asmensKodas']) && (preg_match('/(^[3-6]\d{2}[0-1]\d{1}[0-3]\d{5})$/', $_SESSION['asmensKodas']) === 1)) {
        $stringas = file_get_contents(DIR . 'saskaitos.json');
        $masyvas = json_decode($stringas, 1);

        // pridedu kitas saskaitas jei nesikartoja ID
        if ($_SESSION['accountId'] !== readNextAccId()) {
            $masyvas[] = $_SESSION;
            $stringas = json_encode($masyvas);
            file_put_contents(DIR . 'saskaitos.json', $stringas);
        }
    }
}

// nuskaito saskaitos.json faila ir atiduoda masyva (visas esamas saskaitas)
function readAccount(): array
{
    if (is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
        $stringas = file_get_contents(DIR . 'saskaitos.json');
        $masyvas = json_decode($stringas, 1);
        return $masyvas;
    }
}

// prideda lesas
function addFunds()
{
    if (isset($_POST['prideti'])) {
        header('Location: http://localhost/nd/nd_8/pridetiLesas.php');
        die;
    }
    if (is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
        // issivynioju masyva        
        $masyvas = readAccount();
        if (isset($_POST['skaiciai'])) {            // <--- tikrinu ar ivesta prideti reiksme
            foreach ($masyvas as $key => $value) {
                // ieškau ivesto ak reiksmes atitikmens masyve ir jei randu tai pridedu reiksme
                if ($_POST['pridetiLesas'] == $masyvas[$key]['accountId'])
                    $masyvas[$key]['suma'] += $_POST['skaiciai'];
            }
            // ivynioju ir pasidedu masyva, paskui nukilinu lentele
            $stringas = json_encode($masyvas);
            file_put_contents(DIR . 'saskaitos.json', $stringas);
            header('Location: http://localhost/nd/nd_8/pridetiLesas.php');
            die;
        }
    }
}

// nuskaito lesas
function withdrawFunds()
{
    if (isset($_POST['nuskaityti'])) {
        header('Location: http://localhost/nd/nd_8/nuskaitytiLesas.php');
        die;
    }
    if (is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
        // issivynioju masyva        
        $masyvas = readAccount();
        if (isset($_POST['skaiciai'])) {            // <--- tikrinu ar ivesta prideti reiksme
            foreach ($masyvas as $key => $value) {
                // ieškau ivesto ak reiksmes atitikmens masyve, tikrinu ar ivestas skaicius mazesnis uz saskaitos likuti, jei ok randu ir tai atimu reiksme
                if (($_POST['nuskaitytiLesas'] == $masyvas[$key]['accountId']) && ($_POST['skaiciai'] <= $masyvas[$key]['suma']))
                    $masyvas[$key]['suma'] -= $_POST['skaiciai'];
            }
            // ivynioju ir pasidedu masyva, paskui nukilinu lentele
            $stringas = json_encode($masyvas);
            file_put_contents(DIR . 'saskaitos.json', $stringas);
            header('Location: http://localhost/nd/nd_8/nuskaitytiLesas.php');
            die;
        }
    }
}

// istrina saskaita
function deleteAccount()
{
    if (isset($_SESSION['istrintiPagalID']) && is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
        $masyvas = readAccount();
        foreach ($masyvas as $key => $value) {
            if ($_SESSION['istrintiPagalID'] == $masyvas[$key]['accountId']  && ($masyvas[$key]['suma'] == 0)) {
                unset($masyvas[$key]);
            }
        }
        $stringas = json_encode($masyvas);
        file_put_contents('saskaitos.json', $stringas);
    }
}