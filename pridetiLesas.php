<?php

_d($_POST);
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (is_file('C:\xampp\htdocs\nd\nd_8\saskaitos.json')) {
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
    _d($masyvas);
    // }

    $stringas = json_encode($masyvas);
    file_put_contents('saskaitos.json', $stringas);
    $stringas = file_get_contents('saskaitos.json');
    $masyvas = json_decode($stringas, 1);
    _d($masyvas);

    if ($_POST['skaiciai']) {
        foreach ($masyvas as $key => $value) {
            if ($_POST['asmensKodas'] == $masyvas[$key]['asmensKodas'])
            $masyvas[$key]['suma'] += $_POST['skaiciai'];
            _d('as ife');            
        }
        $stringas = json_encode($masyvas);
        file_put_contents('saskaitos.json', $stringas);
    }
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
                <th scope="col">Sąskaitos likutis</th>
                <th scope="col">Veiksmai</th>
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
                            <form action="http://localhost/nd/nd_8/pridetiLesas.php" method="post">
                                <label for="skaiciai">Įveskite sumą: </label>
                                <input type="number" name="skaiciai" value="" id="">
                                <button type="submit" name="asmensKodas" value="<?= $value['asmensKodas'] ?>">Pridėti lėšas</button>
                            </form>


                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>

    </table>



</body>

</html>