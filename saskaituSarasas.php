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

    // pridedu kitas saskaitas jei nesikartoja asmens kodas (ir tikrinu 3 skaiciu ar [0-1], nes 12 mensesiu ir 5 skaicius ar [0-3], nes max 31 diena). Pirmas skaicius [3-6] ir max ilgis 11 patikrinti input field
    if (!str_contains($stringas, $_SESSION['asmensKodas']) && (preg_match('/(?<=^.{5})[0-3]/', $_SESSION ['asmensKodas']) === 1) && (preg_match('/(?<=^.{3})[0-1]/', $_SESSION['asmensKodas']) === 1)) { 
        $masyvas[] = $_SESSION;
        $stringas = json_encode($masyvas);
        file_put_contents('saskaitos.json', $stringas);
    }
}

// istrinti saskaita
if (isset($_SESSION['istrintiPagalAK']) && is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
    foreach ($masyvas as $key => $value) {
        if ($_SESSION['istrintiPagalAK'] == $masyvas[$key]['asmensKodas']  && ($masyvas[$key]['suma'] == 0)) {
            unset($masyvas[$key]);
            _d('cia kur turi trinti');
        }        
    }
    array_values($masyvas);
    $stringas = json_encode($masyvas);
    file_put_contents('saskaitos.json', $stringas);

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
                <th scope="col" style="">#</th>
                <th scope="col" style="width:150px; text-align:left">Vardas</th>
                <th scope="col" style="width:150px; text-align:left">Pavardė</th>
                <th scope="col" style="width:250px; text-align:left">Sąskaitos numeris</th>
                <th scope="col" style="width:150px; text-align:left">Asmens kodas</th>
                <th scope="col" style="width:200px; text-align:left">Sąskaitos likutis</th>
                <th scope="col" style="width:300px; text-align:left">Veiksmai</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($masyvas)) : ?>
                <?php usort($masyvas, function ($a, $b) {
                    return $a['pavarde'] <=> $b['pavarde'];
                }); ?>
                <?php foreach ($masyvas as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= ($key + 1) ?></th>
                        <td><?= $masyvas[$key]['vardas'] ?></td>
                        <td><?= $masyvas[$key]['pavarde'] ?></td>
                        <td><?= $masyvas[$key]['saskaitosNumeris'] ?></td>
                        <td><?= $masyvas[$key]['asmensKodas'] ?></td>
                        <td><?= $masyvas[$key]['suma'] ?></td>
                        <td>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/saskaituSarasas.php" method="post">
                                <button type="submit" name="istrintiPagalAK" value="<?= $value['asmensKodas'] ?>">Ištrinti</button>
                            </form>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/pridetiLesas.php" method="post">
                                <button type="submit" name="asmensKodas" value="<?= $value['asmensKodas'] ?>">Pridėti Lėšų</button>
                            </form>
                            <form style="display:inline-block" action="http://localhost/nd/nd_8/nuskaitytiLesas.php" method="post">
                                <button type="submit" name="asmensKodas" value="<?= $value['asmensKodas'] ?>">Nuskaityti Lėšas</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>

    </table>

</body>

</html>