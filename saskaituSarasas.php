<?php
session_start();

_d($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION = $_POST;

    // nukilinu lentele
    header('Location: http://localhost/nd/nd_8/saskaituSarasas.php');
    die;
}

// jei dar nera failo tai sukuriu ir irasau pirma saskaita
if (!is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json') && !empty($_SESSION['vardas']) && !empty($_SESSION['pavarde']) && !empty($_SESSION['saskaitosNumeris']) && !empty($_SESSION['asmensKodas'])) {
    $masyvas[] = $_SESSION;
    $stringas = json_encode($masyvas);
    file_put_contents('saskaitos.json', $stringas);
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
} else if (!empty($_SESSION['vardas']) && !empty($_SESSION['pavarde']) && !empty($_SESSION['saskaitosNumeris']) && !empty($_SESSION['asmensKodas'])) {
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);

    // pridedu kitas saskaitas jei nesikartoja asmens kodas
    if (!str_contains($stringas, $_SESSION['asmensKodas'])) {
        $masyvas[] = $_SESSION;
        $stringas = json_encode($masyvas);
        file_put_contents('saskaitos.json', $stringas);
    }
}
$stringas = file_get_contents('saskaitos.json');
$masyvas = json_decode($stringas, 1);
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
                <th scope="col">Veiksmai</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($masyvas)) : ?>
                <?php foreach ($masyvas as $key => $value) : ?>
                    <?php uasort($masyvas, function ($a, $b) {
                        return $a['pavarde'] <=> $b['pavarde'];
                    }); ?>
                    <tr>
                        <th scope="row"><?= ($key + 1) ?></th>
                        <td><?= $masyvas[$key]['vardas'] ?></td>
                        <td><?= $masyvas[$key]['pavarde'] ?></td>
                        <td><?= $masyvas[$key]['saskaitosNumeris'] ?></td>
                        <td><?= $masyvas[$key]['asmensKodas'] ?></td>
                        <td>
                        <form action="http://localhost/nd/nd_8/saskaituSarasas.php" method="post">
                        <button type="submit" name="istrintiSaskaita" value="<?= $value['asmensKodas'] ?>">Ištrinti</button>
                        </form>
                        <form action="http://localhost/nd/nd_8/pridetiLesas.php" method="post">
                        <button type="submit" name="pridetiLesu" value="<?= $value['asmensKodas'] ?>">Pridėti Lėšų</button>
                        </form>
                        <form action="http://localhost/nd/nd_8/nuskaitytiLesas.php" method="post">
                        <button type="submit" name="nuskaitytiLesas" value="<?= $value['asmensKodas'] ?>">Nuskaityti Lėšas</button>                    
                        </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>

    </table>

</body>

</html>