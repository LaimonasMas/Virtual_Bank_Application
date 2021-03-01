<?php
session_start();
_d($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION = $_POST;
    header('Location: http://localhost/nd/nd_8/saskaituSarasas.php');
    die;
}
_d($_SESSION);
_d(isset($_SESSION['masyvas']));
if (!empty($_SESSION) && !isset($masyvas)) {
    $masyvas[] = [
        'vardas' => $_SESSION['vardas'],
        'pavarde' => $_SESSION['pavarde'],
        'saskaitosNumeris' => $_SESSION['saskaitosNumeris'],
        'asmensKodas' => $_SESSION['asmensKodas']
    ];
    $_SESSION['masyvas'] = $masyvas;
    // $stringas = json_encode($masyvas);
    // file_put_contents('saskaitos.json', $stringas);
    _d('pirmam ife');
} else if (!empty($_SESSION) && isset($masyvas)) {
    // $stringas = file_get_contents('saskaitos.json');
    // $masyvas = json_decode($stringas, 1);
    foreach ($masyvas as $key => $value) {
    $masyvas[$key+1] = [
        'vardas' => $_SESSION['vardas'],
        'pavarde' => $_SESSION['pavarde'],
        'saskaitosNumeris' => $_SESSION['saskaitosNumeris'],
        'asmensKodas' => $_SESSION['asmensKodas']
    ];    
}
_d('else ife');
    // $stringas = json_encode($masyvas);
    // file_put_contents('saskaitos.json', $stringas);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">

</head>

<body>
    <?php include 'navigation.php'; ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vardas</th>
                <th scope="col">Pavardė</th>
                <th scope="col">Sąskaitos numeris</th>
                <th scope="col">Asmens kodas</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($masyvas as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= ($key + 1) ?></th>
                    <td><?= $masyvas[$key]['vardas'] ?></td>
                    <td><?= $masyvas[$key]['pavarde'] ?></td>
                    <td><?= $masyvas[$key]['saskaitosNumeris'] ?></td>
                    <td><?= $masyvas[$key]['asmensKodas'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>